<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable=['name', 'uri', 'mime', 'post_id', 'size'];
}
