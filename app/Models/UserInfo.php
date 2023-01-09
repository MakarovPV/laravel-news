<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
    			'user_id',
    			'is_banned',
    			];

    /**
     * @var string
     */
    protected $table = 'user_info';

    /**
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * @var bool
     */
    public $timestamps = false;
}
