function myTime()
{
	var Stamp = new Date();
	var Hours;
	var Mins;
	var Secs;
	var Time;
	Hours = Stamp.getHours();
	if (Hours >= 12) {
	Time = " P.M.";
	}
	else {
	Time = " A.M.";
	}
	
	if (Hours > 12) {
	Hours -= 12;
	}
	
	if (Hours == 0) {
	Hours = 12;
	}
	
	Mins = Stamp.getMinutes();
	
	if (Mins < 10) {
	Mins = "0" + Mins;
	}
	
	Secs = Stamp.getSeconds();
	
	if (Secs < 10) {
	Secs = "0" + Secs;
	}
	
	document.getElementById("Time").innerHTML = Hours+":"+Mins+":"+Secs+" "+Time;
}
window.setInterval("myTime()",1000);