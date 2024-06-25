<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    //
    public function register(Request $request){
        
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'phone' => 'nullable|string',
            'position' => 'nullable|string',
            'gender' => 'nullable|string',
            'manager_name' => 'nullable|string',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->position = $request->position;
        $user->gender = $request->gender;
        $user->manager_name = $request->manager_name;

        if ($request->hasFile('profile_image')) {
            $user->profile_image = $request->file('profile_image')->store('profile_images', 'public');
        }

        $user->save();

        return redirect()->back()->with('success', 'Employee is successfully registered');
    }

    public function login(Request $request)
    { 
        

        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);


        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();
            $user = auth()->user();
            return redirect()->route('retrieveUsers', ['id' => $user->id]);
        }


        return back()->withErrors(['email' => 'Invalid Credentials'])->withInput(request()->only('email'));
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::route('welcome')->with('message', 'You have been logged out!');
    }

    public function editProfile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'image_uri' => 'nullable|string',
            'phone' => 'nullable|string',
            'position' => 'nullable|string',
            'gender' => 'nullable|string',
            'manager_name' => 'nullable|string',
            'password' => 'required|string|min:6',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->image_uri = $request->image_uri;
        $user->phone = $request->phone;
        $user->position = $request->position;
        $user->gender = $request->gender;
        $user->manager_name = $request->manager_name;
        $user->save();

        return redirect()->back()->with('success', 'Profie is successfully eddited');
    }

    public function retrieveUsers($id)
    {
         
        $user = User::findOrFail($id);
        $users = User::where('manager_name', $user->name)->latest()
        ->when(request('search'), function ($query) {
            $search = request('search');
            return $query->where('name', 'like', "%$search%");
        })
        ->get();

         return view('Dashbord.Employee', ['users' => $users, 'user' => $user])->with('session', 'User created');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Deleted is successfully');

    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $request->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|confirmed|min:6', 
            'phone' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
 
        ]);
    
        $user->email = $request->email;
    
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }
        
        if ($request->filled('phone')) {
            $user->phone = $request->phone;
        }
    

        if ($request->hasFile('profile_image')) {
            $user->profile_image = $request->file('profile_image')->store('profile_images', 'public');
        }
        $user->save();
    
        return redirect()->back()->with('success', 'User updated successfully');
    }
}
