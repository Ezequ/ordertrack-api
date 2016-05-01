@include('adm.links-template.links')
<!DOCTYPE html>
<html>
<head>
	<title>Login | Administrator | Order tracker</title>

	<link rel="stylesheet" type="text/css" href="{{Config::get('constants.url_css_adm')}}login.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="container">
		<div class="row">
			
			<header>
				<img src="{{ManejoArchivos::getImage('logo','logo')}}" alt="">
			</header>

			<div class="login-block">
				@if(Session::has('result'))
				<div class="error alert alert-{{Session::get('result') == 1 ? 'success' : 'danger'}}">
					<i class="fa fa-warning"></i>{{Session::get('message')}}
				</div>
				@endif
				<form id="form1" name="form1" method="post" action="{{UrlsAdm::postLogin()}}">
				    <input  type="text" name="email" id="email"  value="" placeholder="Email" required autofocus />
				    <input type="password" name="password" id="password" value=""  placeholder="Contraseña" required />
				    <button type="submit" >Ingresar</button>
			    </form>
			</div>

		</div><!--row-->
	</div><!--container-->
</body>
</html>