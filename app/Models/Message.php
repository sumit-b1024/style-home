<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\File;
class Message extends Model
{
    const TYPE_NORMAL =0; 
    const TYPE_ATTACHMENT=1;


    public function sendor()
    {
        return  $this->belongsTo('App\User','from_id');
    }

    public function receiver() 
    {
        return  $this->belongsTo('App\User','to_id');
    }


    public function getAttachmentUrl() 
    {
        $file=File::where("model_type",get_class($this))->where("model_id",$this->id)->first();
        if(!empty($file))
        return asset("public/uploads/{$file->path}");
        
    }


}
