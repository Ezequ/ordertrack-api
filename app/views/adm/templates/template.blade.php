<!DOCTYPE html>
<html>
<head>
	@include("adm.head.head")
</head>
<body>
	<div id="wrapper">
		@include("adm.body.body")
		@yield('content')
		<div class="container">
			<div class="col-md-12">
				@include("adm.templates.result")
			</div>
		</div>
	</div>
</body>
</html>