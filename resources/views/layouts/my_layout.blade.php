<!DOCTYPE html>
<html lang="en">
	<head>
	  <title>@yield('title')</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

	  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.rtl.min.css" integrity="sha384-dc2NSrAXbAkjrdm9IYrX10fQq9SDG6Vjz7nQVKdKcJl3pC+k37e7qJR5MVSCS+wR" crossorigin="anonymous">
	  
	  <script src="/js/bootstrap.bundle.min.js"></script>
	  <!-- Styles -->
        
		<link rel="stylesheet" href="/css/my_style.css">
	</head>
	<body class="antialiased" dir="rtl">
		
		<div class="container-fluid"><br>
			@yield('content')
		</div>
		<script src="/js/bootstrap.bundle.min.js"></script>
	</body>
</html>



