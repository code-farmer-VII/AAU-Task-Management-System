<x-generalLayout :user="$user">
    
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
        .table-heade{
            background-color: #d9f99d;
        }
        .table-no-border{
            border-color: #d9f99d
        }
    </style>
    <body class="bg-white-100 mt-12 pt-12">
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold mb-4">Employees</h2>
            <div class="overflow-x-auto">
                <table class="table-auto border-collapse border border-blue-400 w-full table table-striped table-hover">
                    <thead class="table-no-border">
                        <tr class="table-heade">
                            <th class="text-lg border-t border-b">Number</th>
                            <th class="text-lg border-t border-b">Name</th>
                            <th class="text-lg border-t border-b">Phone</th>
                            <th class="text-lg border-t border-b">Email</th>
                            <th class="text-lg border-t border-b">position</th>
                            <th class="text-lg border-t border-b">Assigned tasks</th>
                            <th class="text-lg border-t border-b">Assign Tasks</th>
                            <th class="text-lg border-t border-b">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <x-myEmployee :users="$users" :user="$user" />
                    </tbody>
                </table>                
            </div>
        </div>

        <x-employeeRegister></x-employeeRegister>

        <x-edditProfile></x-edditProfile>

        @include('partials.assignTask')


        <script>

             function showRegistrationForm(name) {
                    document.getElementById('registrationForm').classList.remove('hidden');
                    document.getElementById('manager').value = name;

            }
        
            function showEdditForm(email,id){
                document.getElementById('editForm').classList.remove('hidden');

                document.getElementById("Profileemail").value = email;
                
                var form = document.getElementById('EdditForm');
                form.action = "/updateUser/" + id;
            }
        
        
            function showAssignForm(patientName) {
                document.getElementById('assignForm').classList.remove('hidden');
                document.getElementById('patient_name').value = patientName;
            }
        
        </script>
      


    




    </body>
    </html>
</x-generalLayout>