<?php

namespace We7Mp\We7;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $connection = 'we7_database';

    public $timestamps = false;
}
