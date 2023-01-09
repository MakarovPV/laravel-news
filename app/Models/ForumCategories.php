<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumCategories extends Forum
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;
}
