<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketplaceConnection extends Model
{
    protected $fillable = [
        'user_id',
        'marketplace_type',
        'name',
        'slug',
        'api_key',
        'client_id',
        'oauth_token',
        'is_connected',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
