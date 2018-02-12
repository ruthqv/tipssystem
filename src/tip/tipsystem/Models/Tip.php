<?php
namespace tip\tipsystem\Models;

use tip\tipsystem\Helpers\BlogSystemHelper;
use DB;
use Illuminate\Database\Eloquent\Model;
use Schema;
use langs\langssystem\Models\Lang;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;



class Tip extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'tips';

    protected $fillable = [
        'question',
        'solution',
        'user_id',
        'category',
        'username',
        'resource',
        'email',
        'approved'

    ];


    // public function relatedtips($id)
    // {
    //     $post = $id;

    //     $tipcategory = $this->tipcategory()->first();

    //     return $tipcategory->tips()->where('id', '!=', $id)->get();

    // }

    public static function approved()
    {
        return self::where('approved','=', 1)->orderBy('created_at', 'desc');

    } 

    // public function author()
    // {
    //     return $this->hasOne('App\User', 'id','user_id');
    // }    
    // public function photos()
    // {
    //     return $this->morphMany('tip\tipsystem\Models\Photo', 'photostable')->orderBy('order');
    // }

    // public function defaultPhoto()
    // {
    //     return $this->morphOne('tip\tipsystem\Models\Photo', 'photostable')->where('default', true);
    // }

    // public static function tipcategory()
    // {
    //     return self::where('category','=', 1)->orderBy('created_at', 'desc');
    // }



}
