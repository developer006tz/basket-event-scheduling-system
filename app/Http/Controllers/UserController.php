<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\JimmyTraits;


class UserController extends Controller
{
    use JimmyTraits;
    // Dashboard to list all admin users
    public function adminsDashboard(){
        $data['admins'] = User::all();
        return view('admins.dashboard', $data);
    }

    // Create a new admin user
    public function adminsCreate(Request $request){
        if ($request->isMethod('GET')) {
            return view('admins.create');
        } else {
            $admin = new User();
            $admin->fill($request->all());
            $admin->password = Hash::make($request->password);
            $admin->save();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->extension();
                $this->upload_file($file, $filename);
                $admin->image = $filename;
                $admin->save();
            }
            return redirect('admins')->with('success', 'Admin created successfully');
        }
    }

    // Update an existing admin user
    public function adminsUpdate(Request $request){
        if ($request->isMethod('GET')) {
            $data['admin'] = User::find($request->admin_id);
            return view('admins.update', $data);
        } else {
            $admin = User::find($request->admin_id);
            $admin->fill($request->all());
            if ($request->filled('password')) {
                $admin->password = Hash::make($request->password);
            }
            $admin->save();
            if ($request->hasFile('image')) {
                $this->delete_file($admin->image);
                $file = $request->file('image');
                $filename = time() . '.' . $file->extension();
                $this->upload_file($file, $filename);
                $admin->image = $filename;
                $admin->save();
            }
            return redirect('admins')->with('success', 'Admin updated successfully');
        }
    }

    // Delete an existing admin user
    public function adminsDelete(Request $request){
        $admin = User::find($request->admin_id);
        $this->delete_file($admin->image);
        $admin->delete();
        return redirect('admins')->with('success', 'Admin deleted successfully');
    }
}