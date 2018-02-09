<?php
namespace tip\tipsystem\Models;

use tip\tipsystem\Helpers\BlogSystemHelper;
use tip\tipsystem\Models\Tipcategory;
use DB;
use Illuminate\Database\Eloquent\Model;
use Schema;
use langs\langssystem\Models\Lang;
class Tip extends Model
{

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'tipcategory_id',
        'special',
        'new',
        'order',
        'approved'

    ];


    public function relatedtips($id)
    {
        $post = $id;

        $tipcategory = $this->tipcategory()->first();

        return $tipcategory->tips()->where('id', '!=', $id)->get();

    }

    public static function approved()
    {
        return self::where('approved','=', 1);
    } 

    public function author()
    {
        return $this->hasOne('App\User', 'id','user_id');
    }    
    public function photos()
    {
        return $this->morphMany('tip\tipsystem\Models\Photo', 'photostable')->orderBy('order');
    }

    public function defaultPhoto()
    {
        return $this->morphOne('tip\tipsystem\Models\Photo', 'photostable')->where('default', true);
    }

    public function tipcategory()
    {
        return $this->belongsTo('tip\tipsystem\Models\Tipcategory');
    }



}
