<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Domain\Child;


class ParentChildController extends Controller
{

	public function index()
	{
		$user = Auth::user();
		return view('site.info.info', compact('user'));
	}
    
    /**
     * Save Onboarding Info
     * 
     * @param  \Illuminate\Http\Request  $request
     */
    public function storeInfo(Request $request)
    {
        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $childFirstName = $request->childFirstName;
        $age = $request->age;
        $date = $request->date;
        $zipcode = $request->zipcode;
        $link = $request->link;
        
        $event = new Event;
        $event->first_name = $firstName;
        $event->last_name = $lastName;
        $event->event_publish_date = date('Y-m-d');
        $event->event_end_date = $date->format('Y-m-d');
        $event->zipcode = $zipcode;
        $event->publish_url = $link;
        
        $background = Child::updateOrCreate(
            ['user_id' => $user->id, 'id' => $page_id],
            ['background_id' => $image_id]
        );
        
    }
    
    
}