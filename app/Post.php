<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';

    public function hasCategory()
    {
        return $this -> belongsTo('App\Category', 'category_id', 'id');
    }

    public function hasInfo(){
        return $this -> hasOne('App\PostInformation');
    }
}
