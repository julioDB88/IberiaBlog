<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>
    <div class="p-4 flex flex-wrap">
        @if (Session::has('success'))
        <div class="alert-banner w-full fixed top-0">
            <input type="checkbox" class="hidden" id="banneralert">

            <label class="close cursor-pointer flex items-center justify-between w-full p-2 bg-red-500 shadow text-white" title="close" for="banneralert">
                {{ Session::get('success') }}

              <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
              </svg>
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
        <div class="w-full ">
            <h1 class="text-center py-3 my-3">{{__('Edit Post') }}</h1>
            <form action="{{route('posts.update',$post->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group my-3 flex flex-wrap">
                    <div class="p-3 w-full md:w-2/4">
                        <label for="title" class="block">{{__('Title')}}</label>
                        <input type="text" name="title" value="{{ $post->title }}"
                            class="block w-full mt-1 rounded-md border-transparent focus:border-gray-500 focus:bg-white focus:ring-"
                            autocomplete="off">
                    </div>
                    <div class="p-3 w-full md:w-2/4">
                        <label for="category" class="block">{{__('Category')}}</label>

                        <select name="category"
                            class="block w-full mt-1 rounded-md border-transparent focus:border-gray-500 focus:bg-white focus:ring-0">
                            @foreach ($cats as $cat)
                            <option value="{{$cat->id}}" @if ($post->category_id === $cat->id) selected @endif >{{$cat->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="p-3 w-full md:w-2/4">
                        <label for="title" class="block">{{__('Meta keywords')}}</label>
                        <input type="text" name="keywords" value="{{ $post->keywords }}"
                            class="block w-full mt-1 rounded-md border-transparent focus:border-gray-500 focus:bg-white focus:ring-"
                            autocomplete="off">
                    </div>
                    <div class="p-3 w-full md:w-2/4">
                        <label for="title" class="block">{{__('Meta Description')}}</label>
                        <input type="text" name="description" value="{{ $post->description }}"
                            class="block w-full mt-1 rounded-md border-transparent focus:border-gray-500 focus:bg-white focus:ring-"
                            autocomplete="off">
                    </div>
                    <div class="p-3 w-full md:w-1/4">
                        <label for="image_file" class="bg-green-400 p-4 rounded">{{__('Add Mmage')}}
                            <input type="file" name="image_file" id="image_file" class="hidden">
                        </label>

                    </div>

                </div>


                <textarea name="content" id="contents">{{$post->content}}</textarea>
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
