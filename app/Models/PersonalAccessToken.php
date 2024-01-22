<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Model
{
    use HasFactory;

    protected $table = 'personal_access_tokens';

    protected $fillable = [
        'token',
        'user_id',
        'last_used_at',
    ];

    protected $dates = [
        'last_used_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
