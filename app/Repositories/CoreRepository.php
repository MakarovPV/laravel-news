<?php

namespace App\Repositories;

abstract class CoreRepository
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
	protected $model;

	public function __construct()
	{
		$this->model = app($this->model());
	}

    /**
     * Возвращение экземпляра модели.
     * @return mixed
     */
    abstract protected function model();

}
