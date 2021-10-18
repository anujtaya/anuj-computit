<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;
use Validator;
use Session;
use Carbon\Carbon;
use App\Job;

class PromotionController extends Controller
{
    function admin_home(){
        $promotions = Promotion::all();
        return view('admin_portal.modules.promotions.home')->with('promotions', $promotions);
    }

    function admin_create(Request $request){
        $input = $request->all();
        $validation = Validator::make($request->all(), [
            'code' => 'required',
            'value' => 'required',
            'expires_on' => 'required',
            'type' => 'required',
        ]);

        if($validation->passes()){
            $promotion = new Promotion();
            $promotion->code = $input['code'];
            $promotion->value = $input['value'];
            $promotion->expires_on = $input['expires_on'];
            $promotion->type = $input['type'];
            $promotion->status = 'ENABLED';
            $promotion->save();
            Session::put('status', 'New promotion created successfully.');
            return redirect()->back();
        } else {
            Session::put('error', 'Failed to create the promotion.');
            return redirect()->back()
            ->withErrors($validation)
            ->withInput();
        }  
    }


    function admin_edit($id){
        $promotion = Promotion::find($id);
        if($promotion != null){
            return view('admin_portal.modules.promotions.edit')->with('promotion', $promotion);
        } 
        Session::put('error', 'Promotion not found.');
        return redirect()->route('app_portal_admin_promotion_home');
    }


    function admin_update(Request $request){
        $input = $request->all();
        $validation = Validator::make($request->all(), [
            'id' => 'required',
            'value' => 'required',
            'expires_on' => 'required',
            'type' => 'required',
            'status' => 'required'
        ]);

        if($validation->passes()){
            $promotion = Promotion::find($input['id']);
            $promotion->value = $input['value'];
            $promotion->expires_on = $input['expires_on'];
            $promotion->type = $input['type'];
            $promotion->status = $input['status'];
            $promotion->save();
            Session::put('status', 'Promotion updated successfully.');
            return redirect()->back();
        } else {
            Session::put('error', 'Failed to update the promotion.');
            return redirect()->back()
            ->withErrors($validation)
            ->withInput();
        }  
    }

    function add_promocode_to_job(Request $request){
        $input = $request->all();

        //if promotion code is provided null then calcualte the 
        if($input['promocode'] == null) {
            $this->remove_promo_code_from_job($input['promocode_job_id']);
            Session::put('promosuccess', 'The promo code has been removed and job price is set to its original.');
            return redirect()->back();
        }
        //find promotion
        $promotion = Promotion::where('code', $input['promocode'])->first();
        //check if the promotion exists
        if($promotion == null) {
            Session::put('promoerror', 'The promo code you entered is not valid. Please check and re-enter your promo code.');
            return redirect()->back();
        }
        //check if the promotion code is active
        if(Carbon::parse($promotion->expires_on)->isPast()) {
            Session::put('promoerror', 'The promotion code is expied. Please try a different promo code.');
            return redirect()->back();
        } 
        //check if the promotion code is enabled
        if($promotion->status == 'DISABLED') {
            Session::put('promoerror', 'The promo code is no longer accepted. It is disabled by LocaL2LocaL team.');
            return redirect()->back();
        } 
        $job = Job::find($input['promocode_job_id']);
        if($job != null) {
            $job->promocode = $promotion->id;
            $job->save();
            //adjust the job payment pricing 
            $job_payment = $job->job_payments;
            //dd($job_payment);
            if($job_payment != null) {
                //set the job actual pric
                if($job_payment->actual_job_price != null) {
                    $job_payment->job_price =   $job_payment->actual_job_price;
                    $job_payment->save();
                }
               
         
                $actual_job_price =   $job_payment->actual_job_price;;
                 //calculate promotion price
                $promotion_price = 0.00;
                if($promotion != null) {

                    if($promotion->type == 'FIXED') {
                        $promotion_price = round( $actual_job_price - $promotion->value);
                        $promotion_discount_discription = $promotion_price.'AUD';
                        $discounted_job_price = $actual_job_price - $promotion_price;
                    } else {
                        $promotion_price = round(($promotion->value/100)*($actual_job_price),2);
                        $promotion_discount_discription =  $promotion_price.'AUD';
                        $discounted_job_price = $actual_job_price - $promotion_price;
                    }
                    $job_payment->actual_job_price = $job_payment->job_price;
                    $job_payment->job_price = $discounted_job_price;

                    //recalculate gst
                    //print('Is GST applicable: '. $is_gst_applicable);print('<br>');
                    $gst_fee_value = 0;
                    if($job_payment->is_gst_applicable ==  true) {
                        $gst_fee_value =  $discounted_job_price/11;
                    }

                    $job_payment->gst_fee_value = $gst_fee_value;
                    $job_payment->save();
                }
            }
           
            

            Session::put('promosuccess', 'The promo code applied successfully.');
        } else {
            Session::put('promoerror', 'No job found with id: #'.$input['promocode_job_id'].'. Please contact LocaL2LocaL Team to resolve this error.');
        }
        return redirect()->back();
    }


     function remove_promo_code_from_job($id) {
         $job = Job::find($id);
         if($job != null) {
            $job_payment = $job->job_payments;
            if($job_payment != null) {
                //set the job price to orginal
                $job_payment->job_price =  $job_payment->actual_job_price;
                
            


                //print('Is GST applicable: '. $is_gst_applicable);print('<br>');
                $gst_fee_value = 0;
                if($job_payment->is_gst_applicable ==  true) {
                    $gst_fee_value = $job_payment->actual_job_price/11;
                }

                $job_payment->gst_fee_value = $gst_fee_value;
                $job_payment->save();
                $job->promocode = null;
                $job->save();
            }
           
         }
     }
}
