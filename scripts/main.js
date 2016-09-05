var body;
var main;
var article;
var footer;

// mainpage
var tiles;
var tilepos = 0;

function log(string) {
	//console.log(string);
}

function initialize() {
	log("initialize()");
	if(!document.addEventListener) {
		alert("Diese Website unterstützt Ihre Browserversion nur eingeschränkt. " +
			"Verwenden Sie bitte einen neueren Browser wie z.B. Firefox.");
	} else {
		body = document.getElementsByTagName("body")[0];
		main = document.getElementsByTagName("main")[0];
		footer = document.getElementsByTagName("footer")[0];
	}
}

function initMain() {
	initialize();
	tiles = document.getElementsByClassName("tilewrapper")[0];
	log("initMain()");
	main.style.padding = "0";
	main.style.top = "50px";
	main.style.position = "absolute";
	main.style.width = document.body.clientWidth + "px";
	window.addEventListener("resize",function(){
		main.style.width = document.body.clientWidth + "px";
	});
	main.style.height = tiles.offsetHeight + tiles.offsetTop + "px"; 
	main.style.overflow = "hidden";
	tiles.style.position = "absolute";
	tiles.style.top = tiles.offsetTop + "px";
	tiles.style.left = 0;
	tiles.style.overflow = "hidden";
	tiles.style.transitionDuration = ".5s";
	footer.style.position = "absolute";
	footer.style.top = main.offsetHeight + 50 + "px";
}

function scrollTiles(count) {
	if(tilepos+count < 0) {
		tilepos = 0;
	} else if(tilepos+count+1 >= tiles.children.length) {
		tilepos = tiles.children.length - 1;
	} else {
		tilepos += count;
	}
	tiles.style.left = -tilepos * 395 + "px";
}

function initSub() {
	initialize();
	log("initSub()");
}

function setMain() {
	log("setMain()");
	main.style.width = document.body.clientWidth + "px";
}