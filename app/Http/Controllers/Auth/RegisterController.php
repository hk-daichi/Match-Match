<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Storage;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_name' => ['required', 'string', 'max:20'],
            'age' => ['required'],
            'facility' => ['required', 'string', 'max:30'],
            'years_of_experience' => ['required'],
            'career' => ['required', 'string', 'max:30'],
            'purpose' => ['required', 'string', 'max:30'],
        ]);
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request)));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  Request $request
     * @return \App\User
     */
    protected function create(Request $request)
    {
        //s3アップロード開始
        $image = $request->file('image');
        // バケットへアップロード
        $path = Storage::disk('s3')->putFile('/', $image, 'public');
        
        $data=$request->all();
        
        return User::create([
            'name' => $data['name'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_name' => $data['user_name'],
            'age' => $data['age'],
            'facility' => $data['facility'],
            'years_of_experience' => $data['years_of_experience'],
            'career' => $data['career'],
            'purpose' => $data['purpose'],
            'img_url' => $path,
        ]);
    }
}
