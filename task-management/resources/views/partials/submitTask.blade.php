<!-- Assign Form -->
<div id="SubmitTask" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex justify-center items-center hidden">
    <div class="relative bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold mb-4">Submit Task For Employee</h2>
        <button onclick="hideSubmitTask()" class="absolute top-0 right-0  mr-4 text-3xl text-red-500 hover:text-red-700 focus:outline-none"><i class="fas fa-times"></i></button>
        <form method="POST" class="space-y-4" id="submitedForm" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="task_Name" class="block text-gray-700 font-bold"><i class="fa-solid fa-plane-departure"></i> Task Name</label>
                <input type="text" value="" name="task_Name" id="task_Name" class="form-input rounded-md p-2 shadow-sm w-full" placeholder="Enter task name">
                @error('task_Name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="submited_task_description" class="block text-gray-700 font-bold"><i class="fa-solid fa-audio-description"></i> Task Description</label>
                <textarea name="submited_task_description" id="submited_task_description" class="form-textarea rounded-md p-2 shadow-sm w-full" placeholder="Enter task description"></textarea>
                @error('submited_task_description')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="submited_task_file" class="block text-gray-700 font-bold"><i class="fas fa-file"></i> Task File</label>
                <input type="file" name="submited_task_file" id="submited_task_file" class="form-input rounded-md p-2 shadow-sm w-full">
                @error('submited_task_file')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-center">
                <button type="submit" onclick="hideSubmitTask()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md focus:outline-none"><i class="fas fa-check-circle"></i> Send</button>
            </div>
        </form>
    </div>
</div>

<script>
    function hideSubmitTask() {
        document.getElementById('SubmitTask').classList.add('hidden');
    }


    function showSubmitTask(taskid,userId,title) {
        document.getElementById('SubmitTask').classList.remove('hidden');
        document.getElementById('task_Name').value = title
        var form = document.getElementById('submitedForm');
             form.action = "/submitTask/" + taskid + "/user/" + userId;
    }
</script>
