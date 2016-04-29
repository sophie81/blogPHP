<?php

use Illuminate\Support\Str;

if(!function_exists('excerpt')){
    function excerpt($text, $limit = 10, $end = '...'){
        return Str::words($text, $limit, $end);
    }
}