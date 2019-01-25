<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Domain\Page;
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
		$hold = $total = $previous = 0;
		foreach($user->completedPurchases() as $purchase)
		{
			$created_at = $purchase->created_at;
			$datetime1 = new DateTime($created_at);//start time
			$datetime2 = new DateTime();//end time
			$interval = $datetime1->diff($datetime2);
			$hours =  (int)$interval->format('%H');
			if($hours < 72)
			{
				$hold += ($purchase->amount * .50);
			}
			$total +=  $purchase->amount; //TODO factor in previous withdrawals
		}
		return view('site.redeem.redeem', compact('total', 'hold', 'previous'));
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