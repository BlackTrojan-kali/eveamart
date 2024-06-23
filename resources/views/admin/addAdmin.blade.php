@extends("admin.adminLayout")
@section("content")
<div class="w-full font-Rob bg-slate-300 h-full px-4 md:px-8 py-5">
    <div class="box w-full flex">
     <h2 class="font-bold">Ajouter un Administrateur</h2>
    </div>
    @if(Session::has('success'))
    <script>
        toastr.success("{{Session::get('success')}}");
    </script>
    @elseif ($errors->any())
        @foreach ($errors as $error )
            <script>
                toastr.success("{{$error}}")
            </script>
        @endforeach
    @endif
    <div class="md:flex w-full">
        <form action="{{route("PostAdmin")}}" method="POST" enctype="multipart/form-data" class="w-full md:w-9/12">
            @csrf
            <div class="box w-full md:w-11/12  border border-gray-300">
                <h2 class="font-bold my-5" id="infos-generales">
                    Informations Generales
                </h2>
                <div class="champ ">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" name="username" class="w-full rounded-md my-1 h-9 font-thin" placeholder="entrer le nom d'utilisateur">
                    @if($errors->has('username'))
                    <span class="text-red-500">{{$errors->first('username')}}</span>
                    @endif
                </div>
                <div class="champ ">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="w-full rounded-md my-1 h-9 font-thin" placeholder="entrer l'email">
                    @if($errors->has('email'))
                    <span class="text-red-500">{{$errors->first('email')}}</span>
                    @endif
                </div>
                <div class="champ ">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" class="w-full rounded-md my-1 h-9 font-thin" placeholder="entrer le mot de passe">
                    @if($errors->has('password'))
                    <span class="text-red-500">{{$errors->first('password')}}</span>
                    @endif
                </div>
                <div class="champ ">
                    <label for="confirmed password">Confirmer Mot de passe</label>
                    <input type="password" name="password_confirmation" class="w-full rounded-md my-1 h-9 font-thin" placeholder="confirmer le mot de passe">
                </div>
            </div>
            <div class="box w-full md:w-11/12 border border-gray-300">
                <h2 class="font-bold" id="photo-de-profil">Photo de Profil & Favicon</h2>

                <label for="">Glissez deposez votre photo de profil ici(JPEG,JPG,PNG,WEBP)</label>
                <div class="champ dropzone border-dashed rouded-md ">
                    <input type="file" name="profile" class="" id="myDragAndDropUploader">
                    @if($errors->has('profile'))
                    <span class="text-red-500">{{$errors->first('profile')}}</span>
                    @endif
                </div>
            </div>
            <button class="btn w-30 bg-green-400 p-2 rounded-md text-white" type="submit">
                <i class="fa-solid fa-floppy-disk"></i>  Envoyer
            </button>
        </form>
        <div class="box hidden md:flex  w-3/12 h-80">
            <ul>
                <li><a href="#infos-generales"><i class="fa-solid fa-circle my-5"></i> Infos Generales</a></li>
                <li><a href="#photo-de-profile"><i class="fa-solid fa-circle my-5"></i> Photo de profile</a></li>
                <li><a href="#liste-des-utilisateurs"><i class="fa-solid  fa-circle my-5 "></i> Liste des utilisateurs</a></li>
            </ul>
        </div>
    </div>
    <div id="admins" class="box w-full my-2 text-xs md:text-base overflow-x-scroll">
        <h1 class="font-bold" id="liste-des-utilisateurs">Liste des Administrateurs</h1>
        <table class="table-auto w-full border-collapse p-2">
            <thead>
                <tr class="flex justify-between font-bold p-2">
                <td>profile</td>
                <td>Username</td>
                <td class="hidden md:flex">email</td>
                <td>Role</td>
                <td>action</td>
                </tr>
            </thead>
            <tbody>
            @foreach ($admins as $admin )
            <tr class="flex justify-between p-2 border">
                
                <td><img src="/images/{{$admin->profile}}" class="w-10 h-10 rounded-full mx-2" alt=""></td>
                <td class="mx-2 p-2"> {{$admin->username}} </td>
                <td class="mx-2 p-2 hidden md:flex"> {{$admin->email}}</td>
                <td class="mx-2 p-2"> {{$admin->super ? "Super Admin":"Admin"}}</td>
                <td class="flex gap-2">
                    @if(!$admin->super)
                    <a href="{{route('EditAdmin',$admin->id)}}" class="text-blue-500 text-xl"><i class="fa-regular fa-pen-to-square"></i></a>
                    <form id="{{$admin->id}}">
                        @csrf
                        @method('delete')
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                    <button  class="DeleteAdmin text-red-500 text-xl"><i class="fa-solid fa-trash"></i></button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
</div>
<script>

$(document).ready(function(){
        $(".DeleteAdmin").on("click",function(e){
            e.preventDefault();
            id = $(this).parent().attr("id");
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
       
            Swal.fire({
  title: "Etes Vous sure?",
  text: "cette Operation est Irreversible!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
}).then((result) => {
           
       
  if (result.isConfirmed) {    
            $.ajax({

            type:"DELETE",
            url:"/admin/deleteAdmin/"+id,
            datatype:"json",
            headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      success:function(res){
            toastr.success(res.message)
            $("#admins").load(" #admins")
      },
      error:function(xhr,status,error){
                    toastr.error("something went wrong")
                    console.log(xhr.responseText)

      }
        })
    }
    else{

        toastr.error("Operation annulee")
    }

    });


        })
    })
</script>
@endsection
