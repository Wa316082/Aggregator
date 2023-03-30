<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Image;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo ( ) {
        if ( Auth() -> user() -> role_id == 1 ) {
            return route ( 'admin.dashboard' ) ;
        }
        elseif ( Auth() -> user() -> role_id == 2 )
        {
            return route( 'user.dashboard') ;
        }
        elseif ( Auth() -> user() -> role_id == 3 )
        {
            return route( 'merchant.dashboard') ;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'image' => ['required', 'string'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)

    {

        // dd($request->all());
        if(request()->hasFile('image')){
            $image = $data['image'];
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(400, 400)->save('upload/user-profile/' . $name_gen);
            $save_url = 'upload/user-profile/' . $name_gen;
        }else{
            $save_url= 'upload/Avatar/avatar.png';
        }

        return User::create([

            'firstname'     => $data['firstname'],
            'lastname'      => $data['lastname'],
            'username'      => $data['username'],
            'role_id'       => 3,
            'email'         => $data['email'],
            'image'         => $save_url,
            'password'      => Hash::make($data['password']),
        ]);

        // dd($user);
    }
}
