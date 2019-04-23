<?php

	namespace App\Http\Controllers;

	use App\Account;
	use App\Log;
	use Illuminate\Http\Request;

	class LogController extends Controller
	{
		public function store(Request $request)
		{
			$userSession = session('access_token');
			$user = Account::whereAccessToken($userSession)->first();
			$data = [
				'account_id' => $user->id,
				'content' => $request->id,
				'type' => $request->type
			];

			Log::create($data);
		}
	}
