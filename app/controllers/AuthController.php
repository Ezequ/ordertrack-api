<?php

use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Validator as Validator;
use Illuminate\Support\Facades\Response as Response;
class AuthController extends \BaseController {

	public function login()
	{
		$rules = [
				'email'    => 'required',
				'password' => 'required',
		];
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			$credentials = [
					'email'      => Input::get('email'),
					'password'   => Input::get('password'),
			];
			if (Auth::attempt($credentials,true)) {
				$user = Auth::user();
				return $user->toJson();
			} else {
				return Response::make('Unauthorized', 401);
			}
		} else {
			return Response::make('Unauthorized', 401);
		}
	}
}
