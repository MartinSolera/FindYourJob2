<?php namespace views;
?>
		<title>Find Your Job</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="views/presentation/home/assets/css/main.css" />
		<noscript><link rel="stylesheet" href="views/presentation/home/assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<div id="wrapper">
			<div id="bg"></div>
			<div id="overlay"></div>
			<div id="main">

				<!-- Header -->
					<header id="header">
						<h1 style="color:black">Find Your Job</h1>
						<p style="color:black">Metodología &nbsp;&bull;&nbsp; Laboratorio &nbsp;&bull;&nbsp; 2021</p>
						<nav>
								<a href="<?php echo FRONT_ROOT ?>Home/Home"><img src="views/presentation/home/assets/css/images/icons8-entrar-50.png"/></a>
						</nav>
					</header>

				<!-- Footer -->
					<footer id="footer">
						<span class="copyright">&copy; Copyrigth 2021</span>
					</footer>

			</div>
		</div>
		<script>
			window.onload = function() { document.body.classList.remove('is-preload'); }
			window.ontouchmove = function() { return false; }
			window.onorientationchange = function() { document.body.scrollTop = 0; }
		</script>
	