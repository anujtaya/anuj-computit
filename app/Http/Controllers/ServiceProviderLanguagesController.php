<?php
//file created by: Anuj Taya on 17/03/2020
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BusinessInfo;
use App\ServiceProviderLangauge;
use Session;
use Auth;
use View;
use Input;
use Validator;


class ServiceProviderLanguagesController extends Controller
{

    //display the language registration page and a list of already registered languages for a service provider.
    function show_registration_page(){
        $languages =  Auth::user()->languages;
        return view('service_provider.language.language_registration_page')->with('current_languages', $languages);
    }


    //save a language with service provider profile. Later service provider can delete the langauge if he wants to.
    function registration_process(Request $request){
        $validator =  Validator::make($request->all(), [
            'language_name' => 'required|min:3|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        } else {
            $data = $request->all();
            //dd($data);
            $current_languages = Auth::user()->languages->where('language_name', $data['language_name']);
            if(count($current_languages) == 0 ) {
                $language = new ServiceProviderLangauge();
                $language->language_name =  $data['language_name'];
                $language->user_id = Auth::id();
                $language->save();
            } else {
                Session::put('language_name_error', $data['language_name'].' is already added.');
            }

            return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
        }
    }

    //deletes a language record for a service provider peramanently
    function delete($id){
        $language = Auth::user()->languages->where('id', $id)->first();
        if($language != null) {
            $language->delete();
        }
        return redirect()->back();
    }
}
