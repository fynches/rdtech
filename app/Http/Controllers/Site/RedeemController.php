<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\UserMeta;
use App\Domain\Gift;
use App\Domain\Page;
use App\GiftPurchase;
use DateTime;

class RedeemController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
	{
		$user = Auth::user();
		$child = $user->child;
		$giftPages = Page::where('child_info_id',$child->id)->get();

		$purchases = array();
		foreach($giftPages as $page)
		{
			$purchases[] = $page->purchases;
		}

		$hold = array();
		$amount = array();
		foreach($purchases as $purchase){
			foreach($purchase as $item){
				$created_at = $item->created_at;
				$datetime1 = new DateTime($created_at);//start time
				$datetime2 = new DateTime();//end time
				$interval = $datetime1->diff($datetime2);
				$hours =  (int)$interval->format('%H');

				if($hours < 72) {
					$hold[] = $item->amount * .50;
				}
				$amount[] = $item->amount;
			}
		}

		$amount = array_sum($amount);
		$gifted = number_format((float)$amount, 2, '.', '');

		$hold = array_sum($hold);
		$holding = number_format((float)$hold, 2, '.', '');

		$available = $amount - $hold;
		$bank = number_format((float)$available, 2, '.', '');

		return view('site.redeem.redeem', compact('gifted', 'holding', 'bank'));
	}
      
      /**
     * Payout Success
     * 
     * return redeem view
     */
      public function success(){
          if (Auth::check()) {
            
            $user = Auth::user();
            
            // Set your secret key: remember to change this to your live secret key in production
            // See your keys here: https://dashboard.stripe.com/account/apikeys
            \Stripe\Stripe::setApiKey("sk_test_CodDvEhYBltGPceiNe9S4Syo");
            
            // Create a payout to the specified recipient
            $payout = \Stripe\Payout::create([
              "amount" => 1000, // amount in cents
              "currency" => "usd",
              "recipient" => $recipient_id,
              "bank_account" => $bank_account_id,
              "statement_descriptor" => "JULY SALES"
            ]);
   
            return view('site.redeem.redeem-success', compact('user'));
            
        } else {
            
        return redirect()->route('home');
        
        }
      }
        
    
}