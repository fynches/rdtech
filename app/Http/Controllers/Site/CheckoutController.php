<?php
namespace App\Http\Controllers\Site;

include(app_path() . '/Libraries/Stripe/init.php');

use App\Domain\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Domain\Purchase;
use Validator;
use Stripe\Charge;
use Stripe\Error\Card;
use Stripe\Stripe;
use Stripe\Token;

class CheckoutController extends Controller
{
    public function __construct()
    {
    	
    }

	public function index()
	{
		$purchases = Purchase::where('session_id', session()->getId())->where('status', 1)->get();
		$pageTotal = 0;
		foreach($purchases as $purchase)
		{
		    $page = $purchase->page;
		    $pageTotal += $purchase->amount;
		}
		return view('site.checkout.checkout', compact('purchases', 'page', 'pageTotal'));
	}

	public function checkoutsuccess()
	{
		$session_id = session()->getId();
		$email = Purchase::where('session_id',  $session_id)->first();
		return view('site.checkout.checkout-success', compact('email'));
	}

	public function remove(Request $request){
		$purchase_id = $request->gift_id;
		$destroy = Purchase::destroy($purchase_id);
		return response()->json(['result' => $purchase_id]);
	}

	public function order(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'number' => 'required',
			'month' => 'required',
			'year' => 'required',
			'cvv' => 'required',
			'address' => 'required',
			'city' => 'required',
			'state' => 'required',
			'zip' => 'required',
			'email' => 'required|email|confirmed'
		], [
			'name.required' => "The card holder name is required",
			'number.required' => "The credit card number is required",
			"month.required" => "The expiration month is required",
			"year.required" => "The expiration year is required",
			"cvv.required" => "The security code is required",
			"address.required" => "The street address is required",
			"city.required" => "The city is required",
			"state.required" => "The state is required",
			"zip.required" => "The zip code is required",
			"email.required" => "The email is required",
			"email.email" => "The email address is not properly formatted",
			"email.confirmed" => "The email addresses do not match"
		]);
		if($validator->fails())
		{
			return response()->json([
				'errors' => $validator->errors()->all(),
				'status' => 'fail'
			]);
		}

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
		$message = $request->message;
		$error = null;
		$stripeData = null;
		$returnData = [
			'errors' => [],
			'status' => 'success'
		];
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
			$returnData['errors'][] = $e->getMessage();
			$returnData['status'] = 'fail';
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
		if(count($returnData['errors']))
		{
			return response()->json($returnData);
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
			$purchase->message = $message;
			$purchase->save();
		}
		return response()->json($returnData);
	}
      
    
}