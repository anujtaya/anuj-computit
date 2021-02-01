<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Conversation;
use App\JobExtra;
use Auth;
use View;
use Response;
use App\ConversationMessage;
use App\User;
use Carbon\Carbon;
use Validator;


class JobExtraController extends Controller
{
    //add an extra item to a job.
    protected function store(Request $request){
        $validator =  Validator::make($request->all(), [
			'extra_name' => 'required|min:3',
            'extra_job_id' => 'required',
            'extra_quantity' => 'required',
            'extra_price' => 'required'
		]);
		if ($validator->fails()) {
			return redirect()
					->back()
					->withErrors($validator)
					->withInput();
		} 
        $data =  (object) $request->all();
        $job = Job::find($data->extra_job_id);
        if($job->status == 'STARTED') {
            $extra = new JobExtra();
            $extra->name = $data->extra_name;
            $extra->description = $data->extra_description;
            $extra->quantity = $data->extra_quantity;
            $extra->price = $data->extra_price;
            $extra->status = 'ACTIVE';
            $extra->job_id = $job->id;
            $extra->save();
        }
        return redirect()->back();
    }

    //remove an extra item from a job
    protected function remove($id){
        $extra = JobExtra::find($id);
        if($extra != null) {
            $job = $extra->job;
            if($job->status == 'STARTED') {
                $extra->status = 'DELETED';
                $extra->save();
            }
        }
        return redirect()->back();
    }
}
