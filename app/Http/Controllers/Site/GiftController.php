<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\UserMeta;
use App\GiftPage;
use App\Domain\Child;
use App\BackgroundImages;
use App\Gift;
use App\UserGift;
use App\GiftMessages;
use App\Images;

class GiftController extends Controller
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
     * Show Gift Page
     * 
     * @param  @field child_name
     * 
     * @return gift page
     */ 
    public function index($slug)
    {
        $user = Auth::user();
        $child = $user->child;
        $page =  $user->child->gift_page;
        $page->hydrateGifts();
        $gifts = Gift::all();
        if($child->age >= 13)
        {
            $rec_gifts = Gift::where('for_ages', '>=', 5)->get();
        }
        else
            {
            foreach($gifts as $i => $gift) //TODO - get rid of this loop and make a straight query
            {
                if(in_array($child->age, unserialize($gift->age_range->age_range)))
                {
                    $rec_gifts[$i] = $gift;
                }
            }
        }
        $background_images =  BackgroundImages::all();
        return view('site.gift.gift', compact(
        	'user', 'child', 'page','gifts','background_images', 'rec_gifts'));
      }
      
    /**
     * Make Gift Page Live
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return jason route slug - child_name
     */
      
      public function makeLive(Request $request){
          $user = Auth::user();
          $id = $request->id;
          $gift_page = GiftPage::updateOrCreate(
            ['user_id' => $user->id, 'id' => $id],
            ['live' => 1]
          );
          return response()->json(['slug' => $gift_page->slug]);
      }
      
      
      /**
     * Make Gift Page Private
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return jason route slug - child_name
     */
      public function makePrivate(Request $request){
          $user = Auth::user();
          $id = $request->id;
          $gift_page = GiftPage::updateOrCreate(
            ['user_id' => $user->id, 'id' => $id],
            ['live' => 0]
          );
          return response()->json(['slug' => $gift_page->slug]);
      }

	/**
	 * Gift Page Update Fields Ajax
	 *
	 * @param  \Illuminate\Http\Request  $request
	 *
	 * @return jason route slug - child_name
	 */
	public function updateGiftPage(Request $request)
	{
		$user = Auth::user();
		$child = $user->child;
		$page =  $user->child->gift_page;
		$page->page_title = $request->input('gft_title');
		$page->page_desc = $request->input('gft_det');
		$page->page_date = $request->input('inp_date');
		$page->page_hostname = $request->input('inp_host');
		$page->save();
		$child->dob = $request->input('inp_age');
		$child->save();
		return response()->json(['result' => $request->input('slug')]);
	}
      
    /**
     * Change background Image Gift Page Ajax
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return jason image url
     */
	public function saveBackgroundImages(Request $request)
	{
		$imageId = $request->image_id;
		$pageId = $request->page_id;
		$page = GiftPage::findOrFail($pageId);
		$page->background_id = $imageId;
		$page->save();
		return response()->json(['url' => $page->background_image->image_url]);
	}
      
      
    /**
     * Save Profile Image Gift Page Ajax
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     */
	public function saveProfileImage(Request $request)
	{
		$image = $request->input('image');
		$slug = $request->input('slug');
		$output = '/images/profile_images/' . $slug . '.png';
		file_put_contents(public_path() . $output, file_get_contents($image));
		$page = GiftPage::where('slug', $slug)->first();
		$child = $page->child_info;
		$child->recipient_image = $output;
		$child->save();
	}
      
    /**
     * Remove Profile Image Gift Page Ajax
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     */
	public function removeProfileImage(Request $request)
	{
		$slug = $request->input('slug');
		$page = GiftPage::where('slug', $slug)->first();
		$child = $page->child_info;
		$image = '/front/img/dpImage.png';
		if($child->recipient_image && $child->recipient_image != $image)
		{
			unlink(public_path() . $child->recipient_image);
		}
		$child->recipient_image = $image;
		$child->save();
	}
      
    /**
     * Update Zipcode Gift Page Ajax
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return jason image zipcode
     */
      public function updateChildZipcode(Request $request){
        
        if (Auth::check()) {
            
            $user = Auth::user();
            $child_zipcode = $request->child_zipcode;
            $page_id = $request->page_id;
            
            $child = Child::updateOrCreate(
            ['user_id' => $user->id, 'gift_page_id' => $page_id],
            ['child_zipcode' => $child_zipcode]
             );
            
            return response()->json(['zip' => $child->child_zipcode]);
            
        } else {
            
        return redirect()->route('home');
        
        }
        
        
      }
      
    /**
     * Edit Gift Ajax
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return json gift info
     */
     
      public function editGift(Request $request) {
          
          $id = $request->id;
          
          $gift = Gift::find($id);
          if($gift->custom) {
              $gift = $gift->custom;
          }
          
          return response()->json(['url' => $gift->site_url, 'title' => $gift->title, 'description' => $gift->description, 'image' => $gift->gift_image, 'price' => ($gift->price ? $gift->price : $gift->est_price)]);
      }
      
      /**
     * Set Gift Info Ajax
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return json gift info
     */
       public function giftDetails(Request $request){
           
           $id = $request->id;
           
           $gift = Gift::find($id);
           
           $images = explode(',',$gift->gift_image);
           
           $age_range= $gift->age_range->age_range;
           $btitle = $gift->title;
           $bName= $gift->name;
           $bDet= $gift->details;
           $bDesc = $gift->description;
           $bWeb= $gift->site_url;
           $price = $gift->price;
           
           return response()->json(['images' => $images,'age_range' =>$age_range, 'bTitle' => $btitle,'bName' => $bName, 'website' => $bWeb, 'bDesc' => $bDesc, 'details' => $bDet,'price' => $price, 'address' => array(), 'phone' => array()]);
       }
       
     /**
     * Add Gift Price Ajax
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return json gift price
     */  
      public function addPrice(Request $request) {
          $id = $request->id;
          $price = $request->price;
          
          $gift = Gift::find($id);
          $gift->price = $price;
          $gift->save();
          
          return response()->json(['price' => $gift->price]);
      }
      
      /**
     * Create Gift Page by user Id
     * 
     */
      public function createGiftPage(){
          
          $user = Auth::user();
          
          $child = GiftPage::updateOrCreate(
            ['user_id' => $user->id],
            ['user_id' => $user->id]
          );
          
      }
      
      /**
     * Sort Gifts
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return json sorted gift id
     */ 
      public function giftSort(Request $request) {
          
          if (Auth::check()) {
            $user = Auth::user();
          }
          $ids = $request->ids;
          $slug = $request->slug;
          $giftPage = GiftPage::where('user_id',$user->id)->where('slug',$slug)->first();
        
          $giftPage->added_gifts = serialize($ids);
          $giftPage->save();
          
          return response()->json(['message' => $ids]);
                      
      }
      
	    
}