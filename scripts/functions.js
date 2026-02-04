function ShowHide(id,spn) {
	 var targetElement = document.getElementById(id);
	 var targetSpn = document.getElementById(spn);
        if(targetElement.style.display == 'none')
		{
            targetElement.style.display='';
			targetSpn.innerHTML = '';
			targetSpn.innerHTML = 'Hide';
			
		}
        else if(targetElement.style.display == '')
		{
            targetElement.style.display='none';
			targetSpn.innerHTML = '';
			targetSpn.innerHTML = 'Show';
		}

        return true;
}

function ShowHideOther(id,spn)
{
	
	 var targetElement = document.getElementById("view_"+id);
	 var editElement = document.getElementById("edit_"+id);
	// var targetSpn = document.getElementById(spn);
        if(targetElement.style.display == 'none')
		{
            targetElement.style.display='';
			editElement.style.display='none';
		}
        else if(targetElement.style.display == '')
		{
            targetElement.style.display='none';
			editElement.style.display='';
		}
}

function toggleChild(parentId)
{
	var mid = document.getElementById(parentId).value;
	var counter=document.getElementById('hidModule'+mid).value;
	for(var i=1; i<counter; i++ )
	{
		if(document.getElementById(parentId).checked == true)
		{
			document.getElementById('submodule'+mid+i).checked = true;               
		}
		else
		{
			document.getElementById('submodule'+mid+i).checked = false; 
		}
	}
}

function toggleS(parentId)
{	
	var sid = document.getElementById(parentId).value;
	var counter=document.getElementById('hidService'+sid).value;
	for(var i=1; i<counter; i++ )
	{
		if(document.getElementById(parentId).checked == true)
		{
			document.getElementById('module'+sid+i).checked = true;
			var mod = 'module'+sid+i;
			toggleChild(mod);
		}
		else
		{
			document.getElementById('module'+sid+i).checked = false;
			var mod = 'module'+sid+i;
			toggleChild(mod);
		}
	}
}


function removeChar(item)
{ 
	var val = item.value;
  	val = val.replace(/[^,.0-9]/g, "");  
  	if (val == ' '){val = ''};   
  	item.value=val;
}

function removeNumber(item)
{ 
	//alert('hi therer');
	var val = item.value;
	val = val.replace(/[^A-Za-z]/g, "");
	if (val == ' '){val = ''};   
	item.value=val;
}

function check(id)
{
	var num_items = document.getElementById('num_of_'+id).value;
	
	if(document.getElementById(id+'_all').checked == true)
	{
		for(var i=1;i<num_items;i++)
		{
			document.getElementById(id+i).checked = true;
		}
	}
	else
	{
		for(var i=1;i<num_items;i++)
		{
			document.getElementById(id+i).checked = false;
		}
	}
}

function check_all(id)
{
	//alert(id);
	var num_items = document.getElementById('num_of_'+id).value;
	//alert(num_items);
	if(document.getElementById(id+'_all').checked == true)
	{
		for(var i=1;i<num_items;i++)
		{
			document.getElementById(id+i).checked = true;
		}
		//alert(num_items);
	}
	else
	{
		for(var i=1;i<num_items;i++)
		{
			document.getElementById(id+i).checked = false;
		}
		//alert('hello');
	}
}

function check_me(id)
{
	var num_items = document.getElementById('num_of_'+id).value;
	var flag = true;
	for(var i=1;i<num_items;i++)
	{
		if(document.getElementById(id+i).checked == false)
		{
			flag = false;
			break;
		}
	}
	if(flag)
	{
		document.getElementById(id+'_all').checked = true;
	}
	else
	{
		document.getElementById(id+'_all').checked = false;
	}
}

function showCalender(DateField,btnField)
{
	var cal = new Zapatec.Calendar.setup({
		inputField:DateField,
		ifFormat:"%d-%m-%Y",
		button:btnField,
		showsTime:false
	});
}

var th = ['','thousand','million', 'billion','trillion'];
// uncomment this line for English Number System
// var th = ['','thousand','million', 'milliard','billion'];

var dg = ['zero','one','two','three','four', 'five','six','seven','eight','nine']; 
var tn = ['ten','eleven','twelve','thirteen', 'fourteen','fifteen','sixteen', 'seventeen','eighteen','nineteen']; 
var tw = ['twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety']; 

