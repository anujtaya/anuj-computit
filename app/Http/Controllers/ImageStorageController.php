<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageStorageController extends Controller
{
    function make_profile_image_link($filename) {
        return \Image::make(storage_path('public/images/profile/' . $filename))->response();
    }

    function make_job_attachment_image_link($filename) {
        return \Image::make(storage_path('public/job_attachments/' . $filename))->response();
    }
}
