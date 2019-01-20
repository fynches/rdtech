<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\UserMeta;
use App\Domain\Page;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	
    }

   /**
     * Show seach view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
            	return view('site.search.search');
       
      }
	
	 /**
     * Get Search results
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return json page info
     */
	public function search(Request $request) {
	   
	    $lastName = $request->lastName;
	    
	    if(($giftPages = Page::where('page_hostname','LIKE',"%$lastName"))->exists()) {
	        $giftPages = $giftPages->get();
    	    foreach($giftPages as $i => $page) {
    	        $childInfo[$i] = $page->child;
    	    }
	    }
	    else {
	        $giftPages = null;
	        $childInfo = null;
	    }
	    
	    return response()->json(['giftPages' => $giftPages,'childInfo' => $childInfo]);
	    
	}    
	    
  
	
    
}