<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Registration</title>
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>


<body class="h-screen">
    <nav class="bg-blue-600 p-2 ">
        <div class="max-w-7xl mx-auto flex justify-start items-start">
            <div class="flex justify-start">
                <div class="flex items-center">
                    <img src="{{ asset('images/aau-logo.jpg') }}"class="boject-fit" alt="Example Image">
                </div>
                <div class="flex flex-col items-start hidden md:block">
                    <p class="text-white text-4xl mx-4 ">ADDIS ABABA UNIVERSITY</p>
                    <p class="text-white text-xl mx-4">TASK MANAGEMENT SYSTEM</p>
                </div>
            </div>
        </div>
    </nav>
<main class="bg-white flex justify-center items-center mt-32 ">
    <div class="w-full max-w-md">
    <div class="bg-white border  shadow-blue-500  mt-4 rounded px-8 pt-6 pb-8 mb-4 border-blue">
        <h2 class="text-center mb-4 font-bold text-xl"><i class="fas fa-sign-in-alt pr-2" ></i>Login</h2>
        <form method="POST" action="{{route('login')}}">
            @csrf

        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2"><i class="fas fa-envelope"></i> Email address</label>
            <input value="{{old('email')}}" name="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" placeholder="Enter your email">
        </div>
        @error('email')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
        <div class="mb-4">
            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                <i class="fas fa-lock"></i> Password
            </label>
            <div class="relative">
              <input value="" name="password" type="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" placeholder="Enter password">
              <span class="absolute right-0 top-0 mt-3 mr-4">
                  <i id="togglePassword" class="fas fa-eye cursor-pointer"></i>
              </span>
            </div>
            @error('password')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center justify-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-12 rounded-full focus:outline-none focus:shadow-outline"><i class="fas fa-user-plus"></i> LOGIN</button>
        </div>
        </form>
    </div>

    </div>
</main>

<!-- Bootstrap JS 

-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-q6eumY8C3TLV8AOUfGpyim+yKxF5G4ZqV9VI+tgDUE6z5lSevxCfIEdhhnNI5ESb" crossorigin="anonymous"></script>
</body>
<footer class="bg-blue-600 text-white flex justify-center items-center fixed bottom-0 left-0 right-0 p-2 md:p-4 w-full">
    <p class="text-xs md:text-sm">&copy; 2024 ADDIS ABABA UNIVERSITY. All rights reserved.</p>
  </footer>
  
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
  
    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
  </script>
</html>
