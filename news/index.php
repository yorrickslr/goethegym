<?php
	error_reporting(0);
	if(!isset($_GET["path"])) {
		http_response_code(500);
		header("Location: /errorpage/500.html");
		exit;
	}

	$path = pathinfo($_GET["path"]);
	if(!isset($path["extension"])) {
		http_response_code(500);
		header("Location: /errorpage/500.html");
		exit;
	}

	if($path["extension"] == "html") {
		if(isset($_GET["content-only"])) {
			$url = "../temp/news/" . $path["filename"] . "/text.html";
			$file = file_get_contents($url);
			if($file == FALSE) {
				http_response_code(404);
				header("Location: /errorpage/404.html");
				exit;
			} else {
				echo $file;
			}
			exit;
		} else {
			$url = "../temp/news/" . $path["filename"] . "/text.html";
			$file = file_get_contents($url);
			if($file == FALSE) {
				http_response_code(404);
				header("Location: /errorpage/404.html");
				exit;
			} else {
			?>
			<!DOCTYPE html>
				<html>
				<head>
					<title>News - goethegym.net</title>
					<meta charset="UTF-8">
					<link href="../styles/styles.css" type="text/css" rel="stylesheet">
					<script src="../scripts/main.js"></script>
				</head>
				<body onload="initialize()">
					<header>
						<a href="../index.php"><h1>goethegym.net</h1></a>
						<nav>
							<a href="../infos/" title="Informationen rund um die Schule" class="material-icon">&#xE88F;</a>
							<a href="../verein/" title="Förderverein" class="material-icon">&#xE0AF;</a>
							<a href="#" title="Aktivitäten" class="material-icon">&#xE52F;</a>
							<a href="#" title="Personen" class="material-icon">&#xE7EF;</a>
							<a href="#" title="Kontakt und Impressum" class="material-icon">&#xE0D1;</a>
							<a href="#" title="Downloads" class="material-icon">&#xE2C0;</a>
						</nav>
						<a class="login material-icon" onclick="showLogin(this);">&#xE853;</a>
					</header>
					<div id="login">
						<a href="../media/files/vertretungsplan.pdf" target="_blank">Vertretungsplan</a><br>
						<a href="../media/files/stundenplan.pdf" target="_blank">Stundenplan</a><br>
						<a href="../media/files/monatsplan.pdf" target="_blank">Monatsplan</a><br>
						<a href="../media/files/jahresplan.pdf" target="_blank">Jahresplan</a><br>
						<a href="downloads/" style="float: right; font-size: 1.2em; margin-top: 0px;">mehr...</a><br>
					</div>
					<main class="subsite">
						<article>
							<?= $file ?>
						</article>
					</main>
						<footer class="noselect">
							<div class="wrapper">
								<h2>Informationen</h2>
								<a href="../infos/#geschichte">Geschichte</a>
								<a href="../infos/#konzept">Konzept</a>
								<a href="../infos/#moeglichkeiten">Spezialisierung</a>
								<a href="../infos/#ausbildungsschule">Ausbildungsschule</a>
								<a href="../infos/#jugend-debattiert">Jugend debattiert</a>
								<a href="../infos/#eigenverantwortung">Eigenverantwortung</a>
								<a href="../infos/#berufswahl">Berufswahl</a>
							</div>
							<div class="wrapper">
								<h2>Förderverein</h2>
								<a href="../verein/#foerderverein">Der Verein</a>
							</div>
							<div class="wrapper">
								<h2>Aktivitäten</h2>
								<a href="../aktiv/#ag-plan">AG-Plan</a>
							</div>
							<div class="wrapper">
								<h2>Personen</h2>
								<a href="../personen/#lehrer">Lehrer / Verwaltung</a>
								<a href="../personen/#elternsprecher">Elternsprecher</a>
								<a href="../personen/#klassensprecher">Klassensprecher</a>
							</div>
							<div class="wrapper">
								<h2>Kontakt</h2>
								<a href="../kontakt/#anschrift">Anschrift</a>
								<a href="../kontakt/#impressum">Impressum</a>
								<a href="../kontakt/#rechtliches">Rechtliches</a>
							</div>
						</footer>
					<nav></nav>
				</body>
				</html>
			<?php
			}
			exit();
		}
	}
	if($path["extension"] == "jpg") {
		header("content-type: image/jpg");
		if(substr($path["filename"], -7) == "_teaser") {
			readfile("../temp/news/" . substr($path["filename"], 0, -7) . "/teaser.jpg");
		} else {
			readfile("../temp/news/" . $path["filename"] . "/bg.jpg");
		}
		exit;
	}

	http_response_code(404);
	header("Location: /errorpage/404.html");
	exit;
?>