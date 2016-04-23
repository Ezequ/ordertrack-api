@include('adm.links-template.links')
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="{{Config::get('constants.url_css_adm')}}login.css">
	<title>Login | Admin</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<h1 class="text-center login-title">Panel de administración - Login</h1>
				<div class="account-wall">
					<img class="profile-img" src="{{ManejoArchivos::getImage('logo','logo')}}" alt="">
					<form class="form-signin" id="form1" name="form1" method="post" action="{{UrlsAdm::postLogin()}}">
						<input type="text" name="email" class="form-control" placeholder="Email" required autofocus>
						<input type="password" name="password" class="form-control" placeholder="Contraseña" required>
						<button class="btn btn-lg btn-primary btn-block" type="submit" style="background-color: #7AC8A1">Entrar</button>
					</form>
				</div>
				@if(Session::has('result'))
				     <div class="alert alert-{{Session::get('result') == 1 ? 'success' : 'danger'}} alert-dismissable">
				      {{Session::get('message')}}
				     </div>
				@endif
			</div>
		</div><!--row-->
	</div><!--container-->
</body>
</html>