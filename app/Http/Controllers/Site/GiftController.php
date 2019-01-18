<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\UserMeta;
use App\GiftPage;
use App\ChildInfo;
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
     * Get age by DOB.
     * 
     * @param  @field DOB
     * 
     * @return age in years
     */
    
    public function getAge($then) {
            $then_ts = strtotime($then);
            $then_year = date('Y', $then_ts);
            $age = date('Y') - $then_year;
            if(strtotime('+' . $age . ' years', $then_ts) > time()) $age--;
            return $age;
        }
        
       /**
     * Show Gift Page
     * 
     * @param  @field child_name
     * 
     * @return gift page
     */ 
    public function index($slug){
        
        if (Auth::check()) {
            
            $user = Auth::user();
            $gift_page =  GiftPage::where('slug', $slug)->where('user_id',$user->id)->first();
          
          
            $child_info =  ChildInfo::where('id', $gift_page->child_info_id)->first();
            $child_image = $child_info->recipient_image;
            
            $gifts = Gift::all();
            if($this->getAge($child_info->dob) >= 13) {
                $rec_gifts = Gift::where('for_ages', '>=', 5)->get();
            }
            
            else {
                    foreach($gifts as $i => $gift) {
                    if(in_array($this->getAge($child_info->dob), unserialize($gift->age_range->age_range))) {
                        $rec_gifts[$i] = $gift;
                    }
                }
            }
            
            if(!empty(unserialize($gift_page->favorites))) {
            $favorite_ids = unserialize($gift_page->favorites);
            $favorite_gifts = Gift::whereIn('id',$favorite_ids)->get();
            }
            
            //Added Favorite Gifts
            
            if(!empty(unserialize($gift_page->favorites))) {
            $favorites_gifts_ids = unserialize($gift_page->favorites);
            $favorites_gifts_string = implode(',',$favorites_gifts_ids);
            $favorites = Gift::whereIn('id',$favorites_gifts_ids)->get();
            $custom_gifts = UserGift::where('user_id', $user->id)->whereIn('id',$favorites_gifts_ids)->get();
            foreach($custom_gifts as $gift) {
                if(!isset($gift->gift)) {
                    $newGift = new Gift;
                    $newGift->id = $gift->id;
                    $newGift->name = $gift->name;
                    $newGift->title = $gift->title;
                    $newGift->for_ages = $gift->for_ages;
                    $newGift->price = $gift->price;
                    $newGift->details = $gift->details;
                    $newGift->description = $gift->description;
                    $newGift->published = $gift->published;
                    $newGift->categories = $gift->categories;
                    $newGift->featured = $gift->featured;
                    $newGift->gift_image = $gift->gift_image;
                    $favorites->push($newGift);
                }
                
            }
                $favorite_gifts = $favorites->sortBy(function($model) use ($favorites_gifts_ids){
                    return array_search($model->getKey(), $favorites_gifts_ids);
                });
            }
            
            //End Favorite Gifts
            
            //Added Gifts
            
            if(!empty(unserialize($gift_page->added_gifts))) {
            $added_gifts_ids = unserialize($gift_page->added_gifts);
            $added_gifts_string = implode(',',$added_gifts_ids);
            $added = Gift::whereIn('id',$added_gifts_ids)->get();
            $custom_gifts = UserGift::where('user_id', $user->id)->whereIn('id',$added_gifts_ids)->get();
            foreach($custom_gifts as $gift) {
                if(!isset($gift->gift)) {
                    $newGift = new Gift;
                    $newGift->id = $gift->id;
                    $newGift->name = $gift->name;
                    $newGift->title = $gift->title;
                    $newGift->for_ages = $gift->for_ages;
                    $newGift->price = $gift->price;
                    $newGift->details = $gift->details;
                    $newGift->description = $gift->description;
                    $newGift->published = $gift->published;
                    $newGift->categories = $gift->categories;
                    $newGift->featured = $gift->featured;
                    $newGift->gift_image = $gift->gift_image;
                    $added->push($newGift);
                }
                
            }
                $added_gifts = $added->sortBy(function($model) use ($added_gifts_ids){
                    return array_search($model->getKey(), $added_gifts_ids);
                });
            }
            
            //End Added Gifts
            
            if(!isset($gift_page->id)){
                return redirect()->route('shop');
            }
         
            
            $background_images =  BackgroundImages::all();
            
            
            	return view('site.gift.gift', compact('user', 'gift_page','gifts','background_images', 'rec_gifts', 'favorite_gifts', 'added_gifts', 'added_gifts_ids','child_image'));
            
        } else {
            
        return redirect()->route('home');
        
        }
        
        
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
      public function updateGiftPage(Request $request){
           if (Auth::check()) {
            
            $user = Auth::user();
            
            $gift_title = $request->gft_title;
            $gift_desc = $request->gft_det;
            $gift_date = $request->inp_date;
            $gift_age = $request->inp_age;
            $gift_host = $request->inp_host;
            $slug = $request->slug;
            
            $gift_page = GiftPage::updateOrCreate(
            ['user_id' => $user->id, 'slug' => $slug],
            ['user_id' => $user->id, 'page_title' => $gift_title,'page_desc' => $gift_desc,'page_date' => $gift_date, 'page_hostname' => $gift_host ]
             );
             
             $updated = ChildInfo::updateOrCreate(
            ['user_id' => $user->id, 'gift_page_id' => $gift_page->id],
            ['user_id' => $user->id, 'dob' => $gift_age]
             );
   
            	return response()->json(['result' => $slug]);
            
        } else {
            
        return redirect()->route('home');
        
        }
      }
      
    /**
     * Change background Image Gift Page Ajax
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return jason image url
     */
      public function saveBackgroundImages(Request $request){
        
        if (Auth::check()) {
            
            $user = Auth::user();
            $image_id = $request->image_id;
            $page_id = $request->page_id;
            
            $background = GiftPage::updateOrCreate(
            ['user_id' => $user->id, 'id' => $page_id],
            ['background_id' => $image_id]
             );
            
            return response()->json(['url' => $background->background_image->image_url]);
            
        } else {
            
        return redirect()->route('home');
        
        }
        
        
      }
      
      
    /**
     * Save Profile Image Gift Page Ajax
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     */
      public function saveProfileImage(Request $request) {
          if (Auth::check()) {
              $user = Auth::user();
          }
        $input = $request->image;
        $slug = $request->slug;
        $output = 'public/images/profile_images/' . $slug . '.png';
        file_put_contents($output, file_get_contents($input));
        
        $gift_page = GiftPage::where('slug', $slug)->where('user_id',$user->id)->first();
        
        $child = ChildInfo::updateOrCreate(
            ['gift_page_id' => $gift_page->id],
            ['recipient_image' => '/'.$output]
             );
      }
      
    /**
     * Remove Profile Image Gift Page Ajax
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     */
      public function removeProfileImage(Request $request) {
          
        $slug = $request->slug;
        $output = '/public/front/img/dpImage.png';
        
        $gift_page = GiftPage::where('slug', $slug)->where('user_id',$user->id)->first();
        
        $child = ChildInfo::updateOrCreate(
            ['gift_page_id' => $gift_page->id],
            ['recipient_image' => $output]
             );
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
            
            $child = ChildInfo::updateOrCreate(
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