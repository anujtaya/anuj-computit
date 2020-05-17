<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketController extends Controller
{
    function market_home_main(){
        return view('market.marketHome');
       }
    
       function market_initialize(){
           return redirect()->route('market_home_main');
       }
    
       function market_faq(){
        return view('market.marketFAQ');
       }
       function market_serviceseekers(){
        return view('market.marketClients');
       }
       function market_serviceproviders(){
        return view('market.marketServiceProviders');
       }
    
       function market_terms(){
        return view('market.marketTerms');
       }
    
       function market_categories(){
        return view('market.marketCategories'); 
       }
       
       function market_download_old_redirect(){
           return redirect()->route('market_download_app');
       }
    
       function market_download_app(){
        return view('market.marketDownloadApp');
       }
    
       function market_policy(){
        return view('market.marketPolicy');
       }
    
       function market_safety(){
        return view('market.marketSafety');
       }
       function market_about(){
        return view('market.marketAbout');
       }
       function market_business(){
        return view('market.market_business');
       }
       function market_legal(){
        return view('legal');
       }
    
       function market_help(){
        return view('market.marketHelp');
       }
    
       function auth_landing_old_redirect(){
        return redirect()->route('app_landing');
       }
    
       function auth_landing(){
        return view('auth.landingpage');
       }
}
