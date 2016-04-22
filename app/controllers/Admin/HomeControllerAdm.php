<?php /**
* 
*/
class HomeControllerAdm extends BaseController
{
	public function getHome()
	{
		return View::make('adm.home.index');
	}

	public function getLogin()
	{
		return View::make('adm.home.login');
	}

	public function postLogin()
	{
		$username = Input::get("email");
		$password = Input::get("password");
		$user = User::where('email', $username)->first();
		if($user && $user->rol > 0) // rol > seller
		{
			$credentials = [
				'email'      => Input::get('email'),
				'password'   => Input::get('password'),
			];
			if (Auth::attempt($credentials,true)) {
				return Redirect::to(UrlsAdm::getViewHome());
			} else {
				return Redirect::back()->with("message", "Contraseña incorrecta")->with('result', 0);
			}
		}
		else return Redirect::back()->with("message", "Usuario no existente")->with('result', 0);
	}

	public function getObjectsToList()
	{
		return null;
	}



}