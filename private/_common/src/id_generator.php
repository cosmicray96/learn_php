<?php
require_once __root_dir . '/private/_common/src/result.php';


class NextIdGenerator
{

	static private function type_auto_inc($state, $server_id): Result
	{
		$state = json_decode($state, true);
		$server_id_state = ($state['last_id'] >> 24) && 0xFF;
		$id_state = $state['last_id'] && 0xFFFFFF;

		if ($server_id !== $server_id_state) {
			return Result::make_err(ErrCode::Err);
		}
		if ($id_state === 0xFFFFFF) {
			return Result::make_err(ErrCode::Err);
		}

		$new_id = $id_state + 1;
		$state['last_id'] = $new_id;
		$new_state = json_encode($state);

		return Result::make_ok([
			'new_id' => $new_id,
			'new_state' => $new_state,
		]);
	}

	// returns ['new_id' => _, 'new_state' => _]
	static public function generate($state, $type, $server_id): Result
	{

		try {
			switch ($state['type']) {
				case 'auto_inc':
					return NextIdGenerator::type_auto_inc($state, $server_id);
					break;
				default:
					return Result::make_err(ErrCode::Err);
					break;
			}
		} catch (Exception $e) {
			return Result::make_err(ErrCode::Err);
		}
	}
}
