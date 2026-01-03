<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets/images/dashboard/logo/fav.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/dashboard/logo/fav.png" type="image/x-icon">
    <title>oxygen</title>

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/fontawesome.css">

    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/themify-icons.css">

    <!-- slick icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/slick-theme.css">

    <!-- jsgrid css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/jsgrid.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/vendors/bootstrap.css">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/admin.css">
    <style>
    .form-control {
        padding: 0.4rem;
        font-size: 13px;
    }

    .card .card-body {
        padding: 20px;
        background-color: transparent;
    }
    </style>

</head>

<body class="theme-color-1">

    <div class="loader_skeleton">

        @include('website.partials.navbar')

        @yield('content')

    </div>

    @include('website.partials.footer')
    @include('website.partials.footer-scripts')

</body>

</html>