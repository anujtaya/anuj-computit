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
use Image;
use Storage;

class JobAttachmentController extends Controller
{
    function store_images(Request $request){
        $validation = Validator::make($request->all(), [
          'file' => 'required|image|mimes:jpeg,png,jpg,gif',
          'current_job_id' => 'required'
         ]);

         $image_size  = $request->file('file')->getSize();
         $file_size = number_format($image_size / 1048576,2);
         if($file_size > 5) {
           $validation->errors()->add('file', 'Image size could not be greater than 5 MBs.');
            return response()->json([
           'message'   => $validation->errors()->all(),
           'uploaded_image' => '',
           'class_name'  => 'alert-danger'
          ]);
         }
         if($validation->passes())
         {


          //the file object
          $img = $request->file('file');

          //create an image object for alterations
          $image_alteration = Image::make($img->getRealPath());
          $image_alteration->orientate();

          //create a unique file path name
          $file_path = rand() . '.' . $img->getClientOriginalExtension();

          //create a streamable image re
          $resource = $image_alteration->stream()->detach();
          $response = Storage::disk('local')->put('/public/job_attachments/'.$file_path, $resource);

          //store the job attachment
          $new_image_attachment = new JobAttachment();
          $new_image_attachment->path = $file_path;
          $new_image_attachment->name = 'Job Image';
          $new_image_attachment->upload_user_id   = Auth::id();
          $new_image_attachment->job_id   = $request->all()['current_job_id'];
          $new_image_attachment->save();



          return response()->json([
           'message'   => 'Image Upload Successfully',
           'uploaded_image' => '<img src="/storage/job_attachments/'.$file_path.'" class="img-thumbnail" width="300" />',
           'class_name'  => 'alert-success'
          ]);
         }
         else
         {
          return response()->json([
           'message'   => $validation->errors()->all(),
           'uploaded_image' => '',
           'class_name'  => 'alert-danger'
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
        $delete_response = Storage::disk('local')->delete('/public/job_attachments/'.$attachment->path);

        if($delete_response){
            $attachment->delete();
            $response = true;
        }
      }
    } 
    return Response::json(true);
  }
}
