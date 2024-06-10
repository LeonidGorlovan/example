<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int user_id
 * @property string ip_address
 * @property string user_agent
 * @property string route_name
 * @property string url
 * @property string request
 * @property int status
 */

class UserLogging extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'route_name',
        'url',
        'request',
        'status'
    ];
}
