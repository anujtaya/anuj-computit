<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Intervention\Image\Exception\NotReadableException;
use Storage;


class ImageStorageController extends Controller
{
    function make_profile_image_link($filename) {
        if(app()->isLocal()) {
            return \Image::make(Storage::disk('local')->get('public/images/profile/' . $filename))->response();

        } else {
            return \Image::make(Storage::disk('local')->get('public/images/profile/' . $filename))->response();
        }
        
    }

    function make_job_attachment_image_link($filename) {

        try {
            return \Image::make(storage_path('public/job_attachments/' . $filename))->response();
        } catch (NotReadableException  $e) {
            return \Image::make('https://cdn.blankstyle.com/files/imagefield_default_images/notfound_0.png')->response();
            //return Response::make("", 404);
        }
         
    }
}
