<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//unpkg.com/alpinejs" defer></script>
    <x-metadata></x-metadata>
    <title>Document</title>
</head>
<style>
  .navbar{
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 100; 
  }




</style>
<body>
  <nav class="fixed top-0 right-0 left-0 navbar navbar-expand-lg navbar-light bg-blue-600">
    <div class="container-fluid">
      <a class="navbar-brand btn text-white" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
        <img src="{{ asset('images/aau-logo.jpg') }}"class="boject-fit" alt="Example Image">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-white text-xl cursor-pointer"  aria-current="page" href="#" > <i class="fas fa-user-circle text-white font-bold p-2 text-xl cursor-pointer"> </i>{{$user->name}}</a>
          </li>
        </ul>
        <a href="{{route('retrieveUsers',['id'=>$user->id])}}" class="nav-link text-white text-xl cursor-pointer">
            <i class="fas fa-tachometer-alt"></i>
           My Dash Board
        </a>
     </div>
    </div>
  </nav>

<!---offcanvas--->
  <div class="offcanvas offcanvas-start bg-blue-600" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header ">
      <h5 class="font-bold align-center text-white" id="offcanvasExampleLabel">My Profile</h5>
      <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body ">
      <img src="{{ asset('storage/'.$user->profile_image) }}"class="w-26 h-26 rounded-full mr-4" alt="Example Image">
      <div class="user-info flex items-start mb-4 ">
        <div class="mt-3">
            <h5 class="font-bold text-lg mb-1 text-white">{{$user->name}}</h5>
            <p class="text-white mb-1"><i class="fas fa-envelope pl-2"></i> Email: {{$user->email}}</p>
            <p class="text-white mb-1"><i class="fas fa-door-open pl-2"></i> Position: {{$user->position}}</p>
            <p class="text-white mb-1"><i class="fas fa-venus-mars pl-2"></i> Gender: {{$user->gender}}</p>
            <p class="text-white mb-1"><i class="fas fa-user-tag pl-2"></i> Manager Name: {{$user->manager_name}}</p>
        </div>
    </div>
    </div>
  </div>

  
  <main>
    {{$slot}}
  </main>
  <footer class="bg-blue-600 p-4 text-lg text-white flex justify-center items-center fixed bottom-0 left-0 right-0 p-2 md:p-4 w-full">
    <p class="text-xs md:text-sm cursor-pointer">&copy; 2024 ADDIS ABABA UNIVERSITY. All rights reserved.</p>
  </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
