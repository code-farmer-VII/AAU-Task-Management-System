<style>
    .reg {
        z-index: 100;
    }
</style>

<div id="editForm" class="reg fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center hidden">
    <div class="relative bg-white rounded-lg shadow-md p-8 w-96">
        <h2 class="text-2xl p-4  font-bold mb-4 ">Update your profile</h2>
        <button onclick="hidEdditForm()" class="absolute top-0 right-0 mr-4 mt-2 text-3xl text-red-500 hover:text-red-700 focus:outline-none"><i class="fas fa-times"></i></button>
        <form id="EdditForm" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')   

            <div>
                <label for="email" class="block text-gray-700 font-bold"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" value="" name="email" id="Profileemail" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2">
                @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-bold"><i class="fas fa-lock"></i> Password</label>
                <input type="password"  name="password" id="password" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2">
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

            <div>
                <label for="phone" class="block text-gray-700 font-bold"><i class="fas fa-phone"></i> Phone</label>
                <input type="text" value="" name="phone" id="phone" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 p-2">
                @error('phone')
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
    function hidEdditForm() {
        document.getElementById('editForm').classList.add('hidden');
    }

    function showEdditForm(email,id){
                document.getElementById('editForm').classList.remove('hidden');

                document.getElementById("Profileemail").value = email;
                
                var form = document.getElementById('EdditForm');
                form.action = "/updateUser/" + id;
    }
</script>






