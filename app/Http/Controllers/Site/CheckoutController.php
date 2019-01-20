<?php
namespace App\Http\Controllers\Site;

include(app_path() . '/Libraries/Stripe/init.php');

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\UserMeta;
use App\GiftPurchase;
use App\Domain\Page;

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
        $gift_purchases = GiftPurchase::where('session_id', session()->getId())->where('status', 1)->get();
        //foreach($gift_purchase as $purchase)
        //{
        //    $gift_page = GiftPage::where('id', $purchase->gift_page_id)->first();
        //}
        
        $page_total = 0;
        //$page_purchuse = GiftPurchase::where('gift_page_id', $gift_page->id)->get();
        
        if(isset($page_purchase->amount)){
            $page_total = $page_purchase->sum('amount');
        }
        
        $session_total = $gift_purchase->sum('amount');
        
        $count = count($gift_purchase);
   
        return view('site.checkout.checkout', compact('gift_purchase', 'session_total', 'count', 'gift_page', 'page_total'));
        
        
      }
      
      /**
     * Show checkout success.
     *
     * @return checkout view
     */
      public function checkoutsuccess(){
            
            $session_id = session()->getId();
            
            $email = GiftPurchase::where('session_id',  $session_id)->first();
   
            return view('site.checkout.checkout-success', compact('email'));
        
      }
      
      /**
     * Remove Purchase.
     *
     * @return jason purchase id removed
     */
      public function remove(Request $request){
          
            $purchase_id = $request->gift_id;
            
            $destroy = GiftPurchase::destroy($purchase_id);
            
            return response()->json(['result' => $purchase_id]);
       
      }
      
        /**
     * Peocess Purchase via Stripe.
     *
     * @return jason successful purchase
     */
      public function order(Request $request){
          
            $purchase_id = $request->gift_id;
            $name = $request->name;
    	    $number = $request->number;
    	    $month = $request->month;
    	    $year = $request->year;
    	    $cvv = $request->cvv;
    	    $fname = $request->fname;
    	    $lname = $request->lname;
    	    $address = $request->address;
    	    $city = $request->city;
    	    $state = $request->state;
    	    $zip = $request->zip;
    	    $country = $request->country;
    	    $email = $request->email;
    	    $confirm = $request->confirm;
    	    $total = $request->total;
    	    $anonymous = $request->anonymous;
    	    $prchs = $request->prchs;
    	    
    	    $total = $total * 100;
    	    
    	    try {
    	    
            \Stripe\Stripe::setApiKey('sk_test_CodDvEhYBltGPceiNe9S4Syo');
            
            $token = \Stripe\Token::create(array("card" => array("number" => $number, 
                                                                "exp_month" => $month, 
                                                                "exp_year" => $year, 
                                                                "cvc" => $cvv,
                                                                "name" => $name,
                                                                "address_line1" => $address,
                                                                "address_city" => $city, 
                                                                "address_state" => $state, 
                                                                "address_zip" => $zip
                                                                )));
                                                                
            $charge = \Stripe\Charge::create(['amount' => $total, 'currency' => 'usd', 'source' => $token]);
            
            $session_id = session()->getId();
            
            //$purchases = json_decode($prchs, true);
            
            foreach($prchs as $key => $purchase){
                
                GiftPurchase::updateOrCreate(
                ['id' => $key],
                ['status' => 2, 'amount' => $purchase, 'email' => $email]
                );
                
            }
            
            if (Auth::check()) {
            
            $user = Auth::user();
            
                foreach($prchs as $key => $purchase){
                    
                    GiftPurchase::updateOrCreate(
                    ['id' => $key],
                    ['user_id' => $user->id, 'amount' => $purchase, 'email' => $email]
                    );
                    
                }
            
            }
            
            return response()->json(['result' => 'Success - Payment Proccessed', 'success' => 1]);
            
            } catch(Stripe_CardError $e) {
              // Since it's a decline, Stripe_CardError will be caught
              
              return response()->json(['result' => $e->getMessage()]);  
              //print('Status is:' . $e->getHttpStatus() . "\n");
              //print('Type is:' . $err['type'] . "\n");
              //print('Code is:' . $err['code'] . "\n");
              // param is '' in this case
              //print('Param is:' . $err['param'] . "\n");
              //print('Message is:' . $err['message'] . "\n");
            } catch (Stripe_InvalidRequestError $e) {
                return response()->json(['result' => $e->getMessage()]);
              // Invalid parameters were supplied to Stripe's API
            } catch (Stripe_AuthenticationError $e) {
                return response()->json(['result' => $e->getMessage()]);
              // Authentication with Stripe's API failed
              // (maybe you changed API keys recently)
            } catch (Stripe_ApiConnectionError $e) {
                return response()->json(['result' => $e->getMessage()]);
              // Network communication with Stripe failed
            } catch (Stripe_Error $e) {
                return response()->json(['result' => $e->getMessage()]);
              // Display a very generic error to the user, and maybe send
              // yourself an email
            } catch (\Exception $e) {
                return response()->json(['result' => $e->getMessage()]);
              // Something else happened, completely unrelated to Stripe
            }
            
            
       
      }
      
    
}