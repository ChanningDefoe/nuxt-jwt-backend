<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchList extends Model
{
    protected $guarded = [
        'id'
    ];

    /**
     * The user that the Watch List Movie belongs to
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
