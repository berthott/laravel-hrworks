<?php

namespace berthott\HrWorks\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The token model
 */
class HrWorksAuthToken extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'token', 'expires_at',
    ];
}
