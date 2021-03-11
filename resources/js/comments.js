


$(function () {

    function format(d) {
        // `d` is the original data object for the row
        return '<div class="slider">' + d.comment + '</div>';
    }

    let table = $('#com-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/comments',
        columnDefs: [
            { "className": "text-center", "targets": "_all" }
        ],
        columns: [
            {
                "class": 'details-control ',
                "orderable": false,
                "data": null,
                "defaultContent": ''
            },
            {
                data: 'created_at', name: 'created_at', render: function (d, t, r, m) {
                    return new Date(d).toLocaleDateString()
                }
            },
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },

            {
                data: 'post_id', name: 'post_id', render: function (d, t, r, m) {
                    return "<a href='/news/" + r.post.slug + "'>View </a>";
                }
            },
            {
                data: 'visible', name: 'visible', render: function (d, t, r, m) {
                    if (d === 1)
                        return '<input type="checkbox" class="switcher" checked data-id="' + r.id + '"/>';
                    else
                        return '<input type="checkbox" class="switcher" data-id="' + r.id + '" />';

                }
            },
            {
                data: 'id', name: 'id', render: function (d, t, r, m) {
                    return "<button class='rounded px-2 py-1 bg-red-600 deleteComment' data-id="+r.id+"><i class='fa fa-trash text-white' aria-hidden='true'></i></button>"
                }
            },

        ],
        initComplete: function () {
            var that = this;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.deleteComment').on('click', function () {
                let id= $(this).attr('data-id');
                $.ajax({
                    type: "delete",
                    url: `/admin/comments/${id}`,

                    success: function (response) {
                        console.log(response)
                    }
                });
                that.draw();

            });
            $('.switcher').on('change', function () {
                $.ajax({
                    type: "PUT",
                    url: "/api/comment/switch-visible",
                    data: { comment: $(this).attr('data-id') },

                    success: function (response) {
                        console.log(response)
                    }
                });

            })
            this.api().columns([6]).every(function () {
                var column = this;
                var select = $('<select class="text-black"><option value="">All</option><option value="0">Not aproved</option><option value="1">Visible</option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });


            });
        }
    });

    $('#com-datatable tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });




});
