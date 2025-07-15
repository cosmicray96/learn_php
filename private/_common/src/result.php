<?php

enum ErrCode
{
	case Ok;
	case Err;
	case Exception;

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
	private readonly ErrCode $err;
	private readonly mixed $value;

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

	public function error(): ErrCode
	{
		if ($this->err === ErrCode::Ok) {
			throw new RuntimeException("Tried to get error from Result but it is not");
		}
		return $this->err;
	}

	public function value(): mixed
	{
		if ($this->err !== ErrCode::Ok) {
			throw new RuntimeException("Tried to get value from Result but it is error({$this->err->name})");
		}
		return $this->value;
	}

	public function exception(): mixed
	{
		if ($this->err !== ErrCode::Exception) {
			throw new RuntimeException("Tried to get Exception from Result but it is not");
		}
		return $this->value;
	}

	//--- Static ---//

	public static function make_ok(mixed $value = null): self
	{
		return new self(ErrCode::Ok, $value);
	}

	public static function make_err(ErrCode $err, mixed $value = null): self
	{
		return new self($err, $value);
	}

	public static function make_exception(Throwable $e): self
	{
		return new self(ErrCode::Exception, $e);
	}
}

function ErrCode_to_string(ErrCode $err): string
{
	switch ($err) {
		case ErrCode::Ok:
			return 'No Error';
			break;
		case ErrCode::Err:
			return 'Generic Error';
			break;
		case ErrCode::DB_CannotConnect:
			return 'Could not connect to the database';
			break;
		case ErrCode::DB_NotFound:
			return 'Requested value not found in database';
			break;
		case ErrCode::DB_BadQuery:
			return 'Query sent to database was invalid';
			break;
		case ErrCode::Auth_InvalidUsername:
			return 'Provided username was invalid';
			break;
		case ErrCode::Auth_InvalidPassword:
			return 'Provided password was invalid';
			break;
		case ErrCode::Auth_WrongPassword:
			return 'Provided password was incorrect';
			break;
		case ErrCode::Auth_NameTaken:
			return 'Provided name was already taken';
			break;
		default:
			return "ErrCode::{$err->name} not recognized";
			break;
	}
}
