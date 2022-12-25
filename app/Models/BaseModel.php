<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BaseModel extends Model
{
    public function getTable()
    {
        return Str::snake(Str::pluralStudly(class_basename($this)));
    }

     public static function getTableName()
     {
         return with(new static())->getTable();
     }
}
