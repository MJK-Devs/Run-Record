function getNewsFeed() {
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("newsfeed").innerHTML = xmlhttp.responseText;
            }
        };
    xmlhttp.open("GET", "/Web2/RR/db/newsfeed.php", true);
    xmlhttp.send();
}

function newsFeed() {
	window.setInterval(function(){
  		getNewsFeed
}, 1000);
}