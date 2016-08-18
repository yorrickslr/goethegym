/* * * * * * * * * * * * * * * * * * * * *
 * COPYRIGHT Goethegymasium Weimar, 2016 *
 * * * * * * * * * * * * * * * * * * * * */

// define variables
var body;
var main;
var article;

function calcMain() {
	main.style.width = (document.body.clientWidth - 30) + "px";
	article = document.createElement("article");
	article.classList.add("article");
	article.style.left = (-document.body.clientWidth + 100) + "px";
	body.appendChild(article);
}

// called when body loads
function init() {
	body = document.getElementsByTagName("body")[0];
	main = document.getElementsByTagName("main")[0];
	calcMain();
	window.addEventListener("resize",calcMain);
}
