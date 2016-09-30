<?php
	error_reporting(0);
	if(!isset($_GET["path"])) {
		echo "<h2>500: internal server error!</h2>";
		echo "5: Da ist wohl was schief gelaufen =/";
		exit;
	}

	$path = pathinfo($_GET["path"]);
	if(!isset($path["extension"])) {
		echo "<h2>500: internal server error!</h2>";
		echo "12: Da ist wohl was schief gelaufen =/";
		exit;
	}

	if($path["extension"] == "html") {
		if(isset($_GET["content-only"])) {
			$url = "../temp/news/" . $path["filename"] . "/text.html";
			$file = file_get_contents($url);
			if($file == FALSE) {
				echo "<h2>404: file not found!</h2>";
				echo "22: Da ist wohl was schief gelaufen =/";
			} else {
				echo $file;
			}
			exit;
		} else {
			?>
			<h2>test</h2>
			<?php
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

	echo "<h2>404: file not found!</h2>";
	echo "40: Da ist wohl was schief gelaufen =/";
?>