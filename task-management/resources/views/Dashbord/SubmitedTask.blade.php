<x-layout :user="$manager">
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Task</title>
     <x-metadata></x-metadata>
    </head>
    <style>
        .task-card{
            background-color: #ecfccb;
        }
    </style>
    <body class="bg-white mb-12 pb-12  mt-12 pt-12">
        <div class="container mx-auto mt-12 pt-12">
            <div class="flex flex-col justify-center items-center">
                <h1 class="text-4xl font-extrabolde mb-2">Submited Tasks</h1>
                <h1 class="text-xl font-semibold mb-2">{{$user->name}}</h1>
                <h1 class="text-xl font-semibold mb-2">{{$user->email}}</h1>
            </div>
            
        <!---this is the card--->
        @foreach ($SubmitedTask as $task)
            <div class="shadow-md rounded-md p-8 mb-8 task-card">
                <h2 class="text-lg font-semibold mb-4">
                    <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>Submited Date: {{ $task->created_at->format('d/m/Y') }}
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
                            <i class="fa fa-quote-left text-blue-600 mr-3"></i>Submited Task Description
                        </p>
                        <p class="text-gray-800">
                            {{ $task->description }}
                        </p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-gray-600 font-semibold">
                            <i class="fas fa-file text-blue-500 mr-2"></i>Submited File
                        </p>
                        <a href="{{ asset('storage/'.$task->file_uri) }}" download class="text-blue-500 hover:underline">Download File</a>
                    </div>
                    
                    <div class="col-span-2">
                        <p class="text-gray-600 font-semibold">
                            <i class="fas fa-exclamation-circle text-yellow-500 mr-2 mb-4 ml-4"></i>Progress
                        </p>
                        @if (!isset($task->progress))
                        <div class="w-64 bg-gray-200 rounded-full">
                            <div class="bg-blue-500 text-xs leading-none py-1 text-center text-white rounded-full" style="width: 0%;">0%</div>
                        </div> 
                        @else
                        <div class="w-64 bg-gray-200 rounded-full">
                            <div class="bg-blue-500 text-xs leading-none py-1 text-center text-white rounded-full" style="width: {{ $task->progress }}%;">{{ $task->progress }}%</div>
                        </div> 
                        @endif
                    </div>


                    <div class="col-span-2">
                        <form method="POST" action="{{ route('feedback', ['submitId' => $task->id]) }}" class="text-gray-600 font-semibold flex flex-col">
                            @csrf 
                            <label for="comment" id="comment">Comment</label> 
                            <input type="text" name="comment" id="comment" placeholder="Enter a comment" class="p-4 my-2">
                            <label for="progress" id="progress">Progress</label> <!-- Changed id to 'progress' -->
                            <input type="number" name="progress" id="progress" placeholder="Enter the progress rate" class="p-4 my-2">
                            <input type="submit" value="submit" class="bg-blue-600 text-white mt-4 hover:bg-blue-500">
                        </form>
                        
                    </div>
                </div>

            </div>
        @endforeach




        </div>
    </body>
    @include('partials.submitTask')

    </html>
</x-layout>
