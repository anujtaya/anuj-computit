<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionDraftJobAttachment extends Model
{
    protected $table = 'session_draft_job_attachments';
    public $timestamps = true;
    
    public function session_draft_job(){
        return $this->belongsTo('App\SessionDraftJob', 'session_id', 'id');
    }
}
