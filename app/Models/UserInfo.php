<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    			'user_id', 
    			'is_banned',
    			];

	/**
     * Table name.
     *
     * @var string
     */
    protected $table = 'user_info';

	/**
     * Primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * Disabling timestampts columns.
     *
     * @var string
     */
    public $timestamps = false;
}
