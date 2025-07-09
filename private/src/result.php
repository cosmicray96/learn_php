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
