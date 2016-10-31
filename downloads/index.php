<?php
	//error_reporting(0);
	if(!isset($_GET["path"])) {
		http_response_code(500);
		header("Location: ../errorpages/500.html");
		exit;
	}

	$path = pathinfo($_GET["path"]);
	if(!isset($path["extension"])) {
		http_response_code(500);
		header("Location: ../errorpages/500.html");
		exit;
	}
	?>
	<!DOCTYPE html>
		<html>
		<head>
			<title></title>
			<meta charset="UTF-8">
			<link href="../styles/styles.css" type="text/css" rel="stylesheet">
			<!--<script src="scripts/main.js"></script>-->
		</head>
		<body>
			<header class="noselect">
				<a href="../index.php"><h1>goethegym.net</h1></a>
				<nav>
					<a href="../infos/" title="Informationen rund um die Schule" class="material-icon">&#xE88F;</a>
					<a href="../verein/" title="Förderverein" class="material-icon">&#xE0AF;</a>
					<a href="../aktiv/" title="Aktivitäten" class="material-icon">&#xE52F;</a>
					<a href="../personen/" title="Personen" class="material-icon">&#xE7EF;</a>
					<a href="../kontakt/" title="Kontakt und Impressum" class="material-icon">&#xE0D1;</a>
					<a href="../downloads/" title="Downloads" class="current material-icon">&#xE2C0;</a>
				</nav>
				<a class="login"></a>
			</header>
			<main class="subsite">
				<h2>Downloads</h2>
				<article>
				<?php
					foreach(scandir("../media/files") as $file) {
						if(substr($file,0,1)!=".") {
							echo '<p>';
							echo '<a href="../media/files/' . $file . '" target="_blank">' . $file . '</a>';
							echo '</p>';
						}
					}
				?>
				</article>
				<a class="up" href="#"></a>
			</main>
			<footer></footer>
			<nav></nav>
		</body>
		</html>
	<?php
	exit();
?>