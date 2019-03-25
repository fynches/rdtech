<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Domain\Child;
use App\Domain\Page;
use App\Domain\Gift;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index(){
        
        if (Auth::check()) {
            
            $user = Auth::user();
            
            return view('site.account.account-info', compact('user'));
            
        } else {
            
            return redirect()->route('home');
        
        }
    }
    
     /**
     * Save Account Info First Name Last name, Ajax
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json success responce
     */
     
     public function storeAccountInfo(Request $request) {
         
        $id = Auth::id(); 
        $user = Auth::user();
        
        $firstName = $request->first_name;
        $lastName = $request->last_name;
        
        $userMeta = UserMeta::updateOrCreate(
            ['user_id' => $id],
            ['user_id' => $id, 'first_name' => $firstName, 
            'last_name' => $lastName
            ]
        );
        
        
        return response()->json(['update' => 'Success']);
     }
    
    
    /**
     * Save Alert Preferences, Ajax.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return json Success responce
     */
    public function storeAlerts(Request $request) {
        
        $id = Auth::id();
        
        $gift_alerts = 0;
        $fynches_updates = 0;
        
        $gift_alerts = $request->gift_alerts;
        $fynches_updates = $request->fynches_updates;
        
        $userMeta = UserMeta::updateOrCreate(
            ['user_id' => $id],
            ['gift_alert' =>  $gift_alerts, 
            'fynches_updates' => $fynches_updates
            ]
        );
        
        return response()->json(['update' => 'Success']);
        
    }
    
    /**
     * Save Privacy Preferences, Ajax.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return json Success responce
     */
    public function storePrivacy(Request $request) {
        
        $id = Auth::id();
        
        $google_visibility = $request->google_search;
        $fynches_visibility = $request->fynches_search;
        
        $userMeta = UserMeta::updateOrCreate(
            ['user_id' => $id],
            ['google_visibility' =>  $google_visibility, 
            'fynches_search_visibility' => $fynches_visibility
            ]
        );
        
        return response()->json(['update' => 'Success']);
        
    }
    
    /**
     * Save Change Password, Ajax.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return json Success responce
     */
    public function storePassword(Request $request)
    {
        $user = Auth::user();
        $current_password = $request->cnpass;
        $new_password = $request->npass;
        if($request->nocn)
        {
	        $user->password = Hash::make($new_password);
	        $user->save();
	        return response()->json(['update' => 'Success']);
        }
        if (Hash::check($current_password, $user->password))
        {
	        $user->password = Hash::make($new_password);
	        $user->save();
	        return response()->json(['update' => 'Success']);
        }
        else
        	{
            return response()->json(['update' => 'not-password']);
        }
    }

    public function createPage(Request $request)
    {
    	$pageExists = Page::where("slug", $request->input('slug'))->exists();
    	if($pageExists)
	    {
	    	return back()->withInput()->with('error', "This link already exists, please choose another.");
	    }
    	$user = Auth::user();
    	$user->first_name = $request->input('hostFirstName');
    	$user->last_name = $request->input('hostLastName');
    	$user->save();
    	$child = Child::create(
            [
                'user_id' => $user->id,'first_name' =>  $request->input('childName'),
                'dob' => $request->input('dob'), 'image' => '/front/img/dpImage.png'
            ]
        );
        $page = Page::create(
            [
                'child_id' => $child->id, 'hostname' =>  $request->input('hostFirstName') . ' ' . $request->input('hostLastName'),
                'slug' => $request->input('slug'), 'date' => $request->input('eventDate')
            ]
        );
        return redirect('/gift/'.$page->slug);
    }
    
    /**
     * Save Host Child info, Ajax.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return json Success responce
     */
    public function storeHostChild(Request $request) {
        
        $id = Auth::id();
        
            $host_fname = $request->host_fname;
            $host_lname = $request->host_lname;
            $child_fname = $request->child_fname;
            $child_age = $request->child_age;
            
        $child = Child::updateOrCreate(
            ['user_id' => $id,'first_name' =>  $child_fname],
            ['user_id' => $id,'first_name' =>  $child_fname, 
            'age_range' => $child_age
            ]
        );    
            
        $page = Page::updateOrCreate(
            ['user_id' => $id, 'child_info_id' => $child->id],
            ['user_id' => $id,'page_hostname' =>  $host_fname.' '.$host_lname,
            'child_info_id' => $child->id
            ]
        );    
        
        Child::updateOrCreate(
            ['user_id' => $id,'first_name' =>  $child_fname],
            ['user_id' => $id,'first_name' =>  $child_fname, 
            'age_range' => $child_age, 'gift_page_id' => $page->id 
            ]
        );
        
        return response()->json(['update' => 'Success']);
        
    }
    
    /**
     * Save Event Location, Ajax.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return json Success responce
     */
    public function storeLocation(Request $request) {
        
        $id = Auth::id();
        
            $not_decided = $request->not_decided;
            $event_publish_date = $request->party_time;
            $zipcode = $request->zip_code;
            $child = $request->child;
        
  
        $child = Child::updateOrCreate(
            ['user_id' => $id, 'first_name' =>  $child],
            ['child_zipcode' => $zipcode]
        );
        
        Page::updateOrCreate(
            ['user_id' => $id, 'child_info_id' => $child->id],
            ['page_date' => $event_publish_date
            ]
        );
        
        return response()->json(['update' => 'Success']);
        
    }
    
    /**
     * Save custom Link, Ajax.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return json Success responce
     */
    public function storeLink(Request $request) {
        
        $id = Auth::id();
        
            $gift_link = $request->gift_link;
            $child = $request->child;
        
        $child = Child::where('user_id',$id)->where('first_name', $child)->first();
        
        Page::updateOrCreate(
            ['user_id' => $id, 'child_info_id' => $child->id],
            ['slug' =>  $gift_link]
        );
        
        $input = $request->pic_src;
        $output = 'public/images/profile_images/' . $gift_link . '.png';
        file_put_contents($output, file_get_contents($input));
        
        Child::updateOrCreate(
            ['id' => $child->id, 'user_id' => $id],
            ['recipient_image' => 'http://fynches.codeandsilver.com/public/images/profile_images/' . $gift_link . '.png']
        );
        
        return response()->json(['update' => 'Success']);
        
    }
    
   
    
}