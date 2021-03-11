$(function () {



    $('#posts-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/posts',
        columnDefs: [
            {
                targets: ['_all'],
                className: 'text-center'
            }
        ],
        columns: [

            {
                data: 'publish_at', name: 'publish_at', render: function (d, t, r, m) {
                    return new Date(d).toLocaleDateString()
                }
            },
            {
                data: 'title', name: 'title', render: function (d, t, r, m) {
                    return "<a href='/news/" + r.slug + "/' class=''>" + d + "</a>"
                }
            },
            {
                data: 'id', name: 'id', render: function (d, t, r, m) {
                    return "<a href='/admin/posts/" + d + "/edit' class='bg-yellow-500 rounded text-white p-2'><i class='fas fa-edit'></i></a>"
                }
            },

            {
                data: 'id', name: 'id', render: function (d, t, r, m) {
                    return "<button class='bg-red-500 rounded text-white p-2 deleter' data-id='" + d + "'><i class='fas fa-trash'></i></button>"
                }
            },
            {
                data: 'comments_count', name: 'comments_count', render: function (d, t, r, m) {

                    return '<i class="far fa-comment-alt"></i>  ' + d;

                }
            },
            {
                data: 'active', name: 'active', render: function (d, t, r, m) {

                    return d == 1 ? '<i class=" text-green-400 fas fa-eye"></i>  ' : '<i class=" text-red-500 fas fa-eye-slash"></i>';

                }
            },

        ],
        initComplete: function () {
            $('.deleter').on('click', function () {
                let post = $(this).attr('data-id')
                let table = $('#posts-datatable').DataTable();
                let button = $(this);
                $.ajax({
                    type: "DELETE",
                    url: "/api/posts/delete/" + post,

                    success: function (response) {
                        table.row(button.parents('tr')).remove().draw()
                    }
                });

            })

        }
    });

    $('#nextposts-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/posts/programed',
        columnDefs: [
            {
                targets: ['_all'],
                className: 'text-center'
            }
        ],
        columns: [

            {
                data: 'publish_at', name: 'publish_at', render: function (d, t, r, m) {
                    return new Date(d).toLocaleDateString()
                }
            },
            {
                data: 'title', name: 'title', render: function (d, t, r, m) {
                    return "<a href='/news/" + r.slug + "/' class=''>" + d + "</a>"
                }
            },
            {
                data: 'id', name: 'id', render: function (d, t, r, m) {
                    return "<a href='/admin/posts/" + d + "/edit' class='bg-yellow-500 rounded text-white p-2'><i class='fas fa-edit'></i></a>"
                }
            },

            {
                data: 'id', name: 'id', render: function (d, t, r, m) {
                    return "<button class='bg-red-500 rounded text-white p-2 deleter' data-id='" + d + "'><i class='fas fa-trash'></i></button>"
                }
            },
            {
                data: 'active', name: 'active', render: function (d, t, r, m) {

                    return d == 1 ? '<i class=" text-green-400 fas fa-eye"></i>  ' : '<i class=" text-red-500 fas fa-eye-slash"></i>';

                }
            },

        ],
        initComplete: function () {
            $('.deleter').on('click', function () {
                let table = $('#posts-datatable').DataTable();
                let button = $(this);

                let post = $(this).attr('data-id')
                $.ajax({
                    type: "DELETE",
                    url: "/api/posts/delete/" + post,

                    success: function (response) {
                        table.row(button.parents('tr')).remove().draw()
                    }
                });

            })

        }
    });




});
