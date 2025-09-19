<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplaceConnection extends Model
{
    use HasFactory;

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
}
