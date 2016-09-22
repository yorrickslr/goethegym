<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
	<link href="styles/styles.css" type="text/css" rel="stylesheet">
	<script src="scripts/main.js"></script>
</head>
<body onload="initMain()">
	<header>
		<a href="#" onclick="reset()"><h1>goethegym.net</h1></a>
		<nav>
			<a href="subsite.php?article=geschichte" title="Informationen rund um die Schule" class="material-icon">&#xE88F;</a>
			<a href="subsite.php?article=foerderverein" title="Förderverein" class="material-icon">&#xE0AF;</a>
			<a href="subsite.php?article=ag-plan" title="Aktivitäten" class="material-icon">&#xE52F;</a>
			<a href="subsite.php?article=lehrer" title="Personen" class="material-icon">&#xE7EF;</a>
			<a href="subsite.php" title="Kontakt und Impressum" class="material-icon">&#xE0D1;</a>
			<a href="subsite.php" title="Downloads" class="material-icon">&#xE2C0;</a>
		</nav>
		<a class="login"></a>
	</header>
	<main class="mainpage">
		<section></section>
		<section></section>
		<h2>News</h2>
		<div class="tilewrapper">
			<a href="subsite.php" name="neuer-schulhof" onclick="loadArticle(event);" class="newstile" style="background-image: url('media/test.png');">
				<img src="images/pattern1.png">
				<h3>Wunderschöner neuer Schulhof jetzt endlich eröffnet</h3>
				<article>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</article>
			</a>
			<a href="subsite.php" name="lorem-ipsum" onclick="loadArticle(event);" class="newstile" style="background-image: url('media/test2.jpg');">
				<img src="images/pattern2.png">
				<h3>Lorem Ipsum</h3>
				<article>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</article>
			</a>
			<a href="subsite.php" name="test2" onclick="loadArticle(event)" class="newstile" style="background-image: url('media/test3.jpg');">
				<img src="images/pattern5.png">
				<h3>Lorem Ipsum</h3>
				<article>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</article>
			</a>
		</div>
	</main>
	<footer></footer>
	<nav></nav>
</body>
</html>