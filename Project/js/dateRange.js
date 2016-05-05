$(document).ready(function() {
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();
	if(dd<10){
	        dd='0'+dd
	    } 
    if(mm<10){
        mm='0'+mm
    } 

	today = yyyy+'-'+mm+'-'+dd;
	var lastYear = yyyy-1+"-"+mm+"-"+dd;
	$("#datefield").attr("max",today);
	$("#datefield").attr("min",lastYear);
});