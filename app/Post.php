<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';

    public function info()
    {
    return $this -> hasOne('App\PostInformation', 'id', 'post_id');
    }

    public function hasCategory()
    {
        return $this -> belongsTo('App\Category', 'category_id', 'id');
    }
}
