<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionDraftJob extends Model
{
    protected $table = 'session_draft_jobs';
    protected $casts = ['id' => 'string'];
    public $timestamps = true;

    public function session_draft_job_attachments(){
        return $this->hasMany('App\SessionDraftJobAttachment');
    }
}
