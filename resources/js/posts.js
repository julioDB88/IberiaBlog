$(function() {



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

            { data: 'created_at', name: 'created_at',render:function(d,t,r,m){
                return new Date(d).toLocaleDateString()
            } },
            { data: 'title', name: 'title',render:function(d,t,r,m){
                return "<a href='/news/"+r.slug+"/' class=''>"+d+"</a>"
             } },
            { data: 'id', name: 'id',render:function(d,t,r,m){
               return "<a href='/admin/posts/"+d+"/edit' class='bg-yellow-500 rounded text-white p-2'><i class='fas fa-edit'></i></a>"
            } },

            { data: 'id', name: 'id',render:function(d,t,r,m){
               return "<button class='bg-red-500 rounded text-white p-2 deleter' data-id='"+d+"'><i class='fas fa-trash'></i></button>"
            } },
            { data: 'comments_count', name: 'comments_count',render:function(d,t,r,m){

                return  '<i class="far fa-comment-alt"></i>  ' +d;


            } },

        ],
        initComplete: function () {
            $('.deleter').on('click',function(){
            $.ajax({
            type: "DELETE",
            url: "/api/posts/delete/"+$(this).attr('data-id'),

            success: function (response) {
            console.log(response)
            }
        });

    })

        }
    });




});
