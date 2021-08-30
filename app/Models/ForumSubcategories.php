<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumSubcategories extends Forum
{
    use HasFactory;  
    use SoftDeletes;

	/**
     * Get the User that owns the ForumSubcategories.
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
