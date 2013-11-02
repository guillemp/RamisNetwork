// OJO! Canviar si canvia servidor
var root = "/RamisNetwork/";

function like(link, user) {
	var url = root + "lib/like.php?user=" + user + "&link=" + link;
	$('#like-' + link).load(url);
}