<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //

    //Login Page
    public function login_index()
    {
        return view('login');
    }

  

    //Login Process
    public function authenticate(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
        ],
        [
            'email.exists' => "The email you entered hasn't been registered in the system",
        ]);

        //check the login details

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->filled('remember'))) {
           
            
            
            $errors = [
                'password' => 'Invalid password.',
            ];


            //return an error message back to the login page
            throw ValidationException::withMessages($errors);
        }

      
   
            //redirect to dashboard when login is successfu;
            return redirect()->route('admin.home');

      
     

        
       
    }


    //log user out
    public function logout()
    {
        auth()->logout();

        return redirect()->route('login_index');
    }


    //Registration Page
    public function register_page()
    {
        return view('registeration');
    }

    public function store(Request $request)
    {

        try{
            

            //validate inputs
             $data = $request->validate([
                
                 'name' => 'required|max:60',
                'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
                'password' => 'required|confirmed',
               
            ]);
    
            //set up user type either 0 or 1
            $data['user_type'] = 1;
    
            //Create or store registration details
            User::create($data);

            return redirect()->back()->with('success', "Registration was successfully");

        }
        catch(Exception $e)
        {
            return redirect()->back()->withErrors($e->getMessage())->withInput();

        }
        

    }
}
