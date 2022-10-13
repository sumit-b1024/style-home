<?php
namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{

    protected $fillable=[
        'user_id',
		'detail_form_id',
        'title',
        'about_room',
		'room_picture',
        'room_dimension',
        'room_item_keep',
        'room_vision',
        'specific_area',
        'inspiration_image',
        'pinterest_board',
        'color_schemes',
        'specific_item',
        'budget',
        'other_consideration',
    ];

    public function users() {
        return $this->belongsTo( User::class, 'user_id' );
    }

    public function payment_requests() {
        return $this->hasOne( PaymentRequest::class, 'project_detail_id' );
    }
}
