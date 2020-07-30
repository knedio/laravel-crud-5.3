<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TodoManual extends Model
{
    public static function show($id)
    {
        return DB::table('todo_manuals')
            ->where('id', $id)
            ->first();
    }
}
