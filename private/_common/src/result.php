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

	case Auth_NameTaken;
}

class Result
{
	public readonly ErrCode $err;
	public readonly mixed $value;

	//--- Special Functions ---//

	public function __construct(ErrCode $err, mixed $value = null)
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

	public static function make_err(ErrCode $err, mixed $value = null): self
	{
		return new self($err, $value);
	}
}

function ErrCode_to_string(ErrCode $err)
{
	switch ($err) {
		case ErrCode::Ok:
			return 'No Error';
			break;
		case ErrCode::Err:

		case ErrCode::DB_CannotConnect:
			break;
		case ErrCode::DB_NotFound:
			break;
		case ErrCode::DB_BadQuery:
			break;

		case ErrCode::Auth_InvalidUsername:
			break;
		case ErrCode::Auth_InvalidPassword:
			break;
		case ErrCode::Auth_WrongPassword:

			break;
		case ErrCode::Auth_NameTaken:
			break;
		default:
			return "ErrCode::{$err->name} not recognized";
			break;
	}
}
