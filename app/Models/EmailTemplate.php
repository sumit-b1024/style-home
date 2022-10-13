<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    const TYPE_NEW_PROJECT=1;
    const TYPE_RESET_PASSWORD=2;
    const TYPE_NEW_PASSWORD=3;
    const TYPE_SIGNUP_CUSTOMER_ADMIN=4;
    const TYPE_SIGNUP_CUSTOMER=5;
    const TYPE_SIGNUP_DESIGNER_ADMIN=6;
	const TYPE_SIGNUP_DESIGNER=13;
    const TYPE_SUPPORT_EMAIL=7;
    const TYPE_PAYMENT_REQUEST=8;
    const TYPE_ENQUIRY_ADMIN=9;
    const TYPE_ENQUIRY=10;
    const TYPE_APPLY_JOB_ADMIN=11;
    const TYPE_APPLY_JOB=12;
    const TYPE_PURCHASE_PRODUCT=13;


    public static function getEmailTypes()
    {
        return [
            self::TYPE_NEW_PROJECT=>__('New Project'),
            self::TYPE_RESET_PASSWORD=>__('Reset Password'),
            self::TYPE_NEW_PASSWORD=>__('New Password'),
            self::TYPE_SIGNUP_CUSTOMER_ADMIN=>__('Customer Signup to Admin'),
            self::TYPE_SIGNUP_CUSTOMER=>__('Customer Signup'),
            self::TYPE_SIGNUP_DESIGNER_ADMIN=>__('Designer Signup to Admin'),
            self::TYPE_SIGNUP_DESIGNER=>__('Designer Signup'),
            self::TYPE_SUPPORT_EMAIL=>__('Support Email to Designer'),
            self::TYPE_PAYMENT_REQUEST=>__('Designer Payment Request'),
            self::TYPE_ENQUIRY_ADMIN=>__('User Enquiry to Admin'),
            self::TYPE_ENQUIRY=>__('User Enquiry'),
            self::TYPE_APPLY_JOB_ADMIN=>__('Designer Apply Job to Admin'),
            self::TYPE_APPLY_JOB=>__('Designer Apply Job'),
            self::TYPE_PURCHASE_PRODUCT=>__('Purchase Product')
        ];
    }


    public function getEmailType()
    {
        $list=self::getEmailTypes();
        return isset($list[$this->type])?$list[$this->type]:'NA';
    }


    protected $fillable=[
        'salutation',
        'message',
        'type',
    ];
}
