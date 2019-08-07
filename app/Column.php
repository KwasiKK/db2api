<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Columns extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'columns';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["name", "comment", "table_id", "index", "index_type"];
}