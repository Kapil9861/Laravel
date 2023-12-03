<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    //Show Register form
    public function create(){
        return view('Users.register');
    }

    //Store new users
    public function store(Request $request){
        $formFields=$request->validate([
            'name'=>['required','min:3'],
            'email'=>['required','email',Rule::unique('users','email')],
            'password'=>['required','confirmed','min:6']
        ]);
        //Hash Password to store the hashed password values
        $formFields['password']=bcrypt($formFields['password']);

        //Creating new users and directly login inside our website creating sessions  
        //create user
        $user=User::create($formFields);
        //Login
        auth()->login($user);

        return redirect('/')->with('message','User created and logged in!');
    }

    //Logout its is generally considered better to have the invalidation
    public function logout(Request $request){
        auth()->logout(); //Removes the autentication information from the User's session
        //So that the other requests are not authenticated basically logout is done
        
        //It's good practice to invalidate the user session and regenerate thier tokens
        //The token is the @csrf token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message','You have been logged out!');
    }

    //Show login form 
    public function login(){

        return view('Users.login');
    }

    //Authenticate User
    public function authenticate(Request $request){
        //To login we must authenticate by validation
        //Here it will be same as of the registration
        $authenticate=$request->validate([
            'email'=>['required','email'],
            'password'=>['required']
        ]);
        //Generate the session id if the authentication is true 
        //Laravel helps all the authentication by auth()
        if(auth()->attempt($authenticate)){
            //We should generate the session id
            $request->session()->regenerate();

            return redirect('/')->with('message','You are successfully logged in!');
        }else{
            return back()->withErrors(['email'=>"Invalid Credentials"])->onlyInput('email');
            //As we doesn't want the to make our email very transparent until the user comes
            //with exact credentials we don't want to let them in
            //Generally sent errors like this won't be good in this case//'message','Invalid User Credentials');
        }
    }
}
