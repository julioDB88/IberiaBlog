<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>
    <div class="p-4 flex flex-wrap">

        @if($errors->any())
        <div class="bg-red-500 p-3 w-full rounded text-white">
            @foreach ($errors->all() as $error)
            <p class=text-white">{{$error}} </p>
            @endforeach
        </div>
        @endif


        <div class="w-full md:w-1/2 p-4 border-2 text-white bg-gray-700">
            @if (session('success'))
            <div class="bg-green-500 p-3 my-2 w-full rounded text-white">{{ session('success') }}</div>
            @endif
            @if (session('error'))
            <div class="bg-red-500 p-3 my-2 w-full rounded text-white">{{ session('error') }}</div>
            @endif
            <h1 class="tracking-widest font-bold text-3xl border-b-4 border-blue-700 ">@lang('main.Last Posts') </h1>
            <div  class="my-3" style="max-height: 600px; overflow-y:auto">
            <table id="datatable" class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
            <thead>
                <tr class="border-b-2 text-black">
                    <th class="py-3"> @lang('main.Date')</th>
                    <th> @lang('main.Title')</th>
                    <th> @lang('main.Edit')</th>
                    <th> @lang('main.Trash')</th>
                    <th> @lang('main.Stats')</th>
                </tr>
            </thead>

            <tbody class="bg-gray-300 text-gray-700">

            </tbody>


        </table>
    </div>

        </div>
        <div class="w-full md:w-1/2 p-4 border-2 bg-gray-700 text-white">
            <h1 class="tracking-widest font-bold text-3xl border-b-4 border-blue-700 ">@lang('main.New Post') </h1>
            <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group my-3 flex flex-wrap">
                    <div class="p-3 w-full md:w-2/4">
                        <label for="title" class="block">@lang('main.Title')</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="block w-full mt-1 rounded-md border-transparent focus:border-gray-500 focus:bg-white text-gray-700"
                            autocomplete="off">
                    </div>
                    <div class="p-3 w-full md:w-2/4">
                        <label for="category" class="block">@lang('main.Category')</label>

                        <select name="category_id"
                            class="block w-full mt-1 rounded-md border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-gray-700">
                            @foreach ($cats as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="p-3 w-full md:w-2/4">
                        <label for="title" class="block">@lang('main.Meta keywords')</label>
                        <input type="text" name="keywords" value="{{ old('keywords') }}"
                            class="block w-full mt-1 rounded-md border-transparent focus:border-gray-500 focus:bg-white text-gray-700"
                            autocomplete="off">
                    </div>
                    <div class="p-3 w-full md:w-2/4">
                        <label for="title" class="block">@lang('main.Meta Description')</label>
                        <input type="text" name="description" value="{{ old('description') }}"
                            class="block w-full mt-1 rounded-md border-transparent focus:border-gray-500 focus:bg-white text-gray-700"
                            autocomplete="off">
                    </div>
                    <div class="p-3 w-full  bg-indigo-700 rounded text-white">

                            <input type="file" name="image_file" id="image_file" class="rounded text-xs md:text-base">

                    </div>

                </div>


                <textarea name="content" id="contents">Hello, World!</textarea>
                <input type="submit" class="bg-indigo-700 p-4 rounded m-6 text-white" value="@lang('main.Submit')">

            </form>
        </div>



    </div>



    @push('js')

    <script>
        $(function() {



            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('posts.index')}}',
                columns: [

                    { data: 'created_at', name: 'created_at',render:function(d,t,r,m){
                        return new Date(d).toLocaleDateString()
                    } },
                    { data: 'title', name: 'title' },
                    { data: 'id', name: 'id',render:function(d,t,r,m){
                       return "<a href='/admin/posts/"+d+"/edit' class='bg-yellow-500 rounded text-white px-4 py-2'><i class='fas fa-edit'></i></a>"
                    } },

                    { data: 'id', name: 'id',render:function(d,t,r,m){
                       return "<button class='bg-red-500 rounded text-white px-4 py-2 deleter' data-id='"+d+"'><i class='fas fa-trash'></i></button>"
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


    </script>

    <script defer>
        tinymce.init({
    selector:'#contents',
    schema:'html5',
    theme:'silver',
    language:'es_ES',
    skin: 'oxide-dark',
    plugins: 'image code emoticons anchor fullscreen lists',
  toolbar: ' fullscreen| undo redo | image emoticons| code| numlist bullist | bold italic underline | alignleft aligncenter alignright alignjustify |styleselect formatselect fontselect fontsizeselect list outdent indent blockquote',
  /* enable title field in the Image dialog*/
  image_title: true,
  /* enable automatic uploads of images represented by blob or data URIs*/
  automatic_uploads: true,
  /*
    URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
    images_upload_url: 'postAcceptor.php',
    here we add custom filepicker only to Image dialog
  */
  file_picker_types: 'image',
  /* and here's our custom image picker*/
  file_picker_callback: function (cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    /*
      Note: In modern browsers input[type="file"] is functional without
      even adding it to the DOM, but that might not be the case in some older
      or quirky browsers like IE, so you might want to add it to the DOM
      just in case, and visually hide it. And do not forget do remove it
      once you do not need it anymore.
    */

    input.onchange = function () {
      var file = this.files[0];

      var reader = new FileReader();
      reader.onload = function () {
        /*
          Note: Now we need to register the blob in TinyMCEs image blob
          registry. In the next release this part hopefully won't be
          necessary, as we are looking to handle it internally.
        */
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        /* call the callback and populate the Title field with the file name */
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };

    input.click();
  },
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'});

    </script>

    @endpush

</x-app-layout>
