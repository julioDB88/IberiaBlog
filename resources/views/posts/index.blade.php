<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>
    <div class="p-4 flex flex-wrap">
        @if (Session::has('success'))
        <div class="bg-green-500 p-3 w-full rounded">{{ Session::get('success') }}</div>
        @endif
        @if($errors->any())
        <div class="bg-red-500 p-3 w-full rounded">
            @foreach ($errors->all() as $error)
            <p class=text-white">{{$error}} </p>
            @endforeach
        </div>
        @endif


        <div class="w-full md:w-1/2">
            <h1 class="text-center py-3 my-3">{{__('Last Posts') }}</h1>
        <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
            <thead>
                <tr class="border-b">
                    <th> {{__('Date')}}</th>
                    <th> {{__('Title')}}</th>
                    <th> {{__('Edit')}}</th>
                    <th> {{__('Trash')}}</th>
                    <th> {{__('Stats')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr >
                        <td class="text-center">{{\Carbon\Carbon::parse($post->created_at)->format('d-m-y')}}</td>
                        <td class="text-center">{{$post->title}}</td>
                        <td class="p-4 text-center" x-data="{clicked:false}"><a href="{{route('posts.edit',$post)}}" @click="clicked=!clicked" :disabled="clicked" class="bg-yellow-500 text-white px-4 py-2">Edit</a></td>
                        <td class="p-4 text-center" x-data="{clicked:false}">
                            <form action="{{route('posts.destroy',$post->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button  class="rounded bg-red-500 px-4 py-2"><i class="fa fa-trash text-white"></i></button>
                            </form> </td>
                        <td class="text-center">1 <i class="far fa-thumbs-up "></i>  3 <i class="far fa-comment-alt"></i></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="w-full md:w-1/2">
            <h1 class="text-center py-3 my-3">{{__('New Post') }}</h1>
            <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group my-3 flex flex-wrap">
                    <div class="p-3 w-full md:w-2/4">
                        <label for="title" class="block">{{__('Title')}}</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="block w-full mt-1 rounded-md border-transparent focus:border-gray-500 focus:bg-white focus:ring-"
                            autocomplete="off">
                    </div>
                    <div class="p-3 w-full md:w-2/4">
                        <label for="category" class="block">{{__('Category')}}</label>

                        <select name="category"
                            class="block w-full mt-1 rounded-md border-transparent focus:border-gray-500 focus:bg-white focus:ring-0">
                            @foreach ($cats as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="p-3 w-full md:w-2/4">
                        <label for="title" class="block">{{__('Meta keywords')}}</label>
                        <input type="text" name="keywords" value="{{ old('keywords') }}"
                            class="block w-full mt-1 rounded-md border-transparent focus:border-gray-500 focus:bg-white focus:ring-"
                            autocomplete="off">
                    </div>
                    <div class="p-3 w-full md:w-2/4">
                        <label for="title" class="block">{{__('Meta Description')}}</label>
                        <input type="text" name="description" value="{{ old('description') }}"
                            class="block w-full mt-1 rounded-md border-transparent focus:border-gray-500 focus:bg-white focus:ring-"
                            autocomplete="off">
                    </div>
                    <div class="p-3 w-full md:w-1/4">
                        <label for="image_file" class="bg-green-400 p-4 rounded">{{__('Add Mmage')}}
                            <input type="file" name="image_file" id="image_file" class="hidden">
                        </label>
                    </div>

                </div>


                <textarea name="content" id="contents">Hello, World!</textarea>
                <input type="submit" class="bg-green-400 p-4 rounded m-6" value="{{__('Submit')}}">

            </form>
        </div>



    </div>



    @push('js')
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
