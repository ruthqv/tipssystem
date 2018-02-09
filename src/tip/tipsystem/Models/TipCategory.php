<?php
namespace tip\tipsystem\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Schema;
use tip\tipsystem\Helpers\TipSystemHelper;

class TipCategory extends Model
{
    protected $table = 'tipcategories';
    protected $fillable = [
        'name',
        'description',
        'uri',
        'parent_id',
        'order',
        'special',
        'menu',
        'approved'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'parent_id' => 'integer',
        'order' => 'integer',
        'menu' => 'boolean'
    ];


    public function photos() {
        return $this->morphMany('tip\tipsystem\Models\Photo','photostable')->orderBy('order');
    }

    
    public function defaultPhoto() {
        return $this->morphOne('tip\tipsystem\Models\Photo','photostable')->where('default', true);
    }


    public function posts() {
        
        return $this->hasMany('tip\tipsystem\Models\Post','tipcategory_id', 'id');
    }


    public function children(){
        return $this->hasMany('tip\tipsystem\Models\BlogCategory', 'parent_id');
    }


    public function parent(){
        return $this->belongsTo('tip\tipsystem\Models\BlogCategory', 'parent_id');
    }


    public static function allPosts($tipcategory, $posts = null) {
        if ($posts === null) {
            $posts = collect();
        }

        $posts = $posts->merge($tipcategory->posts);

        $tipcategory->children->each(function($child) use(&$posts) {
            $posts = self::allPosts($child, $posts);
        });

        $posts = $posts->sortBy('order');

        return $posts;
    }
}