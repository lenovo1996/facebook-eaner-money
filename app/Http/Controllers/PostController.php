<?php

	namespace App\Http\Controllers;

	use App\Account;
    use App\Comment;
    use App\CommentFr;
    use App\Log;
	use App\Post;

	class PostController extends Controller
	{
		public function checkMission()
		{
			$userSession = session('access_token');
			$user = Account::whereAccessToken($userSession)->first();

			$postCount = Log::whereAccountId($user->id)->whereType('post')->count();
			$tagCount = Log::whereAccountId($user->id)->whereType('cmt-wall-fr')->count();
			$commentCount = Log::whereAccountId($user->id)->whereType('comment')->count();

			$mission = 1;
            $postStt = false;
			if ($postCount > 0) {
                $postStt = true;
                $mission = 2;

            }
            $tagStt = false;
            if ($tagCount >= 5) {
                $tagStt = true;
                $mission = 3;
            }

            $commentStt = false;
            if ($commentCount >= 5) {
                $commentStt = true;
            }

			return [
				'post' => $postStt,
				'tag' => $tagStt,
				'comment' => $commentStt,
                'mission' => $mission
			];
		}

		public function getRandomPost()
		{
			return Post::inRandomOrder()->first();
		}

		public function getRandomComment()
		{
            $userSession = session('access_token');
            $user = Account::whereAccessToken($userSession)->first();
            $post = Log::whereAccountId($user->id)->whereType('post')->orderByDesc('id')->first();
            $comment = Comment::inRandomOrder()->first();
            $comment->post_id = $post->content;
			return $comment;
		}

        public function getRandomComment2()
        {
            return CommentFr::inRandomOrder()->first();
        }
	}
