<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('main.About')
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
            <section class="container text-white bg-gray-700 rounded ">
                <div class="p-5  m-4 ">
                    @if (Session::has('success'))
                    <div class="alert-banner w-full ">
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
                    <h1 class="my-4 py-4 font-bold text-2xl border-b-2 border-blue-700"> {{__('pages.about.edit')}}</h1>
                    <form action="{{ route('pages.update','about') }}" method="post">
                        @csrf
                        @method('PUT')

                        <textarea name="content" id="contents">Hello, World!</textarea>
                        <input type="submit" class="bg-blue-700 cursor-pointer p-4 rounded m-6 text-white font-bold"
                            value=@lang('main.Submit')>
                    </form>
                </div>
            </section>
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
