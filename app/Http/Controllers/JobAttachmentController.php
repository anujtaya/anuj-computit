<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BusinessInfo;
use App\JobAttachment;
use App\Job;
use Session;
use Auth;
use View;
use Input;
use Validator;
use Response;

class JobAttachmentController extends Controller
{
    function store_images(Request $request){
        $validation = Validator::make($request->all(), [
          'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:100000',
          'current_job_id' => 'required'
         ]);
         if($validation->passes())
         {
          $image = $request->file('file');
          $new_name = rand() . '.' . $image->getClientOriginalExtension();
          $image->move(storage_path('/public/job_attachments'), $new_name);
          $new_image_attachment = new JobAttachment();
          $new_image_attachment->path = $new_name;
          $new_image_attachment->name = 'Job Image';
          $new_image_attachment->upload_user_id   = Auth::id();
          $new_image_attachment->job_id   = $request->all()['current_job_id'];
          $new_image_attachment->save();
          return response()->json([
           'message'   => 'Image Upload Successfully',
           'uploaded_image' => '<img src="/storage/job_attachments/'.$new_name.'" class="img-thumbnail" width="300" />',
           'class_name'  => 'alert-success'
          ]);
         }
         else
         {
          return response()->json([
          //  'message'   => $validation->errors()->all(),
          //  'uploaded_image' => '',
          //  'class_name'  => 'alert-danger'
          ]);
         }
  }

  function retrive_job_images() {
      $job_id = $_POST['job_id'];
      $images = Job::find($job_id)->attachments;
      return Response::json($images);
  }


  // draft function
  function remove_job_images(){
    $id = $_POST['job_attachment_id'];
    $attachment = JobAttachment::find($id);     
    $response = false;
    if($attachment != null){
      if($attachment->path != null && $attachment->upload_user_id == Auth::id()) { 
        if(file_exists(storage_path('/public/job_attachments/'.$attachment->path))){
            unlink(storage_path('/public/job_attachments/'.$attachment->path));
            $attachment->delete();
            $response = true;
        }
      }
    } 
    return Response::json(true);
  }
}
