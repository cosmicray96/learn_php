<?php
require_once __root_dir . '/private/src/exception.php';

class IdGenExp extends AppException {}
class IdGenIdMissMatchExp extends IdGenExp {}
class IdGenIdOverflowExp extends IdGenExp {}
class IdGenUnknownTypeExp extends IdGenExp {}

class NextIdGenerator
{

	static private function type_auto_inc($state, $server_id): array
	{
		$state = json_decode($state, true);
		$server_id_state = ($state['last_id'] >> 24) & 0xFF;
		$id_state = $state['last_id'] & 0xFFFFFF;

		if ($server_id !== $server_id_state) {
			throw new IdGenIdMissMatchExp("last_id: {$state['last_id']}, server_id: $server_id, server_id_state: $server_id_state");
		}

		if ($id_state === 0xFFFFFF) {
			throw new IdGenIdOverflowExp();
		}

		//		$new_id = (($server_id_state << 24) & 0xFF000000) | ($id_state + 1);

		$new_id = $state['last_id'] + 1;
		$state['last_id'] = $new_id;
		$new_state = json_encode($state);

		return [
			$new_id,
			$new_state,
		];
	}

	// returns ['new_id' => _, 'new_state' => _]
	static public function generate($state, $type, $server_id): array
	{
		switch ($type) {
			case 'auto_inc':
				return NextIdGenerator::type_auto_inc($state, $server_id);
				break;
			default:
				throw new IdGenUnknownTypeExp();
				break;
		}
	}
}
