<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Page;
use App\Domain\Child;
use App\GiftPurchase;
use App\GiftMessages;
use Carbon\Carbon;


class LiveGiftController extends Controller
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
	 * Show live gift page.
	 *
	 * @return live page view
	 */
	public function index($slug)
	{
		$page =  Page::where('slug', $slug)->first();
		$page->hydrateGifts();
		return view('site.live-gift-page.live-gift', compact('page'));
	}
    
    /**
     * Post message
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return json child info
     */
    public function sendMessage(Request $request) {
       
        $message = strip_tags($request->input('message'));
        $childs_id = $request->id;
        $formname = $request->name;
        
        $child_info =  Child::where('id', $childs_id)->first();
        
        $giftMessages = new GiftMessages;
        $giftMessages->child_info_id =  $childs_id;
        $giftMessages->message = $message;
        $giftMessages->name = $formname;
        $giftMessages->save();
        return response()->json(['child' => $child_info]);
        
        
    }
    
    /**
     * Create cart
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return json success
     */
    public function cart(Request $request) {
       
        $amount = $request->amount;
        $gift_page_id = $request->gift_page_id;
        $gift_id = $request->gift_id;
        $session_id = session()->getId();
        
        $gift_purchase = GiftPurchase::updateOrCreate(
            ['session_id' => $session_id, 'status' => 1, 'gift_id' => $gift_id],
            ['status' => 1, 'amount' => $amount,'gift_page_id' => $gift_page_id, 'gift_id' => $gift_id]
            );
        
        return response()->json(['success' => 1]);
     
        
    }
    
    /**
     * Current Date Time String
     * 
     * @param  $field time
     * 
     * return json Date Time String
     */
    public function time($t){
        
        $mytime = Carbon::now();
        return $mytime->toDateTimeString();
        
    } 
   

}