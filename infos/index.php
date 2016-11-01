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
			<script src="../scripts/main.js"></script>
		</head>
		<body onload="initialize();">
			<header class="noselect">
				<a href="../index.php"><h1>goethegym.net</h1></a>
				<nav>
					<a href="../infos/" title="Informationen rund um die Schule" class="current material-icon">&#xE88F;</a>
					<a href="../verein/" title="Förderverein" class="material-icon">&#xE0AF;</a>
					<a href="../aktiv/" title="Aktivitäten" class="material-icon">&#xE52F;</a>
					<a href="../personen/" title="Personen" class="material-icon">&#xE7EF;</a>
					<a href="../kontakt/" title="Kontakt und Impressum" class="material-icon">&#xE0D1;</a>
					<a href="../downloads/" title="Downloads" class="material-icon">&#xE2C0;</a>
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
			<?php
				if($path["filename"]=="index" || $path["filename"]=="") {
					$articles = simplexml_load_file("../temp/infos/index.xml");
					?>
					<h2>Informationen rund um die Schule</h2>
					<nav>
					<?php
						foreach($articles->article as $article) {
							echo '<span class="nobreak"><a href="#' . $article->path . '">' . $article->title . "</a></span>";
						}
						echo "</nav>\n<article>";
						foreach($articles->article as $article) {
							$url = "../temp/infos/" . $article->path . ".html";
							$file = file_get_contents($url);
							if($file == FALSE) {
								http_response_code(404);
								header("Location: ../errorpages/404.html");
								exit;
							} else {
								echo '<a class="anchor" name="' . $article->path . '"></a><h3>' . $article->title . '</h3>';
								echo $file;
							}
						}
					?>
				</article>
				<a class="up" href="#"></a>
			</main>
			<footer class="noselect">
					<div class="wrapper">
						<h2>Informationen</h2>
						<a href="infos/#geschichte">Geschichte</a>
						<a href="infos/#konzept">Konzept</a>
						<a href="infos/#moeglichkeiten">Spezialisierung</a>
						<a href="infos/#ausbildungsschule">Ausbildungsschule</a>
						<a href="infos/#jugend-debattiert">Jugend debattiert</a>
						<a href="infos/#eigenverantwortung">Eigenverantwortung</a>
						<a href="infos/#berufswahl">Berufswahl</a>
					</div>
					<div class="wrapper">
						<h2>Förderverein</h2>
						<a href="verein/#foerderverein">Der Verein</a>
					</div>
					<div class="wrapper">
						<h2>Aktivitäten</h2>
						<a href="aktiv/#ag-plan">AG-Plan</a>
					</div>
					<div class="wrapper">
						<h2>Personen</h2>
						<a href="personen/#lehrer">Lehrer / Verwaltung</a>
						<a href="personen/#elternsprecher">Elternsprecher</a>
						<a href="personen/#klassensprecher">Klassensprecher</a>
					</div>
					<div class="wrapper">
						<h2>Kontakt</h2>
						<a href="kontakt/#anschrift">Anschrift</a>
						<a href="kontakt/#impressum">Impressum</a>
						<a href="kontakt/#rechtliches">Rechtliches</a>
					</div>
				</footer>
			</body>
			</html>
		<?php
		exit();
	}

	if($path["extension"] == "html") {
		$url = "../temp/infos/" . $path["filename"] . ".html";
		$file = file_get_contents($url);
		if($file == FALSE) {
			http_response_code(404);
			header("Location: ../errorpages/404.html");
			exit;
		} else {
			?>
					<article>
						<?= $file ?>
					</article>
				</main>
				<footer class="noselect">
						<div class="wrapper">
							<h2>Informationen</h2>
							<a href="infos/#geschichte">Geschichte</a>
							<a href="infos/#konzept">Konzept</a>
							<a href="infos/#moeglichkeiten">Spezialisierung</a>
							<a href="infos/#ausbildungsschule">Ausbildungsschule</a>
							<a href="infos/#jugend-debattiert">Jugend debattiert</a>
							<a href="infos/#eigenverantwortung">Eigenverantwortung</a>
							<a href="infos/#berufswahl">Berufswahl</a>
						</div>
						<div class="wrapper">
							<h2>Förderverein</h2>
							<a href="verein/#foerderverein">Der Verein</a>
						</div>
						<div class="wrapper">
							<h2>Aktivitäten</h2>
							<a href="aktiv/#ag-plan">AG-Plan</a>
						</div>
						<div class="wrapper">
							<h2>Personen</h2>
							<a href="personen/#lehrer">Lehrer / Verwaltung</a>
							<a href="personen/#elternsprecher">Elternsprecher</a>
							<a href="personen/#klassensprecher">Klassensprecher</a>
						</div>
						<div class="wrapper">
							<h2>Kontakt</h2>
							<a href="kontakt/#anschrift">Anschrift</a>
							<a href="kontakt/#impressum">Impressum</a>
							<a href="kontakt/#rechtliches">Rechtliches</a>
						</div>
					</footer>
				</body>
				</html>
			<?php
		}
		exit;
	}

	http_response_code(404);
	header("Location: ../errorpages/404.html");
	exit;
?>