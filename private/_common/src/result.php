<?php

enum ErrCode
{
	case Ok;
	case Err;

	case DB_CannotConnect;
	case DB_NotFound;
	case DB_BadQuery;

	case Auth_InvalidUsername;
	case Auth_InvalidPassword;
	case Auth_WrongPassword;
}

class Result
{
	public readonly ErrCode $err;
	public readonly ?mixed $value;

	//--- Special Functions ---//

	public function __construct(ErrCode $err, ?mixed $value = null)
	{
		$this->err = $err;
		$this->value = $value;
	}

	//--- Functions ---//

	public function is_ok(): bool
	{
		return $this->err === ErrCode::Ok;
	}

	public function is_err(): bool
	{
		return !$this->is_ok();
	}

	public function unwrap(): mixed
	{
		if ($this->err !== ErrCode::Ok) {
			throw new RuntimeException("Tried to unwrap Result but it is {$this->err->name}");
		}
		return $this->value;
	}

	//--- Static ---//

	public static function make_ok(mixed $value): self
	{
		return new self(ErrCode::Ok, $value);
	}

	public static function make_err(ErrCode $err, ?mixed $value = null): self
	{
		return new self($err, $value);
	}
}
