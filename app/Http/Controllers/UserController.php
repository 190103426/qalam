<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserChangePasswordRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\UserUploadImageRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        return view('client.profile', compact('user'));
    }

    public function update(UserUpdateRequest $request)
    {
        $user = auth()->user();
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        return response()->json(['success' => true]);
    }

    public function changePassword(UserChangePasswordRequest $request)
    {
        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['success' => true]);
    }

    public function uploadImage(UserUploadImageRequest $request)
    {

        $user = auth()->user();
        $file = $request->file('image');
        if ($user->image) {
            unlink(public_path(User::IMAGE_PATH . $user->image));
        }
        $fileName = $user->id . time() . '.' .$file->getClientOriginalExtension();
        $request->image->move(public_path(User::IMAGE_PATH), $fileName);
        $user->image =$fileName;

        $user->save();
        return redirect()->back()->with(['success' => 'Сәтті сақталды']);
    }
}
