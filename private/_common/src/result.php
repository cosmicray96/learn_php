<?php

enum ErrCode
{
	case OK;
	case ERR;
	case DB_ERR;
}


class Result
{
	public ErrCode $code;
	public ?string $msg;

	public function __construct(ErrCode $code, ?string $msg = null)
	{
		$this->code = $code;
		$this->msg = $msg;
	}

	public function is_success(): bool
	{
		return $this->code == ErrCode::OK;
	}
}
class NewResult
{
	public $err;
	public $value;
	private bool $is_error;

	public function __construct($value, bool $is_error)
	{
		$this->is_error = $is_error;
		if ($this->is_error) {
			$this->err = $value;
		} else {
			$this->value = $value;
		}
	}

	public function has_err(): bool
	{
		return $this->is_error;
	}
}
