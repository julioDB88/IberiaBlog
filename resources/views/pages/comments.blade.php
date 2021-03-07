<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('main.Comments')
        </h2>
    </x-slot>
    <div class="p-5">
        @if (Session::has('success'))
        <div class="alert-banner w-full">
            <input type="checkbox" class="hidden" id="banneralert">

            <label
                class="close cursor-pointer flex items-center justify-between w-full p-2 bg-red-500 shadow text-white"
                title="close" for="banneralert">
                {{ Session::get('success') }}
            </label>
        </div>

        @endif
        @if($errors->any())
        <div class="bg-red-500 p-3 w-full rounded">
            @foreach ($errors->all() as $error)
            <p class=text-white">{{$error}} </p>
            @endforeach
        </div>
        @endif
        <section class="body-font my-4">
            <div class="container mx-auto">
                <div class="rounded border-gray-700 border-2 bg-gray-700 text-white">
                    <h3 class="tracking-widest text-3xl border-b-2 border-blue-700 p-2 mx-2 font-bold ">
                        @lang('main.Comments_for_Review')</h3>
                    <div class="px-2 my-4" style="max-height: 600px; overflow-y:auto">
                        <table class="table-auto w-full" id="datatable">
                            <thead class="bg-blue-900 text-white">
                                <tr>
                                    <th></th>
                                    <th>@lang('main.Date')</th>
                                    <th class="p-2">@lang('main.Name')</th>

                                    <th>@lang('main.Post')</th>
                                    <th>@lang('main.Status')</th>
                                </tr>
                            </thead>
                            <tbody class="text-black"></tbody>

                        </table>

                    </div>
                </div>
        </section>
        @push('js')
        <script>
            $(function() {
    function format ( d ) {
    // `d` is the original data object for the row
    return '<div class="slider">'+d.comment+'</div>';
}
        var table=$('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('comments.index')}}',
        columns: [
            {
                "class":          'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": '<p>Mola</p>'
            },
            { data: 'created_at', name: 'created_at',render:function(d,t,r,m){
                return new Date(d).toLocaleDateString()
            } },
            { data: 'name', name: 'name' },

            { data: 'post_id', name: 'post_id',render:function(d,t,r,m){
                return "<a href='news/"+r.post.slug+"'>View </a>";
            } },
            { data: 'visible', name: 'visible' },

        ]
    });

$('#datatable tbody').on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = table.row( tr );

    if ( row.child.isShown() ) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        // Open this row
        row.child( format(row.data()) ).show();
        tr.addClass('shown');
    }
} );
});
        </script>
        @endpush
    </div>

</x-app-layout>
