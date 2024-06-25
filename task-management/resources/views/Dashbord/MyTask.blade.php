<x-layout :user="$user">
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Task</title>
        <x-metadata></x-metadata>
    </head>
    <style>
        .my-card{
            background-color: #ecfccb;
        }
    </style>
    <body class="bg-white mb-12 pb-12  mt-12 pt-12">
        <div class="container mx-auto mt-12 pt-12">
            <div class="flex flex-col justify-center items-center">
                <h1 class="text-4xl font-extrabolde mb-2">My Assigned Tasks</h1>
            </div>
            <!---this is the card--->
            
            @foreach ($assignedTasks as $task)
            <div class="shadow-md rounded-md p-8 mb-8 my-card">
                <h2 class="text-lg font-semibold mb-4">
                    <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>Task Assign Date: {{ $task->created_at->format('d/m/Y') }}
                </h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 font-semibold">
                            <i class="fas fa-tasks text-blue-500 mr-2"></i> Task Name
                        </p>
                        <p class="text-gray-800">{{ $task->title }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-gray-600 font-semibold">
                            <i class="fa fa-quote-left text-blue-600 mr-3"></i> Task Description
                        </p>
                        <p class="text-gray-800">{{ $task->description }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-gray-600 font-semibold">
                            <i class="fas fa-file text-blue-500 mr-2"></i> Task File
                        </p>
                        <a href="{{ asset('storage/'.$task->file_uri) }}" download class="text-blue-500 hover:underline">Download File</a>
                    </div>
                    
                    <div class="col-span-2">
                        <p class="text-gray-600 font-semibold">
                            <i class="fas fa-exclamation-circle text-yellow-500 mr-2 mb-4 ml-4"></i>progress
                        </p>
            
                        <div class="w-64 bg-gray-200 rounded-full">
                            @if(isset($progress[$task->id]))
                                <div class="bg-blue-500 text-xs leading-none py-1 text-center text-white rounded-full" style="width: {{ $progress[$task->id] }}%;">{{ $progress[$task->id] }}%</div>
                            @else
                                <div class="bg-blue-500 text-xs leading-none py-1 text-center text-white rounded-full" style="width: 0%;">0%</div>
                            @endif
                        </div>                                                                   
                    </div>
                </div>

                <div class="mt-12 flex ">
                    <button onclick="showSubmitTask('{{ $task->id }}','{{$user->id}}','{{ $task->title }}')" class="btn bg-blue-600 hover:bg-blue-400 rounded-lg text-white">Submit Task</button> 
                    <a href="{{ route('mySubmition',['userId'=>$user->id,'taskId'=>$task->id]) }}" class="ml-12 btn bg-red-600 hover:bg-red-400 rounded-lg text-white">Submited Tasks</a> 
                 </div>
            </div>
            @endforeach
        </div>
    </body>
    @include('partials.submitTask')

    </html>
</x-layout>
