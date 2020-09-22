	<!DOCTYPE html>
	<html lang="zxx" class="no-js">

	<head>
	    <!-- Mobile Specific Meta -->
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <!-- Favicon-->
	    <link rel="shortcut icon" href="img/fav.png">
	    <!-- Author Meta -->
	    <meta name="author" content="colorlib">
	    <!-- Meta Description -->
	    <meta name="description" content="">
	    <!-- Meta Keyword -->
	    <meta name="keywords" content="">
	    <!-- meta character set -->
	    <meta charset="UTF-8">
	    <!-- Site Title -->
	    <title>Blogger</title>

	    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
	    <!-- CSS  -->
	    @include('layouts.frontend._partials._stylesheet')
	</head>

	<body>
	    <!-- Start Header Area -->
	    @include('layouts.frontend._partials._header')
        <!-- End Header Area -->

        <!-- Start Content -->
        @yield('content')
        <!-- End Content -->

	    <!-- Start footer Area -->
	    @include('layouts.frontend._partials._footer')
	    <!-- End footer Area -->

	    @include('layouts.frontend._partials._javascript')
	</body>

	</html>
