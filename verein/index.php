<?php
	//error_reporting(0);
	if(!isset($_GET["path"])) {
		http_response_code(500);
		echo "<h2>500: internal server error!</h2>";
		echo "5: Da ist wohl was schief gelaufen =/";
		exit;
	}

	$path = pathinfo($_GET["path"]);
	if(!isset($path["extension"])) {
		http_response_code(500);
		echo "<h2>500: internal server error!</h2>";
		echo "12: Da ist wohl was schief gelaufen =/";
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
			<header>
				<a href="../index.php"><h1>goethegym.net</h1></a>
				<nav>
					<a href="../infos/" title="Informationen rund um die Schule" class="material-icon">&#xE88F;</a>
					<a href="#" title="Förderverein" class="material-icon">&#xE0AF;</a>
					<a href="#" title="Aktivitäten" class="material-icon">&#xE52F;</a>
					<a href="#" title="Personen" class="material-icon">&#xE7EF;</a>
					<a onclick="scrollTiles(-2)" title="Kontakt und Impressum" class="material-icon">&#xE0D1;</a>
					<a onclick="scrollTiles(2)" title="Downloads" class="material-icon">&#xE2C0;</a>
				</nav>
				<a class="login"></a>
			</header>
			<main class="subsite">
			<?php
				if($path["filename"]=="index" || $path["filename"]=="") {
					$articles = simplexml_load_file("../temp/verein/index.xml");
					?>
					<h2>Förderverein</h2>
					<nav>
					<?php
						foreach($articles->article as $article) {
							echo '<a href="#' . $article->path . '">' . $article->title . "</a>";
						}
						echo "</nav>\n<article>";
						foreach($articles->article as $article) {
							$url = "../temp/verein/" . $article->path . ".html";
							$file = file_get_contents($url);
							if($file == FALSE) {
								http_response_code(404);
								echo "<h2>404: file not found!</h2>";
								echo "22: Da ist wohl was schief gelaufen =/";
							} else {
								echo '<a class="anchor" name="' . $article->path . '"></a><h3>' . $article->title . '</h3>';
								echo $file;
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
	}

	if($path["extension"] == "html") {
		$url = "../temp/verein/" . $path["filename"] . ".html";
		$file = file_get_contents($url);
		if($file == FALSE) {
			http_response_code(404);
			echo "<h2>404: file not found!</h2>";
			echo "22: Da ist wohl was schief gelaufen =/";
		} else {
			?>
					<article>
						<?= $file ?>
					</article>
				</main>
				<footer></footer>
				<nav></nav>
			</body>
			</html>
			<?php
		}
		exit;
	}

	http_response_code(404);
	echo "<h2>404: file not found!</h2>";
	echo "40: Da ist wohl was schief gelaufen =/";
?>