@extends("admin.adminLayout")
@section("content")
<div class="w-full bg-slate-300 h-full px-4 md:px-10 py-5">
    @if(Session::has('success'))
        <script>
            toastr.success("{{Session::get('success')}}")
        </script>
    @endif
    <div class="box  w-full ">
        <h2 class="font-bold text-2xl mt-2">
          Ajouter  Blogs
        </h2>
    </div>


    <div class="w-full md:w-11/12">

        <form action="{{route('PostBlog')}}" enctype="multipart/form-data" method="POST" class="w-full">
            @csrf
        <div class="w-full box">
            <h2 class="font-bold">
                Information generales
            </h2>
                <div class="inputs">
                    <label for="">titre1<span class="text-red-500">*</span></label>
                    <input name="title1" required type="text" class="my-input" placeholder="titre du blog">
                    @if($errors->has('title1'))
                    <span class="text-red-500">{{$errors->first('title1')}}</span>
                    @endif
                </div>
                <div class="inputs">
                    <label for="">text1<span class="text-red-500">*</span></label>
                    <textarea name="text1" required id="" class="my-text-input" cols="30" rows="10">

                    </textarea>
                    @if($errors->has('text1'))
                    <span class="text-red-500">{{$errors->first('text1')}}</span>
                    @endif
                </div>
                <div class="inputs">
                    <label for="">titre2</label>
                    <input type="text" name="title2" class="my-input" placeholder="titre du blog">
                    @if($errors->has('title2'))
                    <span class="text-red-500">{{$errors->first('title2')}}</span>
                    @endif
                </div>
                <div class="inputs">
                    <label for="">text1</label>
                    <textarea name="text2" id="" class="my-text-input" cols="30" rows="10">

                    </textarea>
                    @if($errors->has('texte2'))
                    <span class="text-red-500">{{$errors->first('texte2')}}</span>
                    @endif
                </div>
        </div>
        <div class="box w-full">
            <h2 class="font-bold">
                Images & Illustrations
            </h2>
                <br>
                <label for="">Image 1 glisser deposer  ici(JPEG,JPG,PNG,WEBP)</label>
                <div class="champ dropzone border-dashed rouded-md ">
                    <input type="file" name="image1" class="" id="myDragAndDropUploader">
                    @if($errors->has('image1'))
                    <span class="text-red-500">{{$errors->first('image1')}}</span>
                    @endif
                </div>
                <br>
                <label for="">Image 2 glisser deposer  ici(JPEG,JPG,PNG,WEBP)</label>
                <div class="champ dropzone border-dashed rouded-md ">
                    <input type="file" name="image2" class="" id="myDragAndDropUploader">
                    @if($errors->has('image2'))
                    <span class="text-red-500">{{$errors->first('image2')}}</span>
                    @endif
                </div>

        </div>

        <button class="btn w-30 bg-blue-500 p-2 rounded-md text-white" type="submit">
            <i class="fa-solid fa-floppy-disk"></i>  Envoyer
        </button>
    </form>
    </div>
</div>
<script>
</script>
@endsection