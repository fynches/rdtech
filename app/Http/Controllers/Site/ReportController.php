<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\UserMeta;
use App\Gift;
use App\GiftPage;
use DateTime;

class ReportController extends Controller
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
     * Show report view.
     * 
     * @param  @field child name
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug){
        
        if (Auth::check()) {
            
            $user = Auth::user();
            
                $gift_page = GiftPage::where('user_id',$user->id)->where('slug', $slug)->first();
                
                $purchases = $gift_page->purchases->sum('amount');
                $purchases = number_format((float)$purchases, 2, '.', '');
                
                $requested = 0;
                if(isset($gift_page->added_gifts)) {
                    $added_gifts_ids = unserialize($gift_page->added_gifts);
                    $added_gifts = Gift::whereIn('id',$added_gifts_ids)->get();
                    
                    foreach($added_gifts as $gifts){
                        $amount[] = $gifts->price;
                    }
                    
                    $requested = array_sum($amount);
                }
                $requested = number_format((float)$requested, 2, '.', '');
                
                $count = $gift_page->purchases->count();
                
                if($count == 0) {
                    $avaerage = 0;
                } else {
                $avaerage = $purchases /$count;
                }
                $avaerage = number_format((float)$avaerage, 2, '.', '');
                
                //Balance Calculation
                
                $now = new DateTime();
                $hold = array();
                $amount = array();
                foreach($gift_page->purchases as $purchase){
                    
                        $created_at = $purchase->created_at;
                        $datetime1 = new DateTime($created_at);//start time
                        $datetime2 = new DateTime();//end time
                        $interval = $datetime1->diff($datetime2);
                        $hours =  (int)$interval->format('%H');
                        
                        if($hours < 72) {
                            $hold[] = $purchase->amount * .10;
                        }
                            $amount[] = $purchase->amount;
                   
                }
                
                $amount = array_sum($amount);
                $gifted = number_format((float)$amount, 2, '.', '');
                
                $hold = array_sum($hold);
                $holding = number_format((float)$hold, 2, '.', '');
                
                $available = $amount - $hold;
                $bank = number_format((float)$available, 2, '.', '');
                
                $gift_purchases = $gift_page->purchases;
   
            	return view('site.report.report', compact('purchases', 'requested', 'count', 'avaerage', 'bank', 'gift_purchases'));
            
        } else {
            
        return redirect()->route('home');
        
        }
        
        
      }
 
}