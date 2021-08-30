<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
    			'id', 
    			'title', 
    			'short_description',
    			'full_description',
    			'news_picture', 
    			'created_at',
    			];

    public function newsComments()
    {
        return $this->hasMany(NewsComments::class, 'parent_news_id', 'id');
    }
}
