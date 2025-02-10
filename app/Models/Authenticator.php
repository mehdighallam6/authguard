<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OTPHP\TOTP;

class Authenticator extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'key',
        'tag_id',
        'user_id'
    ];

    protected $hidden = [
        'key',
    ];

    protected $appends = [
        'otp',
    ];

    public function getOTPAttribute()
    {
        return TOTP::createFromSecret(str_replace(' ', '', $this->key))->now();
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
