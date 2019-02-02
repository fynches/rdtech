<?php

namespace App\Http\Controllers\Site;

use App\Domain\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Domain\Gift;
use App\Domain\UserGift;
use App\Domain\Page;
use App\AgeRange;
use DOMDocument;
use Illuminate\Support\Facades\DB;

//https://stackoverflow.com/questions/14395239/class-domdocument-not-found

class ShopController extends Controller
{
   /**
     * Show shop view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug){
        
          if (Auth::check()) {
            
            $user = Auth::user();
            $gift_page =  Page::where('user_id', $user->id)->where('slug', $slug)->first();
            
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
	public function indexCategory($slug, $selectedCategory)
	{
		$user = Auth::user();
		$page =  Page::where('slug', $slug)->first();
		$gifts = Gift::getUserGifts($user);
		$categories = Category::all();
		$ages = [
			'1' => '0-2 YRS',
			'2' => '2-5 YRS',
			'3' => '5-8 YRS',
			'4' => '8-13 YRS',
			'5' => '13+ YRS'
		];
		return view('site.shop.shop', compact(
			'gifts','page', 'categories', 'ages', 'selectedCategory'));
	}
	
	 /**
     * Favorite
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return view with favorite
     */
	public function favorite(Request $request)
	{
		$slug = $request->slug;
		$page = Page::where('slug',$slug)->first();

		$favorites = ($page->favorite_gifts) ? $page->favorite_gifts : [];
		$id = (int)$request->id;

		if(!empty($favorites)  && in_array($id,$favorites))
		{
			$is_favorite = 1;
			unset($favorites[array_search($id,$favorites)]);
		}
		else if(empty($favorites))
		{
			$is_favorite = 0;
			$favorites = array($id);
		}
		else
			{
			$is_favorite = 0;
			array_push($favorites,$id);
		}

		$page->favorite_gifts = $favorites;
		$page->save();

		$gift = Gift::find($id);

		$added = $page->added_gifts;
		if(!empty($added)  && in_array($id,$added))
		{
			$added = 1;
		}
		else
			{
			$added = 0;
		}
		return response()->json([
			'giftPage' => $page,'gift' => $gift,'business' => $gift->name,
			'age' => $gift->min_age,'image' => $gift->image,'favorites' => $favorites, 'is' => $is_favorite, 'added' => $added]);

	} 
	
	    /**
         * Favorited
         * 
         * @param  \Illuminate\Http\Request  $request
         * 
         * return view with favorited
         */
	public function favorited(Request $request)
	{
		$slug = $request->slug;
		$page = Page::where('slug',$slug)->first();
		$favorites = $page->favorite_gifts;
		$id = $request->id;
		if(!empty($favorites)  && in_array($id,$favorites)){

			unset($favorites[array_search($id,$favorites)]);
		}
		$page->favorite_gifts = $favorites;
		$page->save();
		return response()->json(['removed' => $id]);
	}
	
	/**
     * Add Gift
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return jason gift info
     */
	public function addGift(Request $request)
	{
		$slug = $request->slug;
		$page = Page::where('slug',$slug)->first();
		$id = (int)$request->id;

		$added = ($page->added_gifts) ? $page->added_gifts : [];
		if(!empty($added)  && in_array($id,$added))
		{
			$is_added = 1;
		}
		else if(empty($added))
		{
			$is_added = 0;
			$added = array($id);
		}
		else
			{
			$is_added = 0;
			array_push($added,$id);
		}
		$page->added_gifts = $added;
		$page->save();

		$favorites = ($page->favorite_gifts) ? $page->favorite_gifts : [];
		if(in_array($id,$favorites))
		{
			$is_fav = 'favorited-button';
		}
		else
			{
			$is_fav = 'favorite-button';
		}

		if(($gift = Gift::where('id',$id))->exists())
		{
			$gift  = $gift->first();
		}
		else
			{
			$gift = UserGift::where('id',$id)->first();

		}

		return response()->json([
			'giftPage' => $page,'gift' => $gift,'business' => $gift->name,'age' => $gift->min_age,
			'image' => $gift->image,'added' => $added, 'is' => $is_added, 'favorite' => $is_fav]);
	}
	
	/**
     * Remove Gift
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return jason gift info
     */
	public function removeGift(Request $request)
	{
		$slug = $request->slug;
		$page = Page::where('slug',$slug)->first();
		$added = $page->added_gifts;
		$id = (int)$request->id;
		$is_added = 0;

		if(!empty($added)  && in_array($id,$added))
		{
			$is_added = 1;
			unset($added[array_search($id,$added)]);
		}

		$page->added_gifts = $added;
		$page->save();

		if(($gift = Gift::where('id',$id))->exists())
		{
			$gift  = $gift->first();
		}
		else
			{
			$gift = UserGift::where('id',$id)->first();
		}
		return response()->json(['id' => $gift->id,'is' => $is_added,'gift' => $gift]);
	}
	
