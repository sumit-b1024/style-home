<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectUpdate extends Model
{

    protected $fillable=[
        'project_id',
        'user_id',
        'customer_id',
        'date',
        'description',
        'image'
    ];

	public function getProjectUpdateImage()
    {
        return asset("public/uploads/{$this->image}");

    }
}
