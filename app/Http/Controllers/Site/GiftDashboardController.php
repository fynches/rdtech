<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Page;
use App\Offer;
use App\Company;
use App\Templates;
use DB;
use Session;
use Route;
use App\ActivityLog;
use Auth;
use Yajra\Datatables\Datatables;
use App\Site;
use App\GiftPurchase;
use App\Experience;
use App\FundingReport;
use App\Testimonial;


class GiftDashboardController extends Controller
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
     * @return view
     */
    public function index()
    {
        $user = Auth::user();
    	return view('site.gift-dashboard.index', compact('user'));
	} 
	
	/**
     * Show gifted dashboard.
     *
     * @return view
     */
	public function gifted()
	{
	    if (Auth::check()) {
            
        $user = Auth::user();
        
	    $purchases =  GiftPurchase::where('status', 2)->where('user_id', $user->id)->get();
	    
    	return view('site.gift-dashboard.gifted', compact('purchases'));
        }
	}
	
	 /**
     * Delete Gifts
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return json delete success
     */ 
	public function deleteGift(Request $request)
	{
	    if (Auth::check()) {
        
	    Page::destroy($request->gift_page_id);
	    
    	return response()->json(['result' => 'success']);
        }
	}
    
}
