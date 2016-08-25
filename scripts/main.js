var debug = 1;

var body;
var main;
var article;

function initialize() {
	if(debug) console.log("initialize()");
	if(!document.addEventListener) {
		alert("Diese Website unterstützt Ihre Browserversion nur eingeschränkt. " +
			"Verwenden Sie bitte einen neueren Browser wie z.B. Firefox.");
	} else {
		body = document.getElementsByTagName("body")[0];
		main = document.getElementsByTagName("main")[0];
		setMain();
		window.addEventListener("resize",setMain);
	}
}

function setMain() {
	if(debug) console.log("setMain()");
	main.style.width = document.body.clientWidth + "px";
}

function setWrapper() {

}