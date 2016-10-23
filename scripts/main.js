var body;
var main;
var article;
var footer;
var bgimage;

// mainpage
var tiles;
var tilepos = 0;
var shown = 0;
var login;
var loginbutton;

function log(string) {
	console.log(string);
}

function initialize() {
	log("initialize()");
	if(!document.addEventListener) {
		alert("Diese Website unterstützt Ihre Browserversion nur eingeschränkt. " +
			"Verwenden Sie bitte einen neueren Browser wie z.B. Firefox.");
	} else {
		body = document.body;
		main = document.getElementsByTagName("main")[0];
		footer = document.getElementsByTagName("footer")[0];
		login = document.getElementById("login");
		loginbutton = document.getElementsByClassName("login")[0];
		window.addEventListener("resize", function() {
			if(shown) {
				log("resize with displayed article");
			} else {
				log("resize with displayed main");
			}
		});
	}
}

function initMain() {
	tiles = document.getElementsByClassName("tilewrapper")[0];
	log("initMain()");
	main.style.padding = "0";
	main.style.top = "50px";
	main.style.position = "absolute";
	main.style.width = body.clientWidth + "px";
	window.addEventListener("resize",function(){
		main.style.width = body.clientWidth + "px";
	});
	if(body.clientHeight - 50 > main.offsetHeight)
		main.style.height = body.clientHeight - 50 + "px";
	else
		main.style.height = tiles.offsetHeight + tiles.offsetTop + "px";
	main.style.overflow = "hidden";
	main.style.transitionDuration = ".5s";
	main.style.left = 0;
	tiles.style.position = "absolute";
	tiles.style.top = tiles.offsetTop + "px";
	tiles.style.left = 0;
	tiles.style.overflow = "hidden";
	tiles.style.transitionDuration = ".5s";
	footer.style.position = "absolute";
	if(footer.offsetTop<body.clientHeight)
	footer.style.top = main.offsetHeight + 50 + "px";
	footer.style.zIndex = 5;
	footer.style.transitionDuration = ".5s";
	article = document.createElement("article");
	article.style.position = "absolute";
	article.style.top = "50px";
	article.style.left = 0;
	article.style.width = 0.6 * body.clientWidth - 50 + "px";
	article.style.minHeight = main.offsetHeight + "px";
	article.style.boxShadow = "0 0 10px #555";
	article.style.backgroundColor = "#fff";
	article.style.transitionDuration = ".5s";
	article.style.padding = "0 25px 100px 25px";
	article.style.zIndex = 3;
	article.style.textAlign = "justify";
	article.style.fontSize = "1.1em";
	body.appendChild(article);
	bgimage = document.createElement("div");
	bgimage.style.position = "fixed";
	bgimage.style.top = "50px";
	bgimage.style.left = 0;
	bgimage.style.width = 0.2 * body.clientWidth + "px";
	bgimage.style.height = body.clientHeight - 50 + "px";
	bgimage.style.zIndex = 0;
	bgimage.backgroundColor = "pink";
	bgimage.style.backgroundImage = "url(images/fill_pattern.png)";
	bgimage.style.backgroundSize = "75%";
	bgimage.style.backgroundPosition = "center";
	body.appendChild(bgimage);
	tileswitch_left = document.createElement("div");
	tileswitch_right = document.createElement("div");
	tileswitch_left.className = "tileswitch tileswitch_left";
	tileswitch_right.className = "tileswitch tileswitch_right";
	tileswitch_left.onclick = function(){scrollTiles(-2)};
	tileswitch_right.onclick = function(){scrollTiles(2)};
	main.appendChild(tileswitch_left);
	main.appendChild(tileswitch_right);
}

function scrollUp() {
	window.scrollTo(0,0);
}

function scrollTiles(count) {
	if(typeof(count) === "undefined") {
		return;
	}
	if(tilepos+count < 0) {
		tilepos = 0;
	} else if(tilepos+count+1 >= tiles.children.length) {
		tilepos = tiles.children.length -1;
	} else {
		tilepos += count;
	}
	tiles.style.left = -tilepos * 395 + "px";
}

function loadArticle(event,path) {
	try{
		event.preventDefault();
	} finally {
		if(shown==1) return;
		main.style.width = 0.2 * body.clientWidth + "px";
		main.style.left = 0.8 * body.clientWidth + "px";
		main.style.boxShadow = "0 0 10px #555";
		main.style.cursor = "pointer";
		main.style.position = "fixed";
		main.addEventListener("click",reset,true);
		article.style.left = 0.2 * body.clientWidth + "px";
		for(tileswitch of document.getElementsByClassName("tileswitch")) {
			tileswitch.style.opacity = 0;
		}
		try {
			document.getElementById("infobox").style.cursor = "pointer";
		} finally {
			log("no infos found");
		}
		shown = 1;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				article.innerHTML = this.responseText;
				footer.style.top = article.offsetHeight + "px";
			}
		};
		log(event.target);
		target = "news?path=" + path + ".html&content-only";
		xhttp.open("GET", target, true);
		xhttp.send();
		tmpimg = new Image();
		tmpimg.addEventListener("load",function(){
			if(this.width<1) {
				bgimage.style.backgroundImage = "url(images/fill_pattern.png)";
				bgimage.style.backgroundSize = "75%";
			} else {
				bgimage.style.backgroundImage = "url('news/" + path + ".jpg')";
				bgimage.style.backgroundSize = "cover";
			}
		})
		tmpimg.src = "news/" + path + ".jpg";
	}
}

function reset() {
	if(shown==0) return;
	main.removeEventListener("click",reset,true);
	main.style.left = 0;
	main.style.width = body.clientWidth + "px";
	main.style.cursor = "auto";
	main.style.position = "absolute";
	article.style.left = 0;
	try {
		document.getElementById("infobox").style.cursor = "auto";
	} finally {
		log("no infos found");
	}
	footer.style.top = main.offsetHeight + 50 + "px";
	//scrollUp();
	scrollTo(0,0);
	for(tileswitch of document.getElementsByClassName("tileswitch")) {
		tileswitch.style = "";
	}	
	setTimeout(function(){
		article.innerHTML = "";
		shown = 0;
		bgimage.style.backgroundImage = "url(images/fill_pattern.png)";
		bgimage.style.backgroundSize = "75%";
	}, 500);
}

function showLogin() {
	login.style.display = "initial";
	window.setTimeout(function() {
		login.style.opacity = 1;
		login.style.top = "60px";
	},200);
	loginbutton.onclick = function() {
		hideLogin(this);
	}
	main.addEventListener("click", hideLogin);
}

function hideLogin() {
	login.style.opacity = 0;
	login.style.top = "50px";
	window.setTimeout(function() {
		login.style.display = "none";
	},200);
	loginbutton.onclick = function() {
		showLogin(this);
	}
	main.removeEventListener("click", hideLogin);
}
