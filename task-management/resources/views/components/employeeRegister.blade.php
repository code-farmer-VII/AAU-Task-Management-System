<style>
    .reg {
        z-index: 100;
    }
</style>

<div id="registrationForm" class="reg fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center hidden">
    <div class="relative bg-white rounded-lg shadow-md p-8 w-96">
        <h2 class="text-2xl p-4 text-white bg-blue-600 font-bold mb-4 rounded-xl">Registration</h2>
        <button onclick="hideRegistrationForm()" class="absolute top-0 right-0 mr-4 mt-2 text-3xl text-red-500 hover:text-red-700 focus:outline-none"><i class="fas fa-times"></i></button>
        <form id="registrationRouteForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            
                <div>
                    <label for="name" class="block text-gray-700 font-bold"><i class="fas fa-user"></i> Name</label>
                    <input type="text" value="{{ old('name') }}" name="name" id="name" class="block w-full rounded-md border-blue-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 p-2">
                    @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
    
                <div>
                    <label for="manager_name" class="block text-gray-700 font-bold"><i class="fas fa-user-tie"></i> Manager Name</label>
                    <input type="text" value="{{ old('manager_name') }}" name="manager_name" id="manager" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2">
                    @error('manager_name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
        

            <div>
                <label for="email" class="block text-gray-700 font-bold"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" value="{{ old('email') }}" name="email" id="email" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2">
                @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

           <div class="flex flex-row space-x-4">
            <div>
                <label for="password" class="block text-gray-700 font-bold"><i class="fas fa-lock"></i> Password</label>
                <input type="password" name="password" id="password" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2">
                @error('password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div >
                <label for="password_confirmation" class="block text-gray-700 font-bold"><i class="fas fa-lock"></i>Confirmation</label>
                <input type="password_confirmation" name="password_confirmation" id="password_confirmation" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2">
                @error('password_confirmation')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
           </div>

           <div class="flex flex-row space-x-4">
            <div>
                <label for="phone" class="block text-gray-700 font-bold"><i class="fas fa-phone"></i> Phone</label>
                <input type="text" value="{{ old('phone') }}" name="phone" id="phone" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2">
                @error('phone')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="position" class="block text-gray-700 font-bold"><i class="fas fa-briefcase"></i> Position</label>
                <input type="text" value="{{ old('position') }}" name="position" id="position" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2">
                @error('position')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
           </div>

            <div>
                <label for="gender" class="block text-gray-700 font-bold"><i class="fas fa-venus-mars"></i> Gender</label>
                <select name="gender" id="gender" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>



            <div>
                <label for="profile_image" class="block text-gray-700 font-bold"><i class="fas fa-image"></i> Profile Image</label>
                <input type="file" name="profile_image" id="profile_image" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2">
                @error('profile_image')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md focus:outline-none"><i class="fas fa-user-plus"></i> Register</button>
            </div>
        </form>
    </div>
</div>

<script>
    function hideRegistrationForm() {
        document.getElementById('registrationForm').classList.add('hidden');
    }
    function showRegistrationForm(name){
        document.getElementById('manager').value = name;
    }
</script>





<!---
        <script>

        function hideRegistrationForm(reception_id) {
            document.getElementById('registrationForm').classList.add('hidden');

          
            var form = document.getElementById('registrationRouteForm');
             form.action = "/dashboard/reception" + reception_id;
          
        }
    </script>
    --->
