@extends("admin.adminLayout")
@section("content")
<div class="w-full bg-slate-300 h-full px-5 md:px-10 py-5">
    @if(Session::has('success'))
        <script>
            toastr.success("{{Session::get('success')}}")
        </script>
    @endif
    <div class="box  w-full ">
        <h2 class="font-bold text-2xl mt-2">
          Ajouter  Comptoire
        </h2>
    </div>


    <div class="w-full">

        <form action="{{route('PostMart')}}" enctype="multipart/form-data" method="POST" class="w-full">
            @csrf
        <div class="w-full box">
            <h2 class="font-bold">
                Information generales
            </h2>
                <div class="inputs">
                    <label for="">Nom du Comptoire<span class="text-red-500">*</span></label>
                    <input name="name" required type="text" class="my-input" placeholder="titre du blog">
                    @if($errors->has('name'))
                    <span class="text-red-500">{{$errors->first('name')}}</span>
                    @endif
                </div>
                <div class="inputs">
                    <label for="">Pays</label>
                    <input type="text" name="country"  value="Cameroun" class="my-input" placeholder="titre du blog">
                    @if($errors->has('country'))
                    <span class="text-red-500">{{$errors->first('country')}}</span>
                    @endif
                </div>
                <div class="inputs">
                    <label for="">Email</label>
                    <input type="text" name="email"  class="my-input" placeholder="email du comptoir">
                    @if($errors->has('email'))
                    <span class="text-red-500">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <div class="inputs">
                    <label for="">Ville</label>
                    <input type="text" name="city" class="my-input" placeholder="ville">
                    @if($errors->has('ville'))
                    <span class="text-red-500">{{$errors->first('ville')}}</span>
                    @endif
                </div>
                <div class="inputs">
                    <label for="">Numero MTN(MoMo)</label>
                    <input type="tel" name="numMTN" class="my-input" >
                    @if($errors->has('numMTN'))
                    <span class="text-red-500">{{$errors->first('numMTN')}}</span>
                    @endif
                </div>

                <div class="inputs">
                    <label for="">Numero Orange(Orange Money)</label>
                    <input type="tel" name="numOrange" class="my-input" >
                    @if($errors->has('numOrange'))
                    <span class="text-red-500">{{$errors->first('numORange')}}</span>
                    @endif
                </div>
        </div>
        <div class="box w-full">
            <h2 class="font-bold">
                Logo            </h2>
                <br>
                <label for="">Logo du Comptoir glisser deposer  ici(JPEG,JPG,PNG,WEBP)</label>
                <div class="champ dropzone border-dashed rouded-md ">
                    <input type="file" name="mart_logo" class="" id="myDragAndDropUploader">
                    @if($errors->has('mart_logo'))
                    <span class="text-red-500">{{$errors->first('mart_logo')}}</span>
                    @endif
                </div>

        </div>

        <button class="btn w-30 bg-yellow-400 p-2 rounded-md text-white" type="submit">
            <i class="fa-solid fa-floppy-disk"></i>  Envoyer
        </button>
    </form>
    </div>
</div>
<script>
</script>
@endsection