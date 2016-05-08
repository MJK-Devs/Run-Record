function getNewsFeed() {
	var lastRun = $(".panel").slice(0).attr('id');
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            	//Get Response Text and Parse it as JSON
                	var obj = $.parseJSON(xmlhttp.responseText);
                	if(obj.ID == lastRun){/*DO NOTHING*/}
                	else{
                		$("#newsfeed").prepend(obj.HTML);
						$(".panel").slice(-1).remove();
                	}
				}
        };

    	xmlhttp.open("GET", "db/newsfeed.php", true);
    	xmlhttp.send();
}

function newsFeed() {
	window.setInterval(function(){
  		getNewsFeed();
	}, 10000);
}

newsFeed();