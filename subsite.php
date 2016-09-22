<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
	<link href="styles/styles.css" type="text/css" rel="stylesheet">
	<!--<script src="scripts/main.js"></script>-->
</head>
<body onload="initialize()">
	<header>
		<a href="index.php"><h1>goethegym.net</h1></a>
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
	<main class="subsite">
		<h2>Lehrer und co</h2>
		<nav></nav>
		<article>
			<?php
				if(!isset($_GET["article"])) {
					echo "404 nothing here...";
				} else {
					$article = $_GET["article"];
					echo file_get_contents("subsites/" . $article . ".html");
				}
			?>
		</article>
	</main>
	<footer></footer>
	<nav></nav>
</body>
</html>