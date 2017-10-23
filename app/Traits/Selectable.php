<?php
namespace App\Traits;

use Auth;
trait Selectable
{
    public static function getSelectList($value = 'name', $key = 'id'){
        return static::latest()->where('created_by', Auth::user()->id)->pluck($value, $key);
    }
}