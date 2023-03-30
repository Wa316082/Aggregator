<?php

namespace App\Http\Controllers\Api;

use Image;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterRequest;

class UserController extends Controller
{

    use HttpResponses;


    //=========== Login function==============


    public function login(Request $request)

    {

        $validated = $request->validate([
            'email' => 'required',
            'password'=>'required',
        ]);

        if($validated){
                $user = User::where('email',$request->email)->first();
                if (!$user || !Hash::check($request->password, $user->password )) {
                    return $this->error(
                        'Your credentials does not match');
                }else{

                        $token = $user->createToken('Api Token of'.$user->email.$user->password)->plainTextToken;

                        $data= compact('token','user');
                    return $this->success(
                        'You are successfully logged in ',
                        $data,
                    );
                }

        }
    }




//================= Logout function ==============

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message'=>'You are logged out'
        ];
    }




//=============Register Function=================


    public function registration(RegisterRequest $request)
    {
        $request->validated($request->all());

        try {
            if(request()->hasFile('image')){
                $image = $request['image'];
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(400, 400)->save('upload/user-profile/' . $name_gen);
                $save_url = 'upload/user-profile/' . $name_gen;
            }else{
                $save_url= 'upload/Avatar/avatar.png';
            }

            $user = new User;
                $user->firstname=$request['firstname'];
                $user->lastname=$request['lastname'];
                $user->username=$request['username'];
                $user->role_id=3;
                $user->email=$request['email'];
                $user->image=$save_url;
                $user->password=Hash::make($request['password']);
                $user->save();

            // $data = compact('user');
            return $this->success(
                'User Created Successfully !',
                $user

            );
        } catch (Throwable $e) {
            return $e;
        }
    }



}
