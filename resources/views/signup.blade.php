<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login page</title>
    <link rel="icon" href="/images/EveamartIco.png">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-orange-200 font-Rob">
    <section class="block m-4 md:mx-60 md:my-10  md:flex rounded-md   bg-white  md:overflow-hidden md:m-24 shadow-lg md:w-2/3" >
        <div class="hidden lg:block  overflow-hidden w-2/3">
            <img src="/images/woman-shopping-legumes-au-supermarche.jpg" class="w-100"  alt="">            
        </div>
        <div class="p-3  block w-11/12">
            <img src="/images/logoEveamart.png" width="200px" alt="">
            <div class=" p-4 ">
                <h1 class="font-National font-bold text-3xl m-1">Salut !! <br>
                Creez votre  Compte.</h1>
                <form method="post" action="{{route('register_store')}}">
                @csrf
                @if ($errors->any())
                <div class="text-red-500">
                  <ul>

                        <script>
                            toastr.error("error");
                        </script>
                  </ul>
                </div>
              @endif
                <div class="  block mt-6">
                    <label for="name" class="font-bold">Nom complet <span class="text-red-600">*</span></label> <br>
                    <input name="name" type="text" class="rounded-lg   h-14 w-full border-gray-300 mt-2 font-thin " placeholder="Entrez votre nom" required>
                    @if($errors->has('name'))
                    <span class="text-red-500">{{$errors->first('name')}}</span>
                    @endif
                </div>
                <div class=" block mt-6">
                    <label for="email" class="font-bold">Email<span class="text-red-600">*</span></label> <br>
                    <input name="email" type="email" class="rounded-lg h-14 w-full border-gray-300 mt-2 font-thin" placeholder="entrez votre email" required>
                    @if($errors->has('email'))
                    <span class="text-red-500">email incorrecte ou deja existante</span>
                    @endif
                </div>
                
                <div class=" block mt-6">
                    <label for="gender" class="font-bold">gender<span class="text-red-600">*</span></label> <br>
                    <input name="gender" type="radio" class="mx-2 "  value="male" required>M
                    <input name="gender" type="radio" class="mx-2" value="female" required>F
                    @if($errors->has('gender'))
                    <span class="text-red-500">genre non renseigne</span>
                    @endif
                </div>
                <div class=" block mt-6">
                    <label for="Phone" class="font-bold">Telephone<span class="text-red-600">*</span></label> <br>
                    <input  name="phone" type="number" class="rounded-lg  h-14 w-full border-gray-300 mt-2 font-thin" placeholder="XXXXXXXXX" required>
                    @if($errors->has('phone'))
                      <span class="text-red-500">numero de telephone trop court</span>
                    @endif
                </div>
                <div class=" block mt-6">
                    <label for="Password" class="font-bold">Mot de passe<span class="text-red-600">*</span></label> <br>
                    <input name="password" type="password" class="rounded-lg h-14 w-full border-gray-300 mt-2 font-thin" placeholder="Mot de passe" required>
                    @if($errors->has('password'))
                    <span class="text-red-500">mot de pass ne correspond pas</span>
                    @endif
                </div>
                <div class=" block mt-6">
                    <label for="CPassword" class="font-bold">Confirmez Mot de passe<span class="text-red-600">*</span></label> <br>
                    <input name="password_confirmation" id="password_confirmation" type="password" class="rounded-lg h-14 w-full border-gray-300 mt-2 font-thin" placeholder="confirmez le mot de passe">
                </div>
                <div class="block py-5 justify-between">
                    <input type="submit" value=" Creer le compte" class="bg-green-400 p-3 rounded-sm  text-white w-11/12 hover:bg-orange-500 transition-all duration-500 ">
                       
                   
                </div>
                <p class="py-2">
                    vous avez  deja un compte ? <a class="text-red-500" href="/login"> connexion</a>
                </p>
            </form>
            </div>
        </div>
    </section>    
</body>
</html>