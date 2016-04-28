<!DOCTYPE html>
<html>
<head>
	@include("adm.head.head")

	@include("adm.links-template.links-css")
</head>
<body class="flat-green">
	<div class="app-container">
		<div class="row content-container">
		
			@include("adm.body.header")

			@include("adm.body.sidebar")

			<!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body">
                	@yield('content')
                </div>
            </div>

		</div>
	</div>

	@include("adm.links-template.links-js")
	
</body>
</html>