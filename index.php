<!DOCTYPE html>
<html>

<head>
	<title>NexLab</title>
	<link rel="stylesheet" type="text/css" href="assets/css/index.css" />
</head>

<body class="body">
	<nav class="nav-item" id="na">
		<h1 class="h3-nav" id="id1">NexLab</h1>
		<form class="form-nav">
			<input type="search" id="id2" class="input-nav">
			<button class="input2-nav" id="id3">
				<i class="fas fa-search search2"></i>
			</button>

		</form>
		<ul class="liste">
			<li class="liste-item">
				<a href="#head" class="a-nav" id="home">Home</a>
				</a>
			</li>
			<li class="liste-item">
				<a href="#footer" class="a-nav" id="about">About</a>
			</li>
			<li class="liste-item">
				<a href="#id-contact" class="a-nav" id="contact" style="color: white">Contact</a>
			</li>
			<li class="liste-item liste-item2">
				<a href="signin.php" class="liste-item2-a">Connexion</a>
			</li>
			<li class="liste-item liste-item2">
				<a href="signup.php" class="liste-item2-a">Inscription</a>
			</li>

		</ul>
	</nav>


	<header class="div1">
		<h1 class="nexlab">N E X L A B</h1>
	</header>

	<ul class="list">
		<li class="item1">
			<div class="bg"></div>
		</li>
		<li class="item2">
			<div class="bg"></div>
		</li>
		<li class="item3">
			<div class="bg"></div>
		</li>
		<li class="item4">
			<div class="bg"></div>
		</li>
		<li class="item5">
			<div class="bg"></div>
		</li>
		<li class="item6">
			<div class="bg"></div>
		</li>
		<li class="item7">
			<div class="bg"></div>
		</li>
	</ul>


	<script type="text/javascript">

		var mynav = document.getElementById('na');

		var head2 = document.getElementById('home');
		var head3 = document.getElementById('about');

		//create element

		var nav1 = document.getElementById('id1');
		var nav2 = document.getElementById('id2');
		var nav3 = document.getElementById('id3');
		window.onscroll = function () {

			if (window.pageYOffset >= 200) {
				mynav.classList.add('something')
				nav1.style.display = 'inline'
				nav2.style.display = 'inline'
				nav3.style.display = 'inline'
				head2.style.color = 'white'
				head3.style.color = 'white'
			}
			else {
				nav1.style.display = 'none'
				nav2.style.display = 'none'
				nav3.style.display = 'none'
				mynav.classList.remove('something')

				head2.style.color = 'black'
				head3.style.color = 'black'
			}
		};
	</script>
</body>

</html>