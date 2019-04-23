<?php

	namespace App\Http\Controllers;

	use App\Account;
	use App\Log;
	use App\Post;
	use Illuminate\Http\Request;

	class PostController extends Controller
	{
		public function checkMission()
		{
			$userSession = session('access_token');
			$user = Account::whereAccessToken($userSession)->first();

			$postCount = Log::whereAccountId($user->id)->whereType('post')->count();
			$shareCount = Log::whereAccountId($user->id)->whereType('share')->count();
			$commentCount = Log::whereAccountId($user->id)->whereType('comment')->count();

			return [
				'post' => $postCount,
				'share' => $shareCount,
				'comment' => $commentCount
			];
		}

		public function getRandomPost()
		{
			return Post::inRandomOrder()->first();
		}

		public function getRandomShare()
		{
			return Share::inRandomOrder()->first();
		}
	}
