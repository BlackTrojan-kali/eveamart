@extends("admin.adminLayout")
@section("content")
<div class="w-full bg-slate-300 h-full px-4 md:px-10 py-5">
    @if(Session::has('success'))
        <script>
            toastr.info("{{Session::get('success')}}")
        </script>
    @endif
    <div class="box  w-full ">
        <h2 class="font-bold text-2xl mt-2">
          Ajouter  Une Categorie
        </h2>
    </div>


    <div class="w-full md:w-11/12">

        <form action="{{route("UpCategory",$cat->id)}}" enctype="multipart/form-data" method="POST" class="w-full">
            @csrf
        <div class="w-full box">
            <h2 class="font-bold">
                Information generales
            </h2>
                <div class="inputs">
                    <label for="">Nom du Comptoire<span class="text-red-500">*</span></label>
                    <input name="name" value="{{$cat->category_name}}" required type="text" class="my-input" placeholder="titre du blog">
                    @if($errors->has('name'))
                    <span class="text-red-500">{{$errors->first('name')}}</span>
                    @endif
                </div>

        <button class="btn w-3/12 bg-red-500 p-2 rounded-md text-white" type="submit">
            <i class="fa-solid fa-floppy-disk"></i>  Envoyer
        </button>
    </form>
    
    </div>

           

    </div>
</div>
<script>
</script>
@endsection