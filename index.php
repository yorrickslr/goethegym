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
			foreach($articles->article as $article) {
				?>
				<a href="<?= 'news/' . $article->path . '.html' ?>" name="<?= $article->title ?>" onclick="loadArticle(event,'<?= $article->path ?>');" class="newstile" style="background-image: url('<?= 'news/' . $article->path . '_teaser.jpg' ?>');">
					<img src="images/pattern<?= rand(1,6) ?>.png">
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
			}
			?>
		</div>
	</main>
	<footer></footer>
</body>
</html>