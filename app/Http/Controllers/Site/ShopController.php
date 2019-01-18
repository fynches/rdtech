<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\UserMeta;
use App\Gift;
use App\UserGift;
use App\GiftPage;
use App\AgeRange;
use DOMDocument;

class ShopController extends Controller
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
     * Show shop view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug){
        
          if (Auth::check()) {
            
            $user = Auth::user();
            $gift_page =  GiftPage::where('user_id', $user->id)->where('slug', $slug)->first();
            
            if(isset($gift_page->added_gifts)) {
                $added_gifts_ids = unserialize($gift_page->added_gifts);
                $added_gifts = Gift::whereIn('id',$added_gifts_ids)->get();
            }
            
            $gifts = Gift::all();
            $custom = UserGift::where('user_id', $user->id)->get();
            
            $custom_gifts = array();
            foreach($custom as $i => $gift) {
                if(!$gift->gift) {
                    $custom_gifts[$i] = $gift;
                }
            }
            	return view('site.shop.shop', compact('user','gifts', 'custom_gifts','gift_page','added_gifts','added_gifts_ids'));
            
            
        } else {
            
        return redirect()->route('home');
        
        }
        
        
      }
      
      /**
     * Show Shop Page by category
     * 
     * @param  $field child_name, category
     * 
     * return category page view
     */ 
     public function indexCategory($slug, $category) {
         if (Auth::check()) {
            
            $user = Auth::user();
            $gift_page =  GiftPage::where('user_id', $user->id)->where('slug', $slug)->first();
            
            if(isset($gift_page->added_gifts)) {
                $added_gifts_ids = unserialize($gift_page->added_gifts);
                $added_gifts = Gift::whereIn('id',$added_gifts_ids)->get();
            }
            
            $gifts = Gift::all();
            $custom = UserGift::where('user_id', $user->id)->get();
            
            $custom_gifts = array();
            foreach($custom as $i => $gift) {
                if(!$gift->gift) {
                    $custom_gifts[$i] = $gift;
                }
            }
            
            $giftControl = new GiftController();
            $age = $giftControl->getAge($gift_page->child->dob);
            $ageRanges = AgeRange::all();
            $age_range = null;
            foreach($ageRanges as $range) {
                if(in_array($age,unserialize($range->age_range))) {
                    $age_range = $range->id;
                }
            }
            if($age >= 13) {
                $age_range = 5;
            }
            	return view('site.shop.shop', compact('user','gifts', 'custom_gifts','gift_page','added_gifts','added_gifts_ids','age_range'));
            
            
        } else {
            
        return redirect()->route('home');
        
        }
     }
	
	 /**
     * Favorite
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return view with favorite
     */    
	public function favorite(Request $request)  {
	    
	    if (Auth::check()) {
            
            $user = Auth::user();
   
        $slug = $request->slug;
        $page_fav = GiftPage::where('user_id',$user->id)->where('slug',$slug)->first();
        $favorites = unserialize($page_fav->favorites);
        $new_fav = $request->id;
        
        if(!empty($favorites)  && in_array($new_fav,$favorites)){
            
            $is_favorite = 1;
            unset($favorites[array_search($new_fav,$favorites)]);
        
       } else if(empty($favorites)) {
            $is_favorite = 0;
            $favorites = array($new_fav);
       }
        else {
        
            $is_favorite = 0;
            array_push($favorites,$new_fav);
        }
        
        $page_fav->favorites = serialize($favorites);
        $page_fav->save();
        
        if(($gift = Gift::where('id',$new_fav))->exists()) {
            if($gift->first()->custom) {
                $gift = $gift->first()->custom;
                $gift->id = $gift->gift_id;
            }
            else {
                $gift  = $gift->first();
            }
        }
        else {
            $gift = UserGift::where('id',$new_fav)->first();
        }
        
        //Added Check
        $added = unserialize($page_fav->added_gifts);
        
        if(!empty($added)  && in_array($new_fav,$added)){
            
            $added = 1;
        
       } else {
           
           $added = 0;
           
       }
        return response()->json(['giftPage' => $page_fav,'gift' => $gift,'business' => $gift->name,'age' => $gift->age_range->age_range,'image' => $gift->gift_image,'favorites' => $favorites, 'is' => $is_favorite, 'added' => $added]);
        } 
	} 
	
	    /**
         * Favorited
         * 
         * @param  \Illuminate\Http\Request  $request
         * 
         * return view with favorited
         */
		public function favorited(Request $request)  {
	    
	    if (Auth::check()) {
            
            $user = Auth::user();
   
        $slug = $request->slug;
        $page_fav = GiftPage::where('user_id',$user->id)->where('slug',$slug)->first();
        $favorites = unserialize($page_fav->favorites);
        $new_fav = $request->id;
        if(!empty($favorites)  && in_array($new_fav,$favorites)){
           
            unset($favorites[array_search($new_fav,$favorites)]);
       } 
        
        $page_fav->favorites = serialize($favorites);
        $page_fav->update();
        
        $gift = Gift::where('id',$new_fav)->first();
        
        return response()->json(['removed' => $new_fav]);
            
        } else {
            
        return redirect()->route('home');
        
        }
	}
	
	/**
     * Add Gift
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return jason gift info
     */
	public function addGift(Request $request) {
          if (Auth::check()) {
            
            $user = Auth::user();
        
        $slug = $request->slug;
        $giftPage = GiftPage::where('user_id',$user->id)->where('slug',$slug)->first();
        $added = unserialize($giftPage->added_gifts);
        $favorites = unserialize($giftPage->favorites);
        $id = (int)$request->id;
        
        if(!empty($added)  && in_array($id,$added)){
            $is_added = 1;
            
       } else if(empty($added)) {
            $is_added = 0;
            $added = array($id);
       }
        else {
        
            $is_added = 0;
            array_push($added,$id);
        }
        
        if(in_array($id,$favorites)) {
            $is_fav = 'favorited-button';
        }
        else {
            $is_fav = 'favorite-button';
        }
        
        $giftPage->added_gifts = serialize($added);
        $giftPage->save();
        
        if(($gift = Gift::where('id',$id))->exists()) {
            
           
                $gift  = $gift->first();
           
        } else {
            
          $gift = UserGift::where('id',$id)->first(); 
            
        }
        
        
        return response()->json(['giftPage' => $giftPage,'gift' => $gift,'business' => $gift->name,'age' => $gift->age_range->age_range,'image' => $gift->gift_image,'added' => $added, 'is' => $is_added, 'favorite' => $is_fav]);
            
        } 
	}
	
	/**
     * Remove Gift
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return jason gift info
     */
	public function removeGift(Request $request) {
          if (Auth::check()) {
            
            $user = Auth::user();
        
        $slug = $request->slug;
        $giftPage = GiftPage::where('user_id',$user->id)->where('slug',$slug)->first();
        $added = unserialize($giftPage->added_gifts);
        $id = (int)$request->id;
        
        if(!empty($added)  && in_array($id,$added)){
            $is_added = 1;
            unset($added[array_search($id,$added)]);
            
       } else {
            $is_added = 0;
        }
        
        $giftPage->added_gifts = serialize($added);
        $giftPage->save();
        
        if(($gift = Gift::where('id',$id))->exists()) {
           
                $gift  = $gift->first();
           
        } else {
            
          $gift = UserGift::where('id',$id)->first(); 
            
        }
        
        return response()->json(['id' => $gift->id,'is' => $is_added,'gift' => $gift]);
            
        } 
	}
	
	/**
     * Sort by ategory
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return jason gift id
     */
	public function category(Request $request){
	    
	    if(Auth::check()) {
            $user_id = Auth::user()->id;
        }
        $categories = $request->categories;
        $ages = $request->ages;
        
        $searchCategories = array();
        $searchAges = array();
        
        $gifts = Gift::all();
        
        foreach($gifts as $i => $gift) {
            $catArray = unserialize($gift->categories);
            if(!empty($categories) && !empty($catArray) && !empty(array_intersect($catArray,$categories))) {
                $searchCategories[$i] = $gift->id;
            }
            if(!empty($ages) && array_search($gift->for_ages,$ages) !== false) {
                $searchAges[$i] = $gift->id;
            }
        }
        
        if(!empty($categories) && empty($ages)) {
            $gift_ids = $searchCategories;
        }
        
        else if(!empty($ages) && empty($categories)) {
            $gift_ids = $searchAges;
        }
        else {
            $gift_ids = array_intersect($searchCategories,$searchAges);
        }
        
        $custom_gifts = UserGift::all();
        
        foreach($custom_gifts as $i => $gift) {
            $catArray = unserialize($gift->categories);
            if(!empty($categories) && !empty($catArray) && !empty(array_intersect($catArray,$categories))) {
                $searchCategories[$i] = $gift->id;
            }
            if(!empty($ages) && array_search($gift->for_ages,$ages) !== false) {
                $searchAges[$i] = $gift->id;
            }
        }
        
        if(!empty($categories) && empty($ages)) {
            $custom_gift_ids = $searchCategories;
        }
        
        else if(!empty($ages) && empty($categories)) {
            $custom_gift_ids = $searchAges;
        }
        else {
            $custom_gift_ids = array_intersect($searchCategories,$searchAges);
        }
        
        $gift_ids = array_merge($gift_ids,$custom_gift_ids);
	       
        return response()->json(['gift_id' => $gift_ids]);
	}
	
	// File get contents curl
	public function file_get_contents_curl($url)
    {
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    
        $data = curl_exec($ch);
        curl_close($ch);
    
        return $data;
    }



    public function getInfo(Request $request) {
        $html = $this->file_get_contents_curl($request->url);
        
        
        $title = null;
        $description = null;
        $image = null;
        
        //parsing begins here:
        $doc = new DOMDocument();
        if(@$doc->loadHTML($html) === false) {
           return response()->json(['title' => null, 'description' => null, 'image' => null]); 
        }
        $nodes = $doc->getElementsByTagName('title');
        $node = $doc->getElementsByTagName('img');
        
        
        //get and display what you need:
        $title = $nodes->item(0)->nodeValue;
        
        $metas = $doc->getElementsByTagName('meta');
        
            for ($i = 0; $i < $metas->length; $i++)
            {
                $meta = $metas->item($i);
                if(strtolower($meta->getAttribute('name')) == 'description')
                    $description = $meta->getAttribute('content');
                if(strtolower($meta->getAttribute('property')) == 'og:image')
                    $image = $meta->getAttribute('content');
            }
            
            if ($image != '') { $image = $image; } 
            else { 
                $image = null;
            }
        
        return response()->json(['title' => $title, 'description' => $description, 'image' => $image]);
}
	
	public function addCustomGift(Request $request) {
	    
	    if(Auth::check()) {
            $user_id = Auth::user()->id;
        }
	    $slug = $request->slug;
	    $url = $request->url;
	    $name = null;
	    $title = $request->title;
	    $description = $request->description;
	    $price = $request->gift_amount;
	    $image  = $request->image;
	    $gift_id = null;
	    $for_ages = 6;
	    $categories = serialize(array());
	    
	    if(($gift = Gift::where('site_url',$url))->exists()) {
	        $gift = $gift->first();
	        $gift_id = $gift->id;
	        $name = $gift->name;
	        $for_ages = $gift->for_ages;
	        $categories = $gift->categories;
	    }
	   
	   $gift = UserGift::updateOrCreate(
    	   ['user_id' => $user_id, 'gift_id' => $gift_id, 'site_url' => $url],
    	   ['description' => $description, 'gift_id' => $gift_id, 
    	   'name' => $name,'title' => $title, 'description' => $description, 
    	   'price' => $price, 'site_url' => $url, 'for_ages' => $for_ages, 'categories' => $categories]
	   );
	   
	   UserGift::updateOrCreate(
    	   ['user_id' => $user_id, 'gift_id' => $gift_id, 'site_url' => $url],
    	   ['gift_image' => 'https://fynches.codeandsilver.com/public/images/user_gift_images/'. $gift->id . '.png']
	   );
	   
	   $gift_page = GiftPage::where('slug', $slug)->where('user_id',$user_id)->first();
	   
	   $added_array = unserialize($gift_page->added_gifts);
	   
	   array_push($added_array, $gift->id);
	   $added_array = serialize($added_array);
	   
	   GiftPage::where('slug', $slug)->where('user_id',$user_id)->update(['added_gifts' => $added_array]);
	   
       $output = 'public/images/user_gift_images/'. $gift->id . '.png';
       file_put_contents($output, file_get_contents($image));
        
        return response()->json(['gift' => $gift]);
        
	}
	
	//public function checkSites($url, $doc) {
	//    
	//   if (strpos($url, 'amazon.com') !== false) {
    //        //$image = $doc->find('div[id="imgTagWrapperId"] img.src', 0);
    //    }
    //    return; //$image;
	//    
	//}
	
	public function test() {
	    
	    if(Auth::check()) {
            $user_id = Auth::user()->id;
        }
	    $slug = 'Jorge';
	    $url = 'amazon.com';
	    $name = null;
	    $title = 'amazon';
	    $description = 'This is a video!';
	    $price = 10.50;
	    $image  = 'https://i.ytimg.com/vi/WHJapDojlaE/maxresdefault.jpg';
	    $gift_id = null;
	    $for_ages = 6;
	    $categories = serialize(array());
	    
	    if(($gift = Gift::where('site_url',$url))->exists()) {
	        $gift = $gift->first();
	        $gift_id = $gift->id;
	        $name = $gift->name;
	        $for_ages = $gift->for_ages;
	        $categories = $gift->categories;
	    }
	   
	   $gift = UserGift::updateOrCreate(
    	   ['user_id' => $user_id, 'gift_id' => $gift_id, 'site_url' => $url],
    	   ['description' => $description, 'gift_id' => $gift_id, 
    	   'name' => $name,'title' => $title, 'description' => $description, 
    	   'price' => $price, 'site_url' => $url, 'for_ages' => $for_ages, 'categories' => $categories]
	   );
	   
	   UserGift::updateOrCreate(
    	   ['user_id' => $user_id, 'gift_id' => $gift_id, 'site_url' => $url],
    	   ['gift_image' => 'https://fynches.codeandsilver.com/public/images/user_gift_images/'. $gift->id . '.png']
	   );
	   
	   $gift_page = GiftPage::where('slug', $slug)->where('user_id',$user_id->id)->first();
	   
	   $added_array = unserialize($gift_page->added_gifts);
	   
	   array_push($added_array, $gift->id);
	   $added_array = serialize($added_array);
	   
	   GiftPage::find($gift_page->id)->update(['added_gifts' => $added_array]);
	   
       $output = 'public/images/user_gift_images/'. $gift->id . '.png';
       file_put_contents($output, file_get_contents($image));
        
        return response()->json(['gift' => $gift]);
        
        
    } 
}