<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsUrls extends Model
{
    use HasFactory;

    protected $table = 'news_urls';

    protected $fillable = [
        'news_id',
        'url',
    ];
}
