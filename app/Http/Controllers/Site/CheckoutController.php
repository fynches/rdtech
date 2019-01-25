<?php
namespace App\Http\Controllers\Site;

include(app_path() . '/Libraries/Stripe/init.php');

use App\Domain\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Domain\Purchase;
use Stripe\Charge;
use Stripe\Error\Card;
use Stripe\Stripe;
use Stripe\Token;

class CheckoutController extends Controller
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
     * Show checkout.
     *
     * @return checkout view
     */
	public function index()
	{
		$purchases = Purchase::where('session_id', session()->getId())->where('status', 1)->get();
		$pageTotal = 0;

		foreach($purchases as $purchase)
		{
		    $page = $purchase->page;
		    $pageTotal += $purchase->amount;
		}

		//$page_total = 0;
		//$page_purchuse = GiftPurchase::where('gift_page_id', $gift_page->id)->get();

		//if(isset($page_purchase->amount)){
		//	$page_total = $page_purchase->sum('amount');
		//}
		//
		//$session_total = $gift_purchase->sum('amount');
		//
		//$count = count($gift_purchase);

		return view('site.checkout.checkout', compact('purchases', 'page', 'pageTotal'));


	}
      
      /**
     * Show checkout success.
     *
     * @return checkout view
     */
      public function checkoutsuccess(){
            
            $session_id = session()->getId();
            
            $email = Purchase::where('session_id',  $session_id)->first();
   
            return view('site.checkout.checkout-success', compact('email'));
        
      }
      
      /**
     * Remove Purchase.
     *
     * @return jason purchase id removed
     */
      public function remove(Request $request){
          
            $purchase_id = $request->gift_id;
            
            $destroy = Purchase::destroy($purchase_id);
            
            return response()->json(['result' => $purchase_id]);
       
      }
      
        /**
     * Peocess Purchase via Stripe.
     *
     * @return jason successful purchase
     */
	public function order(Request $request)
	{
		$name = $request->name;
		$number = $request->number;
		$month = $request->month;
		$year = $request->year;
		$cvv = $request->cvv;
		$firstName = $request->fname;
		$lastName = $request->lname;
		$address = $request->address;
		$city = $request->city;
		$state = $request->state;
		$zip = $request->zip;
		$country = $request->country;
		$email = $request->email;
		$total = $request->total * 100;
		$purchases = $request->prchs;
		$error = null;
		$stripeData = null;
		try {
			Stripe::setApiKey(env('STRIPE_SECRET'));
			$token = Token::create(array("card" => array("number" => $number,
			                                             "exp_month" => $month,
			                                             "exp_year" => $year,
			                                             "cvc" => $cvv,
			                                             "name" => $name,
			                                             "address_line1" => $address,
			                                             "address_city" => $city,
			                                             "address_state" => $state,
			                                             "address_zip" => $zip
			)));
			$charge = Charge::create(['amount' => $total, 'currency' => 'usd', 'source' => $token]);
			$stripeData = $charge->jsonSerialize();
		}
		catch(Card $e)
		{
			$error = $e->getMessage();
		}
		$payment = Payment::create([
			'firstName' => $firstName,
			'lastName' => $lastName,
			'email' => $email,
			'address' => $address,
			'city' => $city,
			'state' => $state,
			'zip' => $zip,
			'country' => $country,
			'error' => $error,
			'stripe_data' => $stripeData,
			'amount' => $stripeData['amount'],
			'stripe_id' => $stripeData['id'],
			'outcome_type' => $stripeData['outcome']['type'],
			'receipt_url' => $stripeData['receipt_url']
		]);
		if($error)
		{
			return response()->json(['result' => $error]);
		}
		$userId = Auth::check() ? Auth::user()->id : null;
		foreach($purchases as $id => $amount)
		{
			$purchase = Purchase::find($id);
			$purchase->status = 2;
			$purchase->amount = $amount;
			$purchase->email = $email;
			$purchase->user_id = $userId;
			$purchase->payment_id = $payment->id;
			$purchase->save();
		}
		return response()->json(['result' => 'Success - Payment Processed', 'success' => 1]);
	}
      
    
}