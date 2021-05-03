<?php
 
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MailController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\register;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;





class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) 
        {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where('email', $request->input('email'))->first();
           $validare= User::where('is_verified', ('0'))->first();
            
                    if ( !$user || !Hash::check($request->input('password'), $user->password))
                    { 
                    
                        
                        return redirect(route('login'))->withErrors([
                            'login' => 'Email or password is incorrect!'
                        ])->withInput();
                        
                      
                    }

                    if($validare)
                    
                            return redirect(route('login'))->withErrors([
                                'login' => 'Invalid verification code!'
                            ])->withInput();
                    


                
                    
            Auth::login($user);

            return redirect('/dashboard');
        }

        return view('auth/login');
    }

   

    public function register(Request $request)
    {
       
            
             if ($request->isMethod('post')) 
              {
                $email = User::where('email', $request->input('txt_Email'))->first();
                if (!$email)
                { 
                     if($request->txt_RetypePassword==$request->txt_Password)
                        {
                            $user = new User();
                            $user->name = $request->txt_FullName;
                            $user->email = $request->txt_Email;
                            $user->password = Hash::make($request->input('txt_Password'));
                            $user->role=('user');
                            $user->verification_code = sha1(time());
                            $user->save();

                        
                            // $user=User::create([
                            //     'name' =>$request->txt_FullName,
                            //     'email' =>$request->txt_Email,
                            //     'password' => Hash::make($request->input('txt_Password')),
                            //     'role' =>('user'),
                            //     'verification_code'=>sha1(time()), 
                                
                           // ]);
                 
                            if($user != null)
                            {
                                
                            MailController::sendSignupEmail($user->name, $user->email, $user->verification_code);


                            return back()->with('message', 'Your account has been created. Please check email for verification link.');
                            }
                            else
                            {
                           return view('/eroare'); 

                            }
                           
                        }

                          else 
                            {
                                return redirect(route('register'))->withErrors([
                                    'register' => 'Retype Password is incorrect!'
                                ])->withInput(); 
                             }

                             
                 }
                    else
                    {
                
                    return redirect(route('register'))->withErrors([
                        'email' => 'Email exists!'
                        ])->withInput();
                    }

            
            }
            return view('auth/register');
          
        }
       
     public function verificareUser(Request $request)

            {
                $verification_code=\Illuminate\Support\Facades\Request::get('code');
              
                $user = User::where(['verification_code' => $verification_code])->first();
                
                if($user != null)
                {
                    $user->is_verified = 1;
                    $user->save();
                   
                     
                     return redirect(route('login'))->with('message3', 'Your account is verified. Please login!');
                    
                }

                return redirect()->route('login')->with(session()->flash('alert-danger', 'Invalid verification code!'));
            }

           
} 



