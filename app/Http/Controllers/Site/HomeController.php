<?php
namespace App\Http\Controllers\Site;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Offer;
use DB;
use Session;
use Hash;
use Route;
use App\ActivityLog;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Facades\Socialite;
use Yajra\Datatables\Datatables;
use App\Testimonial;
use App\StaticBlock;
use App\Beta_Signup;
use Autologin;
use Response;
use Mail;
use App\EmailTemplates;

class HomeController extends Controller
{
    

    public function index()
    {   
        
        return view('site.index');
    }

     /**
     * Create User
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return info page
     */ 
    public function storeUser(Request $request)
    {
        $data = $request->all();
        
        if($data['password'] != $data['confirm_password']) {
             return back()->withErrors('The password you entered does not match the confirmation password!');
        }

        $validator = \Validator::make($request->all(), [
            'password' => 'required',
            'email' => 'required|email|unique:beta_signup,email',
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all(), 'status' => 0]);
        }

        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        
        
        $userdata = array(
            'email'     => $data['email'],
            'password'  => $data['password']
        );
    
        // attempt to do the login
        if (Auth::attempt($userdata)) {
    
            // validation successful!
            // redirect them to the secure section or whatever
            // return Redirect::to('secure');
            // for now we'll just echo success (even though echoing in a controller is bad)
           // return view('site.account.account_info');
            return redirect()->route('info');
    
        } else {        
    
        return redirect()->route('home');
    
        }
    }
    
    /***********************************************************************************************/
    
    /**
     * Reset Password
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return success or failure
     */
    public function passwordReset(Request $request){
        
       // User class implements UserInterface
       
        $email = $request->email;
        
        $user = User::where('email', '=', $email)->first();
        
        if(!isset($user)) {
            return response()->json(['success' => 0]);
            return;
        }
        
        // http://example.com/autologin/Mx7B1fsUin
        $link = Autologin::to($user, '/password-reset');
        
        $data = array('email' => $email, 'link' => $link, 'user' => $user);
        
        Mail::send( 'emails.reset', $data, function($message) use ($data)
        	{     
        	    
        	    
        	    $subject = 'Fynches Password Reset Link';
        	    
        	    $message->sender('help@ehubsolutions.com', 'eHub Solutions');
        	    $message->from('info@fynches.com');
        	    $message->subject($subject);
        		$message->to($data['email']);
        		
        	});
        	
        if(count(Mail::failures()) > 0){
            return response()->json(['success' => 0]);
        } else {
            return response()->json(['success' => 1]);
        }
        
    }
    
    /**
     * Signup User
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return success or failure
     */
    public function signup(Request $request) {
        
        $email = $request->email;
        $password = $request->password;
        
        if(User::where('email',$email)->exists()) {
            
            return response()->json(['result' => 'email-exists']);
            
        } else {
            
                $user = User::create([
                'email' => $email,
                'password' => Hash::make($password),
                ]);
            
            
                $userdata = array(
                    'email'     => $email,
                    'password'  => $password
                );
        
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                
                return response()->json(['result' => 'user-created']);
        
            } else {        
        
            return response()->json(['result' => 'login-error']);
        
            }
        }
    }
    
    /**
     * Sign in user
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return success or failure
     */
    public function signin(Request $request) {
        
        $email = $request->email;
        $password = $request->password;
        
       
        
        $userdata = array(
                    'email'     => $email,
                    'password'  => $password
                );
        
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                
                return response()->json(['result' => 'login']);
        
            } else {        
        
            return response()->json(['result' => 'login-error']);
        
            }
    }
    /***********************************************************************************************/
    
    /**
     * Login user
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return account info view
     */
    public function loginUser(Request $request)
    {
    // validate the info, create rules for the inputs
    $rules = array(
        'email'    => 'required|email', // make sure the email is an actual email
        'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
    );
    
    // run the validation rules on the inputs from the form
    $validator = Validator::make(Input::all(), $rules);
    
    // if the validator fails, redirect back to the form
    if ($validator->fails()) {
        return Redirect::to('login')
            ->withErrors($validator) // send back all errors to the login form
            ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
    } else {
    
        // create our user data for the authentication
        $userdata = array(
            'email'     => Input::get('email'),
            'password'  => Input::get('password')
        );
    
        // attempt to do the login
        if (Auth::attempt($userdata)) {
    
            // validation successful!
            // redirect them to the secure section or whatever
            // return Redirect::to('secure');
            // for now we'll just echo success (even though echoing in a controller is bad)
           // return view('site.account.account_info');
            return redirect()->route('account');
    
        } else {        
    
        return redirect()->route('home');
    
        }
    
    }
    }
    
    /**
     * Email user after signup
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return send email
     */
    public function SignupMail($email) {
		
        if ($email && $email != "") {
            
	        $email = $email;
			$search = array("[EMAIL]");
            $replace = array($email);
			
	        $params = array(
	            'subject' => 'Fynches Signup',
	            'from' => "amits@techuz.com",
	            'to' => $email,
	            'search' => $search,
	            'replace' => $replace
	        );
	        
			$result = $this->SendEmail($params);
	
	        if ($result == true) {
				return true;
	        } else {
	            return false;
	        }
        } 
    }

    //Added by Devang Mavani
	
	/**
     * Send Email Sigup
     * 
     * @param  @fields
     * 
     * return email message
     */
	public function SendEmail($params) {
		try {
			$sent_mail_to= $params['to'];
			$avatar = public_path()."/assets/pages/img/Fynches_Logo_Teal.png"; 
			$facebooklogo = public_path()."/assets/pages/img/facebook-logo.png"; 
			$twitterlogo = public_path()."/assets/pages/img/twitter-logo.png"; 
			$instagramlogo = public_path()."/assets/pages/img/instagram-logo.png";
			
			$email_template = EmailTemplates::where('slug', '=','beta-signup' )->first();
			
			$search = array("[EMAIL]");
	        $replace = array($sent_mail_to);
				
			$message = str_replace($search, $replace, $email_template["content"]);

			//$message="Thanks for signing up. We’ll keep you up to date on the latest and greatest with Fynches.";
			
			$mail_data = array('content' => $message, 'toEmail' => $params["to"], 'subject' => $params["subject"], 'from' => "team@fynches.com",
					'avatar'=>$avatar,'facebooklogo'=>$facebooklogo,'twitterlogo'=>$twitterlogo,'instagramlogo'=>$instagramlogo);


			$sent = Mail::send('emails.mail-template', $mail_data, function($message) use ($mail_data) {
						$message->from($mail_data['from'], 'Fynches');
						$message->to($mail_data['toEmail']);
						$message->subject($mail_data['subject']);
					});
		
		
			if ($sent == true) {
				return true;
			} else {
				return false;
			}
		} catch(Exception $e){
			echo 'Message: ' .$e->getMessage();
		}
		
    }
}
