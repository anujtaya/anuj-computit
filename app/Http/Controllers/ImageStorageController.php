<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Intervention\Image\Exception\NotReadableException;
use Storage;
use App\JobAttachment;

class ImageStorageController extends Controller
{

    function make_job_attachment_image_link($id) {

        try {
            $attachment = JobAttachment::find($id);     
            return \Image::make(Storage::disk('s3')->get($attachment->path))->response();
        } catch (NotReadableException  $e) {
            return \Image::make('https://cdn.blankstyle.com/files/imagefield_default_images/notfound_0.png')->response();
        }
         
    }

}
