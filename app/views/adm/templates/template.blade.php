<!DOCTYPE html>
<html>
<head>
	@include("adm.head.head")

	@include("adm.links-template.links-css")
</head>
<body>

	@include("adm.body.header")

	<div id="wrapper" class="">
		@include("adm.body.sidebar")
		
		<div id="page-content-wrapper">
		    <div class="container-fluid xyz">
				@yield('content')
			</div>
		</div>

		
	</div>

	@include("adm.links-template.links-js")
	
</body>
</html>