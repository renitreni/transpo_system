<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'type',
        'log',
    ];

    public static function newLog(string $type, string $log)
    {
        $instance = new self;

        $instance->type = $type;
        $instance->log = $log;

        $instance->save();

        return $instance;
    }
}
