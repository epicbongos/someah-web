<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="theme-color" content="#008A85"/>

    <!-- Favicon-->
    <link rel="icon" type="image/png" href="{{asset('assets')}}/images/favicon.png">

    <title>@yield('title') - Somearch Nusantara</title>

    <!-- Styles-->
    <link rel="stylesheet" href="{{asset('assets')}}/css/bootstrap.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/main2.css">

    @stack("extras-css")

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>

<body>

    @include('partials.navbar2')

    @yield('content2')

    @include('partials.footer2')

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/admin') }}/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script>
        var has_error = {{ $errors -> count() > 0 ? 'true' : 'false' }};
        if (has_error) {
            swal({
                icon: 'error',
                title: 'Error',
                text: 'Masukkan Data Dengan Benar',
            });
        }
    </script>

    @include('sweetalert::alert')
    @stack('extras-js')

</body>
</html>
