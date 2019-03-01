<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
	public function login(){

		if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){

			/** @var UserModel $user */
			$user = Auth::user();
			return response()->json([
				'data' => ['token' => $user->createToken('app')->accessToken]
			]);

		} else{
			return response()->json (['error'=>__('auth.failed')], 400);
		}
	}

	public function register(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' 		 => 'required',
			'email'      => 'required|email|unique:users',
			'password'   => 'required',
			'c_password' => 'required|same:password',
		]);

		if ($validator->fails()) {
			return response()->json([
				'error'    => 'The given data was invalid',
				'messages' => $validator->errors(),
			], 400);
		}

		$input = $request->all();
		$input['password'] = Hash::make($input['password']);
		$user = UserModel::create($input);
		return response()->json([
			'data' => ['token' => $user->createToken('app')->accessToken]
		]);
	}

	public function logout() {

		/** @var UserModel $user */
		if ($user = Auth::user ()) {

			if (!empty($user->token())) {
				$user->token()->revoke ();
			}
		}

		return response()->noContent ();
	}

	public function details()
	{
		$user = Auth::user();
		return response()->json(['success' => $user]);
	}
}