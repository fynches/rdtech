<?php

namespace App\Http\Controllers\Site;

use App\Domain\StripeAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;
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
		$totals = $user->getGiftTotals();
		$totals['user'] = $user;
		return view('site.redeem.redeem', $totals);
	}

	public function doRedeem(Request $request)
	{
		$validator = StripeAccount::getValidator($request);
		if ($validator->fails())
		{
			return redirect('redeem-gifts')
				->withErrors($validator)
				->withInput();
		}
		$accountStatus = StripeAccount::createNewAccountFromRequest($request);
		if($accountStatus['error'])
		{
			return redirect('redeem-gifts')
				->withErrors(['message' => $accountStatus['error']])
				->withInput();
		}
		$totals = Auth::user()->getGiftTotals();
		$processStatus = StripeAccount::processTransfer($accountStatus['account'], $totals['available']);
		if($processStatus['error'])
		{
			return redirect('redeem-gifts')
				->withErrors(['message' => $processStatus['error']])
				->withInput();
		}
		return view('site.redeem.redeem-success', ['transfer' => $processStatus['transfer']]);
	}
      
      /**
     * Payout Success
     * 
     * return redeem view
     */
	public function success(Request $request)
	{
		return view('site.redeem.redeem-success', compact('user'));
	}
        
    
}