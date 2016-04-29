
//var lastRun=0;

function getNewsFeed() {
	var lastRun = $(".panel").slice(0).attr('id');
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
            
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            	//Get Response Text and Parse it as JSON
                	var obj = $.parseJSON(xmlhttp.responseText);
                	if(obj.ID == lastRun){/*DO NOTHING*/}
                	else{
                		//$("#newsfeed").prepend(obj);
                		$("#newsfeed").prepend(obj.HTML);
						$(".panel").slice(-1).remove();
                	}
				}
        };

    	xmlhttp.open("GET", "db/newsfeed.php", true);
    	xmlhttp.send();
    	
        //$("#newsfeed").prepend('<p>'+lastRun.attr('id')+'</p>');


}

function newsFeed() {
	
	window.setInterval(function(){
  		getNewsFeed();
	}, 10000);
}

function fadeSwitchElements(id1, id2)
    {
        var element1 = $('#' + id1);
        var element2 = $('#' + id2);
        
        /*if(element1.is(':visible'))
        {
            element1.fadeToggle(500);
            element2.fadeToggle(500);
        }
        else
        {
             element2.fadeToggle(500, function() {
                element1.fadeToggle(500);
            });   
        } */   
        element1.fadeToggle(500);
        element2.fadeToggle(500);
    }



newsFeed();
//getNewsFeed(0);