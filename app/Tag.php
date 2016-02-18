<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function bookmarks()
    {
        return $this->belongsToMany('App\Bookmark');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
