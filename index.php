<!DOCTYPE html>
<!-- saved from url=(0023)http://goethegym.net/ -->
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
	<link href="styles/styles.css" type="text/css" rel="stylesheet">
	<script src="scripts/main.js"></script>
</head>
<body onload="initialize(); initMain();">
	<header class="noselect">
		<a href="#" onclick="reset()"><h1>goethegym.net</h1></a>
		<nav>
			<a href="infos/" title="Informationen rund um die Schule" class="material-icon">&#xE88F;</a>
			<a href="verein/" title="Förderverein" class="material-icon">&#xE0AF;</a>
			<a href="aktiv/" title="Aktivitäten" class="material-icon">&#xE52F;</a>
			<a href="personen/" title="Personen" class="material-icon">&#xE7EF;</a>
			<a href="kontakt/" title="Kontakt und Impressum" class="material-icon">&#xE0D1;</a>
			<a href="downloads/" title="Downloads" class="material-icon">&#xE2C0;</a>
		</nav>
		<a class="login material-icon" onclick="showLogin(this);">&#xE853;</a>
	</header>
	<div id="login">
		<a href="media/files/vertretungsplan.pdf" target="_blank">Vertretungsplan</a><br>
		<a href="media/files/stundenplan.pdf" target="_blank">Stundenplan</a><br>
		<a href="media/files/monatsplan.pdf" target="_blank">Monatsplan</a><br>
		<a href="media/files/jahresplan.pdf" target="_blank">Jahresplan</a><br>
		<a href="downloads/" style="float: right; font-size: 1.2em; margin-top: 0px;">mehr...</a><br>
	</div>
	<main class="mainpage">
		<h2>News</h2>
		<div class="tilewrapper noselect">
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
			if(isset($articles->info)) {
				echo '<div class="newstile" id="infobox" style="background-image:url(images/attention.jpg); padding-top: 360px; cursor: auto; height: 290px; margin-right: 15px">';
				echo '<h3 style="color: #555;">Wichtige Informationen</h3>';
				echo '<ul>';
				foreach($articles->info as $info) {
					echo "<li>" . $info . '</li>';
				}
				echo '</ul>';
				echo '</div>';
			}
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
							echo "<h2>404 - file not found!</h2>";
							echo "Da ist wohl was schief gelaufen =/";
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