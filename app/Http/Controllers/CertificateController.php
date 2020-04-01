<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BusinessInfo;
use Session;
use Auth;
use View;
use Input;
use Validator;
use App\Certificate;

class CertificateController extends Controller
{
    function show_registration_page(){
        $certificates = Auth::user()->certificates;
        return view('service_provider.certificate.registration_page')->with('certificates', $certificates);
    }


    function registration_process(Request $request){
        $validator =  Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'date' => 'required|after:' . date('Y-m-d') . '|date_format:Y-m-d',
            'guid' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
        } else {
            $data = $request->all();
            $certificate = new Certificate();
            $certificate->certificate_name =  $data['name'];
            $certificate->certificate_expiry =  $data['date'];
            $certificate->certificate_id =  $data['guid'];
            $certificate->user_id = Auth::id();
            $certificate->save();
            return redirect()->back();
        }
    }

    function delete($id){
        $certificate = Auth::user()->certificates->where('id', $id)->first();
        if($certificate != null) {
            $certificate->delete();
        }
        return redirect()->back();
    }
}
