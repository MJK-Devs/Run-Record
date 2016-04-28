function getNewsFeed() {
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                $("#newsfeed").html(xmlhttp.responseText);
            }
        };
    $(document).ready(function() {
    	$("#newsfeed").html("<p>LOADING</p>");
    	xmlhttp.open("GET", "db/newsfeed.php", true);
    	xmlhttp.send();
    });
}

function newsFeed() {
	window.setInterval(function(){
  		getNewsFeed();
}, 10000);
}

newsFeed();