function toWords(s,destinationF)
{
	//array_assign=new Array();
	//array_assign[s];
	s = s.toString(); 
	s = s.replace(/[\, ]/g,''); 
	if (s != parseFloat(s)) 
	return 'not a number'; 
	var x = s.indexOf('.'); 
	if (x == -1) x = s.length; 
	if (x > 15) 
	return 'too big'; 
	var n = s.split(''); 
	var str = ''; 
	var sk = 0; 
	
	for (var i=0; i < x; i++) 
		{
				
				if ((x-i)%3==2) 
				{	
					//alert(i);
					if (n[i] == '1') 
						{
							str += tn[Number(n[i+1])] + ' '; 
							i++; 
							sk=1;
							
							
						} 
					else if (n[i]!=0) 
						{
							str += tw[n[i]-2] + ' ';
							sk=1;
							//alert(str);
						}
				} 
				
				else if (n[i]!=0) 
				{	
					str += dg[n[i]] +' '; 
					if ((x-i)%3==0) 
					str += 'hundred ';
					sk=1;
					//alert(str);
				} 
				if ((x-i)%3==1) 
				{	
					if (sk) str += th[(x-i-1)/3] + ' ';
					sk=0;
					//alert(str);
				}
				
		} 
	if (x != s.length) 
		{
			var y = s.length;
			//alert(y);
			str += 'point ';
			//alert(str);
			for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';
		} 
	//alert(str);
	if(destinationF == '') {
		return str.replace(/\s+/g,' ');
	} else {
		document.getElementById(destinationF).value=str.replace(/\s+/g,' ');
	}
	//return str.replace(/\s+/g,' ');
	
}


Number.prototype.formatMoney = function(decPlaces, thouSeparator, decSeparator) {
    var n = this,
    decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
    decSeparator = decSeparator == undefined ? "." : decSeparator,
    thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
    sign = n < 0 ? "-" : "",
    i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
    j = (j = i.length) > 3 ? j % 3 : 0;
    return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
};

function numberFormat(fieldID,numStr,decPlaces, thouSeparator, decSeparator){
	numStr = numStr.toString();
	numStr = (numStr.indexOf(',') >= 0) ? Number(numStr.replace(/\,/g,"")) : Number(numStr);
	var formattedMoney = numStr.formatMoney(decPlaces,thouSeparator,decSeparator);
	if(fieldID == '') {
		return formattedMoney;
	} else {
		$("#"+fieldID).attr('value',formattedMoney);
	}
	
	return true;
}

function goBackPage(url){
	window.location.href = url;
}

function checkEmail(email){
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (!filter.test(email)) {
		alert('Please enter a valid email address');
		return false;
	}
	return true;
}

// Source: http://stackoverflow.com/questions/497790
var dates = {
    convert:function(d) {
        // Converts the date in d to a date-object. The input can be:
        //   a date object: returned without modification
        //  an array      : Interpreted as [year,month,day]. NOTE: month is 0-11.
        //   a number     : Interpreted as number of milliseconds
        //                  since 1 Jan 1970 (a timestamp) 
        //   a string     : Any format supported by the javascript engine, like
        //                  "YYYY/MM/DD", "MM/DD/YYYY", "Jan 31 2009" etc.
        //  an object     : Interpreted as an object with year, month and date
        //                  attributes.  **NOTE** month is 0-11.
        
		return (
            d.constructor === Date ? d :
            d.constructor === Array ? new Date(d[0],d[1],d[2]) :
            d.constructor === Number ? new Date(d) :
            d.constructor === String ? new Date(d) :
            typeof d === "object" ? new Date(d.year,d.month,d.date) :
            NaN
        );
    },
    compare:function(a,b) {
        // Compare two dates (could be of any type supported by the convert
        // function above) and returns:
        //  -1 : if a < b
        //   0 : if a = b
        //   1 : if a > b
        // NaN : if a or b is an illegal date
        // NOTE: The code inside isFinite does an assignment (=).
        return (
            isFinite(a=this.convert(a).valueOf()) &&
            isFinite(b=this.convert(b).valueOf()) ?
            (a>b)-(a<b) :
            NaN
        );
    },
    inRange:function(d,start,end) {
        // Checks if date in d is between dates in start and end.
        // Returns a boolean or NaN:
        //    true  : if d is between start and end (inclusive)
        //    false : if d is before start or after end
        //    NaN   : if one or more of the dates is illegal.
        // NOTE: The code inside isFinite does an assignment (=).
       return (
            isFinite(d=this.convert(d).valueOf()) &&
            isFinite(start=this.convert(start).valueOf()) &&
            isFinite(end=this.convert(end).valueOf()) ?
            start <= d && d <= end :
            NaN
        );
    }
}

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}



