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
			<a href="infos/" title="Informationen rund um die Schule" class="material-icon">&#xE88F;</a>
			<a href="verein/" title="Förderverein" class="material-icon">&#xE0AF;</a>
			<a href="#" title="Aktivitäten" class="material-icon">&#xE52F;</a>
			<a href="#" title="Personen" class="material-icon">&#xE7EF;</a>
			<a onclick="scrollTiles(-2)" title="Kontakt und Impressum" class="material-icon">&#xE0D1;</a>
			<a onclick="scrollTiles(2)" title="Downloads" class="material-icon">&#xE2C0;</a>
		</nav>
		<a class="login"></a>
	</header>
	<main class="mainpage">
		<h2>News</h2>
		<div class="tilewrapper">
		<?php
			if (!file_exists("temp/news/index.xml")) {
			    ?>
				<h2>Wow. Da ist ganz schön was schiefgelaufen.</h2>
				<p>Die Website will wohl gerade nicht. Schau in ein paar Minuten nochmal vorbei.</p>
				<?php 
				exit();
			}
			$articles = simplexml_load_file("temp/news/index.xml");
			$count = rand(1,6);
			foreach($articles->article as $article) {
				?>
				<a href="<?= 'news/' . $article->path . '.html' ?>" name="<?= $article->title ?>" onclick="loadArticle(event,'<?= $article->path ?>');" class="newstile" style="background-image: url('<?= 'news/' . $article->path . '_teaser.jpg' ?>');">
					<img src="images/pattern<?= $count ?>.png">
					<h3><?= $article->title ?></h3>
					<article>
					<?php
						$url = "temp/news/" . $article->path . "/teaser.txt";
						$file = file_get_contents($url);
						if($file == FALSE) {
							echo "<h2>404: file not found!</h2>";
							echo "48: Da ist wohl was schief gelaufen =/";
						} else {
							echo $file;
						}
					?>
					</article>
				</a>
				<?php
				$count++;
				if($count==7)
					$count = 1;
			}
			?>
		</div>
	</main>
	<footer></footer>
</body>
</html>