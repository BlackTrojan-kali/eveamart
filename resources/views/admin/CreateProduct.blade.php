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
          Ajouter un Produit
        </h2>
    </div>

    <div class="w-full md:w-11/12">

        <form action="{{route(Auth::guard("admin")->user()->super ? "PostProduct":"PostGProduct")}}" enctype="multipart/form-data" method="POST" class="w-full">
            @csrf
        <div class="w-full box">
            <h2 class="font-bold">
                Information generales
            </h2>
                <div class="inputs">
                    <label for="">Nom du Produit<span class="text-red-500">*</span></label>
                    <input name="product_name" required type="text" class="my-input" placeholder="nom du produit">
                    @if($errors->has('name'))
                    <span class="text-red-500">{{$errors->first('names')}}</span>
                    @endif
                </div>
                <div class="inputs">
                    <label for="">prix du Produit<span class="text-red-500">*</span></label>
                    <input name="price" required type="number" class="my-input" placeholder="prix du produit">
                    @if($errors->has('price'))
                    <span class="text-red-500">{{$errors->first('price')}}</span>
                    @endif
                </div>
                <div class="inputs">
                    <label for="">Description<span class="text-red-500">*</span></label>
                    <textarea name="desc" required id="" class="my-text-input" cols="30" rows="10">

                    </textarea>
                    @if($errors->has('desc'))
                    <span class="text-red-500">{{$errors->first('desc')}}</span>
                    @endif
                </div>
                <div class="inputs">
                    <label for="">poids</label>
                    <input type="number" name="weight" class="my-input" placeholder="poid du produit(kg)">
                    @if($errors->has('weight'))
                    <span class="text-red-500">{{$errors->first('weight')}}</span>
                    @endif
                </div>
                <div class="inputs">
                    <label for="">Qte Disponible</label>
                    <input type="number" name="Qty" class="my-input" placeholder="poid du produit(kg)">
                    @if($errors->has('Qty'))
                    <span class="text-red-500">{{$errors->first('Qty')}}</span>
                    @endif
                </div>
                <div class="inputs">
                    <label for="">category</label>
                   <select name="cats" class="w-full" id="">
                    <option disabled selected>Choisissez un categorie</option>
                    @foreach ($cats as $cat )
                        <option class="w-full text-black" value="{{$cat->id}}">{{$cat->category_name}}</option>
                    @endforeach
                   </select>
                </div>
                <div class="inputs">
                    <label for="">Comptoire</label>
                   <select name="mart" class="w-full" id="">
                        <option class="w-full text-black" selected value="{{$mart->id}}">{{$mart->mart_name}}</option>
                    
                   </select>
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
        </div>

        <button class="btn w-30 bg-green-500 p-2 rounded-md text-white" type="submit">
            <i class="fa-solid fa-floppy-disk"></i>  Envoyer
        </button>
    </form>
    </div>
</div>
<script>
</script>
@endsection