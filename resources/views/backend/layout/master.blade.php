


<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>FAST FOOD</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<base href="{{asset('')}}">
<link rel="stylesheet" href="backend/css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="backend/css/style.css" rel='stylesheet' type='text/css' />
<link href="backend/css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="backend/css/font.css" type="text/css"/>
<link href="backend/css/font-awesome.css" rel="stylesheet">  
<link rel="stylesheet" href="backend/css/morris.css" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="backend/css/monthly.css">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="backend/js/jquery2.0.3.min.js"></script>
<script src="backend/js/raphael-min.js"></script>
<script src="backend/js/morris.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@yield('style')
</head>
<body>
<section id="container">
	@include('backend.layout.header')
<!--sidebar start-->
<aside>
    @include('backend.layout.menu')
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<!-- //market-->
		@yield('content')
					

<!--main content end-->
</section>
<script src="backend/js/bootstrap.js"></script>
<script src="backend/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="backend/js/scripts.js"></script>
<script src="backend/js/jquery.slimscroll.js"></script>
<script src="backend/js/jquery.nicescroll.js"></script>
<script src="backend/js/jquery.scrollTo.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@routes
@yield('script')

<script>
	$( function() {
	  $( "#datepicker" ).datepicker({
		  dateFormat:"yy-mm-dd"
	  });
	} );
	$( function() {
	  $( "#datepicker2" ).datepicker({
		dateFormat:"yy-mm-dd"
	  });
	} );



</script>


	<!-- //calendar -->
</body>
</html>
