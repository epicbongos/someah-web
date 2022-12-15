<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>@yield('title') - Admin Somearch Nusantara</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<meta name="theme-color" content="#EFEFEE"/>
	
	<!-- Favicon-->
    <link rel="icon" type="image/png" href="{{asset('assets')}}/images/favicon.png">

	<!-- Fonts and icons -->
	<script src="{{ asset('assets/admin') }}/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset('assets/admin') }}/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	
	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/admin') }}/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('assets/admin') }}/css/millenium.min.css">
	
</head>

<body class="login">

    @yield('content')

    <script src="{{ asset('assets/admin') }}/js/core/jquery.3.2.1.min.js"></script>
	<script src="{{ asset('assets/admin') }}/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="{{ asset('assets/admin') }}/js/core/popper.min.js"></script>
	<script src="{{ asset('assets/admin') }}/js/core/bootstrap.min.js"></script>
	<!-- Bootstrap Notify -->
	<script src="{{ asset('assets/admin') }}/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
	<script src="{{ asset('assets/admin') }}/js/millenium.min.js"></script>

	<script>
		@if ($errors->first('email') || $errors->first('password'))
			$.notify({
				icon: 'flaticon-alarm-1',
				title: 'Warning !',
		        message: '{{ ($errors->first('email') != null) ? $errors->first('email') : $errors->first('password') }}'
			},{
				element: 'body',
				position: null,
				type: "danger",
				allow_dismiss: true,
				newest_on_top: false,
				showProgressbar: false,
				placement: {
					from: "top",
					align: "right"
				},
				offset: 20,
				spacing: 10,
				z_index: 1031,
				delay: 5000,
				timer: 5000,
				url_target: '_blank',
				mouse_over: null,
				animate: {
					enter: 'animated fadeInDown',
					exit: 'animated fadeOutUp'
				},
				onShow: null,
				onShown: null,
				onClose: null,
				onClosed: null,
				icon_type: 'class'
			});
		@endif
	</script>
</body>
</html>