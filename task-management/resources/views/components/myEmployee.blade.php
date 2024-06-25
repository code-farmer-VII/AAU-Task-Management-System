@php
    $number = 1;
    $managerId=$user->id
@endphp
@foreach($users as $user)
<tr>
    <td class="border ">{{$number}}</td>
    <td class="border ">{{$user->name}}</td>
    <td class="border ">{{$user->phone}}</td>
    <td class="border ">{{$user->email}}</td>
    <td class="border ">{{$user->position}}</td>
    <td class="border "><a href="{{route('AssignedTask',['userId'=>$user['id'],'managerId'=>$managerId])}}" class="border-2 border-gray-900  border hover:bg-gray-300 font-semibold  pe-4 pl-4 rounded-md"> Assigned Tasks</a></td>
    <td class="border "><button onclick="showAsignTask('{{$user->id}}')" class="border-2 border-gray-900  border hover:bg-gray-300 font-semibold  pe-4 pl-4 rounded-md">Assign Task</button></td>
    <td class="border "><a href="{{route('usersDestroy',['id'=>$user['id']])}}" class="bg-red-500 hover:bg-red-600 text-white pe-4 rounded-md focus:outline-none"> <i class="fas fa-trash pl-6"></i></a></td>
    @php
    $number++;
   @endphp
</tr>
@endforeach

