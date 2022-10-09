<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Validator;

class Posts extends Authenticatable
{
	use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = "id";

    public $tableName = 'posts';
    
    public static $rules = [
    	"cat_id" => "required",
    	"sub_cat_id" => "required",
    	"title" =>"required|min:4|max:100",
    	"description" => "required|min:4|max:2048",
    	// "countries" => "required",
    	"state_id" => "required",
    	"city_id" => "required",
    	"state_id" => "required",
    	"date" => "required",
    	"location" => "required|min:4|max:100",
    	"display_name" => "required|min:4|max:50",
    	"phonenumber" => "required|min:9|max:14",
        "image.*" => "mimes:jpeg,png,jpg|max:5120|dimensions:min_width=100,min_height=100,max_width=5000,max_height=5000"
    ];

    public static $messages = [
        'image.0.mimes' => 'Image 1 error: Image can only be JPG JPEG and PNG',
        'image.0.image' => 'Image 1 error: Please upload a valid image',
        'image.0.max' => 'Image 1 error: Image can not be larger than 2MB.',
        'image.0.dimensions' => 'Image 1 error: Image dimension must be between 100X100 and 5000X5000.',

        'image.1.mimes' => 'Image 2 error: Image can only be JPG JPEG and PNG',
        'image.1.image' => 'Image 2 error: Please upload a valid image',
        'image.1.max' => 'Image 2 error: Image can not be larger than 2MB.',
        'image.1.dimensions' => 'Image 2 error: Image dimension must be between 100X100 and 5000X5000.',

        'image.2.mimes' => 'Image 3 error: Image can only be JPG JPEG and PNG',
        'image.2.image' => 'Image 3 error: Please upload a valid image',
        'image.2.max' => 'Image 3 error: Image can not be larger than 2MB.',
        'image.2.dimensions' => 'Image 3 error: Image dimension must be between 100X100 and 5000X5000.',

        'image.3.mimes' => 'Image 4 error: Image can only be JPG JPEG and PNG',
        'image.3.image' => 'Image 4 error: Please upload a valid image',
        'image.3.max' => 'Image 4 error: Image can not be larger than 2MB.',
        'image.3.dimensions' => 'Image 4 error: Image dimension must be between 100X100 and 5000X5000.',

        'image.4.mimes' => 'Image 5 error: Image can only be JPG JPEG and PNG',
        'image.4.image' => 'Image 5 error: Please upload a valid image',
        'image.4.max' => 'Image 5 error: Image can not be larger than 2MB.',
        'image.4.dimensions' => 'Image 5 error: Image dimension must be between 100X100 and 5000X5000.',
    ];

    function validator($input){
       return $validation = Validator::make($input,self::$rules,self::$messages);
   }
}
