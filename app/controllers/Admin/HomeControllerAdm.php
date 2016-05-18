<?php /**
* 
*/
class HomeControllerAdm extends BaseController
{
	protected $sectionName =  "Inicio";

	public function getHome()
	{
		return View::make('adm.home.index')
			    ->with("sectionName", $this->sectionName)
				->with("subSectionName", $this->subSectionName);
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
				return Redirect::back()->with("message", "Los datos son incorrectos.")->with('result', 0);
			}
		}
		else return Redirect::back()->with("message", "Los datos son incorrectos.")->with('result', 0);
	}

	public function getObjectsToList()
	{
		return null;
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::back();
	}


}