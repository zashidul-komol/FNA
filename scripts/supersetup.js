// JavaScript Document
<!--
function ShowHide(id)
{
	 
	alert('hi');
	var targetElement = document.getElementById(id);
        if(targetElement.style.display == 'none')
            targetElement.style.display='';
        else if(targetElement.style.display == '')
            targetElement.style.display='none'

        return false;
}

function GetXmlHttpObject()
{
	var xmlHttp=null;
	try
	  {
	  // Firefox, Opera 8.0+, Safari
	  xmlHttp=new XMLHttpRequest();
	  }
	catch (e)
	  {
	  // Internet Explorer
	  try
		{
		xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
	  catch (e)
		{
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	  }
	return xmlHttp;
}

var xmlHttp0;
var xmlHttp1;
var pf;
function getmodule(f)
{
try{
//if(bflag)
//{	
	pf = f;
	xmlHttp0=GetXmlHttpObject();
	if (xmlHttp0==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	}
	var url="Ajax/get_module.php";
	if(f==0)
		url=url+"?userid="+document.SubModuleForm.productTypeCombo.value;
	else if(f==1)
		url=url+"?userid="+document.FileForm.productTypeCombo.value;
	//alert(url);
	url=url+"&flag="+f+"&sid="+Math.random();
	xmlHttp0.onreadystatechange=stateChanged0;
	xmlHttp0.open("GET",url,true);
	xmlHttp0.send(null);
	if(f==0)
		document.getElementById("showcategory").innerHTML = '<img src="../../DesignImage/loading.gif"/>';
	else if(f==1)
	{
		document.getElementById("showcategory1").innerHTML = '<img src="../../DesignImage/loading.gif"/>';
		document.getElementById("showcategory2").innerHTML = '<select name="productTypeCombo2" id="productTypeCombo2" class="BDJdropdownlist" style="width:144px; " disabled><option value="">No Module Selected</option></select>';
	}
//}
}
catch(exception){
alert(exception);
}
}

function stateChanged0() 
{ 
	if (xmlHttp0.readyState==4)
	{
		if(pf==0)
			document.getElementById("showcategory").innerHTML = xmlHttp0.responseText;
		else if(pf==1)
			document.getElementById("showcategory1").innerHTML = xmlHttp0.responseText;
		//document.getElementById("subcategorydiv").innerHTML = 'No Service Selected';
	}
}

function getsubmodule()
{
try{
//if(bflag)
//{	
	xmlHttp1=GetXmlHttpObject();
	if (xmlHttp1==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	}
	var url="Ajax/get_submodule.php";
	url=url+"?userid="+document.FileForm.productTypeCombo1.value;
	//alert(url);
	url=url+"&sid="+Math.random();
	xmlHttp1.onreadystatechange=stateChanged1;
	xmlHttp1.open("GET",url,true);
	xmlHttp1.send(null);
	document.getElementById("showcategory2").innerHTML = '<img src="../../DesignImage/loading.gif"/>';
//}
}
catch(exception){
alert(exception);
}
}

function stateChanged1() 
{ 
	if (xmlHttp1.readyState==4)
	{
		document.getElementById("showcategory2").innerHTML = xmlHttp1.responseText;
		//document.getElementById("subcategorydiv").innerHTML = 'No Service Selected';
	}
}


function getSubService(str)
{
	//alert(str);
try{
//if(bflag)
//{	
	xmlHttpSubService=GetXmlHttpObject();
	if (xmlHttpSubService==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	}
	var url="Ajax/get_sub_service.php";
	url=url+"?id="+str;
	//alert(url);
	url=url+"&sid="+Math.random();
	xmlHttpSubService.onreadystatechange=stateChangedSubService;
	xmlHttpSubService.open("GET",url,true);
	xmlHttpSubService.send(null);
	document.getElementById("showSubService").innerHTML = '<img src="../../DesignImage/loading.gif"/>';
//}
}
catch(exception){
alert(exception);
}
}

function stateChangedSubService() 
{ 
	if (xmlHttpSubService.readyState==4)
	{
		document.getElementById("showSubService").innerHTML = xmlHttpSubService.responseText;
		//document.getElementById("subcategorydiv").innerHTML = 'No Service Selected';
	}
}

function getSubService4SM(str)
{
try{
	xmlHttpSubService4SM=GetXmlHttpObject();
	if (xmlHttpSubService4SM==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	}
	var url="Ajax/get_sub_service_4sm.php";
	url=url+"?id="+str;
	url=url+"&sid="+Math.random();
	xmlHttpSubService4SM.onreadystatechange=stateChangedSubService4SM;
	xmlHttpSubService4SM.open("GET",url,true);
	xmlHttpSubService4SM.send(null);
	document.getElementById("showSubService4SM").innerHTML = '<img src="../../DesignImage/loading.gif"/>';
}
catch(exception){
alert(exception);
}
}

function stateChangedSubService4SM() 
{ 
	if (xmlHttpSubService4SM.readyState==4)
	{
		document.getElementById("showSubService4SM").innerHTML = xmlHttpSubService4SM.responseText;
	}
}

function getModule4SM(str)
{
	//alert(str);
try{
//if(bflag)
//{	
	xmlHttpModule4SM=GetXmlHttpObject();
	if (xmlHttpModule4SM==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	}
	var url="Ajax/get_module_4sm.php";
	url=url+"?id="+str;
	//alert(url);
	url=url+"&sid="+Math.random();
	xmlHttpModule4SM.onreadystatechange=stateChangedModule4SM;
	xmlHttpModule4SM.open("GET",url,true);
	xmlHttpModule4SM.send(null);
	document.getElementById("showModule4SM").innerHTML = '<img src="../../DesignImage/loading.gif"/>';
//}
}
catch(exception){
alert(exception);
}
}

function stateChangedModule4SM() 
{ 
	if (xmlHttpModule4SM.readyState==4)
	{
		document.getElementById("showModule4SM").innerHTML = xmlHttpModule4SM.responseText;
	}
}

function getSubService4File(str)
{
	//alert(str);
try{
//if(bflag)
//{	
	xmlHttpSubService4File=GetXmlHttpObject();
	if (xmlHttpSubService4File==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	}
	var url="Ajax/get_sub_service_4File.php";
	url=url+"?id="+str;
	//alert(url);
	url=url+"&sid="+Math.random();
	xmlHttpSubService4File.onreadystatechange=stateChangedSubService4File;
	xmlHttpSubService4File.open("GET",url,true);
	xmlHttpSubService4File.send(null);
	document.getElementById("showSubService4File").innerHTML = '<img src="../../DesignImage/loading.gif"/>';
//}
}
catch(exception){
alert(exception);
}
}

function stateChangedSubService4File() 
{ 
	if (xmlHttpSubService4File.readyState==4)
	{
		document.getElementById("showSubService4File").innerHTML = xmlHttpSubService4File.responseText;
	}
}

function getModule4File(str)
{
	//alert(str);
try{
//if(bflag)
//{	
	xmlHttpModule4File=GetXmlHttpObject();
	if (xmlHttpModule4File==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	}
	var url="Ajax/get_module_4File.php";
	url=url+"?id="+str;
	//alert(url);
	url=url+"&sid="+Math.random();
	xmlHttpModule4File.onreadystatechange=stateChangedModule4File;
	xmlHttpModule4File.open("GET",url,true);
	xmlHttpModule4File.send(null);
	document.getElementById("showModule4File").innerHTML = '<img src="../../DesignImage/loading.gif"/>';
//}
}
catch(exception){
alert(exception);
}
}

function stateChangedModule4File() 
{ 
	if (xmlHttpModule4File.readyState==4)
	{
		document.getElementById("showModule4File").innerHTML = xmlHttpModule4File.responseText;
	}
}

function getSubModule4File(str)
{
	//alert(str);
try{
//if(bflag)
//{	
	xmlHttpSubModule4File=GetXmlHttpObject();
	if (xmlHttpSubModule4File==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	}
	var url="Ajax/get_sub_module_4File.php";
	url=url+"?id="+str;
	//alert(url);
	url=url+"&sid="+Math.random();
	xmlHttpSubModule4File.onreadystatechange=stateChangedSubModule4File;
	xmlHttpSubModule4File.open("GET",url,true);
	xmlHttpSubModule4File.send(null);
	document.getElementById("showSubModule4File").innerHTML = '<img src="../../DesignImage/loading.gif"/>';
//}
}
catch(exception){
alert(exception);
}
}

function stateChangedSubModule4File() 
{ 
	if (xmlHttpSubModule4File.readyState==4)
	{
		document.getElementById("showSubModule4File").innerHTML = xmlHttpSubModule4File.responseText;
	}
}

//-->