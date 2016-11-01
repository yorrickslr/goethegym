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
var switches = [];

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
			main.style.width = body.clientWidth + "px";
			tempheight = 0;
			if(body.clientHeight > 750)
				tempheight = body.clientHeight - 50;		
			else
				tempheight = 800;
			main.style.height = tempheight + "px";
			if(tempheight + 50 < body.clientHeight) {
				footer.style.top = body.clientHeight + "px";
			} else {
				footer.style.top = (tempheight + 50) + "px";
			}
			article.style.width = 0.6 * body.clientWidth - 50 + "px";
			console.log("Tempheight: " + tempheight);
			article.style.minHeight = tempheight + "px";
			bgimage.style.width = tempheight + "px";
			if(shown) {
				main.style.width = 0.2 * body.clientWidth + "px";
				main.style.left = 0.8 * body.clientWidth + "px";
				window.setTimeout(function() {
					footer.style.top = article.offsetHeight + "px";
				}, 500);
				article.style.left = 0.2 * body.clientWidth + "px";
			}
		});
	}
}

function initMain() {
	tiles = document.getElementsByClassName("tilewrapper")[0];
	log("initMain()");

	main.classList.add("js_main");
	main.style.width = body.clientWidth + "px";
	tempheight = 0;
	if(body.clientHeight > 750)
		tempheight = body.clientHeight - 50;		
	else
		tempheight = 800;
	main.style.height = tempheight + "px";
	main.classList.add("js_main_additional");

	tiles.classList.add("js_tiles");

	footer.classList.add("js_footer");
	if(tempheight + 50 < body.clientHeight) {
		footer.style.top = body.clientHeight + "px";
	} else {
		footer.style.top = (tempheight + 50) + "px";
	}

	article = document.createElement("article");
	article.classList.add("js_article");
	article.style.width = 0.6 * body.clientWidth - 50 + "px";
	article.style.minHeight = tempheight + "px";
	body.appendChild(article);

	bgimage = document.createElement("div");
	bgimage.classList.add("js_bgimage");
	bgimage.style.width = 0.2 * body.clientWidth + "px";
	bgimage.style.height = tempheight + "px";
	body.appendChild(bgimage);

	switch_shadow_left = document.createElement("div");
	switch_shadow_left.className = "js_switchshadow";
	switch_shadow_left.style.left = "25px";
	main.appendChild(switch_shadow_left);
	switch_shadow_right = document.createElement("div");
	switch_shadow_right.className = "js_switchshadow";
	switch_shadow_right.style.right = "25px";
	main.appendChild(switch_shadow_right);
	switch_left = document.createElement("div");
	switch_right = document.createElement("div");
	switch_left.className = "js_switch js_switch_left";
	switch_right.className = "js_switch js_switch_right";
	switch_left.onclick = function(){scrollTiles(-2)};
	switch_right.onclick = function(){scrollTiles(2)};
	main.appendChild(switch_left);
	main.appendChild(switch_right);
	switches.push(switch_right, switch_shadow_right);
	/* 
	if(typeof(user) === "undefined") {
		article.addEventListener("copy", function(e){
			e.preventDefault();
			alert("Zum Kopieren von Texten bitte anmelden oder per Mail anfragen!");
		});
	}
	*/
}

function scrollUp() {
	window.scrollTo(0,0);
}

function scrollTiles(count) {
	if(typeof(count) === "undefined" || shown==1) {
		return;
	}
	if(tilepos+count < 0) {
		tilepos = 0;
	} else if(tilepos+count+1 >= tiles.children.length) {
		tilepos = tiles.children.length -1;
	} else {
		tilepos += count;
	}
	tiles.style.left = -tilepos * 395 + 50 + "px";
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
		for(i=0; i<switches.length; i++) {
			switches[i].style.opacity = 0;
		}
		if(!typeof(document.getElementById("infobox") === "undefined"))
			document.getElementById("infobox").style.cursor = "pointer";
		scrollTo(0,0);
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
	if(!typeof(document.getElementById("infobox") === "undefined"))
			document.getElementById("infobox").style.cursor = "auto";
	footer.style.top = main.offsetHeight + 50 + "px";
	//scrollUp();
	scrollTo(0,0);
	for(i=0; i<switches.length; i++) {
		switches[i].style.opacity = 1;
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
		hideLogin();
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
		showLogin();
	}
	main.removeEventListener("click", hideLogin);
}
