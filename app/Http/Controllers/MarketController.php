<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketController extends Controller
{
    function market_home_main(){
        //return view('market.marketHome');
        return view('market.marketHomeComingSoon');
    }

    function market_initialize(){
        //return redirect()->route('market_home_main');
        return view('market.marketHomeComingSoon');
    }

    function market_faq(){
        //return view('market.marketFAQ');
        return view('market.marketHomeComingSoon');
    }
    function market_serviceseekers(){
        //return view('market.marketClients');
        return view('market.marketHomeComingSoon');
    }
    function market_serviceproviders(){
        //return view('market.marketServiceProviders');
        return view('market.marketHomeComingSoon');
    }

    function market_terms(){
        //return view('market.marketTerms');
        return view('market.marketHomeComingSoon');
    }

    function market_categories(){
        //return view('market.marketCategories');
        return view('market.marketHomeComingSoon');
    }

    function market_download_old_redirect(){
        //return redirect()->route('market_download_app');
        return view('market.marketHomeComingSoon');
    }

    function market_download_app(){
        //return view('market.marketDownloadApp');
        return view('market.marketHomeComingSoon');
    }

    function market_policy(){
        //return view('market.marketPolicy');
        return view('market.marketHomeComingSoon');
    }

    function market_safety(){
        //return view('market.marketSafety');
        return view('market.marketHomeComingSoon');
    }
    function market_about(){
        //return view('market.marketAbout');
        return view('market.marketHomeComingSoon');
    }
    function market_business(){
        //return view('market.market_business');
        return view('market.marketHomeComingSoon');
    }
    function market_legal(){
        //return view('legal');
        return view('market.marketHomeComingSoon');
    }

    function market_help(){
        //return view('market.marketHelp');
        return view('market.marketHomeComingSoon');
    }

    function auth_landing_old_redirect(){
        //return redirect()->route('app_landing');
        return view('market.marketHomeComingSoon');
    }

    function auth_landing(){
        //return view('auth.landingpage');
        return view('market.marketHomeComingSoon');
    }
}