	/**
     * Sort by ategory
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * return jason gift id
     */
	public function category(Request $request)
	{
		$userId = Auth::user()->id;
		$categories = $request->input('categories', []);
		$ages = $request->input('ages', []);

		$query = DB::table('gifts')->select('gifts.id')
			->join('category_gift', 'category_gift.gift_id', '=', 'gifts.id')
			->join('categories', 'categories.id', '=', 'category_gift.category_id')
			->whereRaw("(ISNULL(gifts.user_id) OR gifts.user_id = {$userId})");

		if(count($categories))
		{
			$query->whereIn('categories.identifier', $categories);
		}
		if(count($ages))
		{
			$min = $max = null;
			if(in_array('1', $ages))
			{
				$min = 0;
				$max = 2;
			}
			if(in_array(2, $ages))
			{
				if($min === null)
				{
					$min = 2;
				}
				$max = 5;
			}
			if(in_array(3, $ages))
			{
				if($min === null)
				{
					$min = 5;
				}
				$max = 8;
			}
			if(in_array(4, $ages))
			{
				if($min === null)
				{
					$min = 8;
				}
				$max = 13;
			}
			if(in_array(5, $ages))
			{
				if($min === null)
				{
					$min = 13;
				}
				$max = 18;
			}
			$query->whereRaw("((gifts.min_age >= $min AND gifts.min_age <= $max) OR (gifts.max_age >=$min AND gifts.max_age <= $max))");
		}
		$ids = $query->get()->pluck('id')->toArray();
		return response()->json(['gift_id' => $ids]);
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



	public function getInfo(Request $request)
	{
		$title = $description = $image = null;
		$html = $this->file_get_contents_curl($request->url);
		$doc = new DOMDocument();
		if(@$doc->loadHTML($html) !== false)
		{
			$metas = $doc->getElementsByTagName('meta');
			for ($i = 0; $i < $metas->length; $i++)
			{
				$meta = $metas->item($i);
				if(strtolower($meta->getAttribute('property')) == 'og:title')
				{
					$title = $meta->getAttribute('content');
				}
				if(strtolower($meta->getAttribute('name')) == 'og:description')
				{
					$description = $meta->getAttribute('content');
				}
				if(strtolower($meta->getAttribute('name')) == 'description' && !$description)
				{
					$description = $meta->getAttribute('content');
				}
				if(strtolower($meta->getAttribute('property')) == 'og:image')
				{
					$image = $meta->getAttribute('content');
				}
			}
			if(!$title)
			{
				$node = $doc->getElementsByTagName('title');
				if(count($node))
				{
					$title = $node->item(0)->nodeValue;
				}
			}

			//amazon
			if(!$image)
			{
				$images = $doc->getElementsByTagName('img');
				foreach ($images as $i)
				{
					if($i->getAttribute('id') == 'landingImage')
					{
						$image = $i->getAttribute('src');
						break;
					}
				}
			}

		}
		return response()->json(['title' => $title, 'description' => $description, 'image' => $image]);
	}

	public function addCustomGift(Request $request)
	{
		$user_id = Auth::user()->id;
		$slug = $request->input('slug');
		$url = $request->input('url');
		$title = $request->input('title');
		$description = $request->input('description');
		$price = $request->input('gift_amount');
		$image  = $request->input('image');
		$gift = Gift::where('url',$url)->where("user_id", $user_id)->first();
		if(!$gift)
		{
			$gift = Gift::create([
				'user_id' => $user_id,
				'name' => $title,
				'title' => $title,
				'description' => $description,
				'price' => $price,
				'cost' => $price,
				'url' => $url,
			]);
		}
		if($image)
		{
			$output = '/images/user_gift_images/'. $gift->id . '.png';
			file_put_contents(public_path() . $output, file_get_contents($image));
			$gift->image = $output;
			$gift->save();
		}
		$page = Page::where('slug', $slug)->first();
		$added_gifts = $page->added_gifts;
		array_push($added_gifts, $gift->id);
		$page->added_gifts = $added_gifts;
		$page->save();
		return response()->json(['gift' => $gift]);
	}

	
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
	   
	   $gift_page = Page::where('slug', $slug)->where('user_id',$user_id->id)->first();
	   
	   $added_array = unserialize($gift_page->added_gifts);
	   
	   array_push($added_array, $gift->id);
	   $added_array = serialize($added_array);
	   
	   Page::find($gift_page->id)->update([ 'added_gifts' => $added_array]);
	   
       $output = 'public/images/user_gift_images/'. $gift->id . '.png';
       file_put_contents($output, file_get_contents($image));
        
        return response()->json(['gift' => $gift]);
        
        
    } 
}