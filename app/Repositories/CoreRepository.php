<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CoreRepository.
 */
abstract class CoreRepository 
{
	/**
     * Объект модели.
     */
	protected $model;

 	/**
     * Create a new controller instance.
     *
     * @return object
     */
	public function __construct()
	{
		$this->model = app($this->model());
	}
	
    /**
     * Возвращение класса модели.
     *
     * @return string
     */
    abstract protected function model();
      
}
