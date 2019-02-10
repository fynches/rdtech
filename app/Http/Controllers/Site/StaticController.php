<?php

namespace App\Http\Controllers\Site;

use App\Domain\StaticPage;
use App\Http\Controllers\Controller;

class StaticController extends Controller
{
    public function __construct()
    {

    }

    public function about()
    {
		$staticPage = StaticPage::where("slug", "about")->first();
		return view('site.static-pages.static-page', compact('staticPage'));
    }

    public function help()
    {
	    $staticPage = StaticPage::where("slug", "help")->first();
	    return view('site.static-pages.static-page', compact('staticPage'));
    }

    public function terms()
    {
	    $staticPage = StaticPage::where("slug", "terms")->first();
	    return view('site.static-pages.static-page', compact('staticPage'));
    }

    public function privacy()
    {
	    $staticPage = StaticPage::where("slug", "privacy")->first();
	    return view('site.static-pages.static-page', compact('staticPage'));
    }


}
