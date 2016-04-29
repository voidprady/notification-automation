<?php namespace App\Services;

use Validator;

abstract class LaravelValidator{
 
	protected $input;

	protected $errors;

	public function with(array $input)
	{
		$this->input = $input;
		return $this;
	}

	public function passes() {
		$validation = Validator::make($this->input, static::$rules);

		if($validation->passes()) return true;

		$this->errors = $validation->messages();

		return false;
	}

	public function getErrors() {
		return $this->errors;
	}

}