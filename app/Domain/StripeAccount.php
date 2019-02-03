<?php

namespace App\Domain;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Transfer as StripeTransfer;
use Validator;
use Stripe\Account;
use Stripe\Error\InvalidRequest;
use Stripe\Stripe;

class StripeAccount extends Model
{
	use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo('App\Domain\User');
    }

	public function transfers()
	{
		return $this->hasMany('App\Domain\Transfer');
	}

    public static function processTransfer(StripeAccount $account, $amount)
    {
	    Stripe::setApiKey(env('STRIPE_SECRET'));
		$stripeTransfer = StripeTransfer::create([
			'amount' => $amount * 100,
			'currency' => 'usd',
			'destination' => $account->token
		]);
		$transfer = Transfer::create([
			'stripe_account_id' => $account->id,
			'stripe_id' => $stripeTransfer->id,
			'amount' => $stripeTransfer->amount,
			'raw_data' => json_encode($stripeTransfer)
		]);
		return [
			'error' => null,
			'transfer' => $transfer
		];
    }

    public static function createNewAccountFromRequest(Request $request)
    {
    	$error = $stripeAccount = null;
	    $user = Auth::user();
	    $accountData = [
		    'type' => 'custom',
		    'country' => 'US',
		    'email' => $user->email,
		    'external_account' => [
			    'object' => 'bank_account',
			    'country' => 'US',
			    'currency' => 'usd',
			    'account_holder_name' => $request->input('firstName') . ' ' . $request->input('lastName'),
			    'account_holder_type' => 'individual',
			    'bank_name' => $request->input('bankName'),
			    'routing_number' => $request->input('routing'),
			    'account_number' => $request->input('account'),
			    'last4' => $request->input('ss'),
			    'legal_entity' => [
				    'address' => [
					    'line1' => $request->input('address'),
					    'city' => $request->input('city'),
					    'state' => $request->input('state'),
					    'postal_code' => $request->input('zip'),
					    'country' => 'US'
				    ],
				    'dob' => [
					    'day' => $request->input('day'),
					    'month' => $request->input('month'),
					    'year' => $request->input('year')
				    ],
				    'first_name' => $request->input('firstName'),
				    'last_name' => $request->input('lastName'),
				    'ssn_last_4' => $request->input('ss'),
				    'type' => 'individual',
				    'tos_acceptance' => [
					    'date' => now(),
					    'ip' => $request->ip()
				    ]
			    ]
		    ]
	    ];
	    try{
		    Stripe::setApiKey(env('STRIPE_SECRET'));
		    $account = Account::create($accountData);
	    }
	    catch(InvalidRequest $e)
	    {
	    	$error = $e->getMessage();
	    }

	    if(!$error)
	    {
		    $stripeAccount = StripeAccount::create([
			    'user_id' => $user->id,
			    'token' => $account->id,
			    'bank_name' => $account->external_accounts->data[0]->bank_name,
			    'last4' => $account->external_accounts->data[0]->last4,
			    'account_token' => $account->external_accounts->data[0]->account,
			    'address' => $request->input('address'),
			    'city' => $request->input('city'),
			    'state' => $request->input('state'),
			    'zip' => $request->input('zip'),
		    ]);
	    }

	    return [
	    	'error' => $error,
		    'account' => $stripeAccount
	    ];
    }

    public static function getValidator(Request $request)
    {
	    return Validator::make($request->all(), [
		    'bankName' => 'required',
		    'routing' => 'required',
		    'account' => 'required',
		    'day' => 'required',
		    'month' => 'required',
		    'year' => 'required',
		    'firstName' => 'required',
		    'lastName' => 'required',
		    'ss' => 'required',
		    'address' => 'required',
		    'city' => 'required',
		    'state' => 'required',
		    'zip' => 'required',
	    ], [
		    'bankName.required' => "The bank name is required",
		    'routing.required' => "The routing number is required",
		    'account.required' => "The account number is required",
		    'day.required' => "Your birth day is required",
		    "month.required" => "Your birth month is required",
		    "year.required" => "Your birth year is required",
		    "firstName.required" => "Your first name is required",
		    "lastName.required" => "Your last name is required",
		    "ss.required" => "The last 4 of your social security number is required",
		    "address.required" => "The street address is required",
		    "city.required" => "The city is required",
		    "state.required" => "The state is required",
		    "zip.required" => "The zip code is required"
	    ]);
    }

}
