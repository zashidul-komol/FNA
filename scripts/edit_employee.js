//////////////employee docs/////////////////
function show()
	{
		var name=document.getElementById("imgfile").value;
		//alert(name);
		if(name)
			document.getElementById("imgfield").src=name;
	}
////////////////////////////////////////////
var globalVar = 0;

function gotopreview_w_h(str,name,w,h)
{
	window.open (str,name,'status=0,resizable=1,scrollbars=0,width='+w+',height='+h);
}
function showEmpDocs()
{
	alert("i m at contact edit");
	
}

function removeChar(item)
{ 
	var val = item.value;
	//alert(val)
  	val = val.replace(/[^0-9]/g, "");  
  	if (val == ' '){val = ''};   
  	item.value=val;
}


var proId=0;
var globalEdu = 0;
var j = 0;
function createEduExp(table,id)
{
	var i;
	var tstr = "";
	var jj = 0;
	if(id=='proId')
	{
		proId++;
		i=proId;
		j=j+1;
		globalEdu = i+1;
		tstr +="<tr><td bgcolor='#F3F3F3'>"+j+"</td><td bgcolor='#F3F3F3'><label><input name='degree[]' type='text' class='BDJtextBox' size='25' /></label></td>";
        tstr +="<td bgcolor='#F3F3F3'><input name='board[]' type='text' class='BDJtextBox' size='30' /></td><td bgcolor='#F3F3F3'><label><input name='year[]' type='text' class='BDJtextBox' size='10' onkeyup='removeChar(this);' /><label></td>";
		tstr +="<td bgcolor='#F3F3F3'><input name='mark[]' type='text' class='BDJtextBox' size='8' /></td><td bgcolor='#F3F3F3'><input name='score[]' type='text' class='BDJtextBox' size='6' /></td></tr>";
		var tmp = document.getElementById(table).innerHTML;
		tmp = tmp.replace('</TABLE>','');
		//alert(tmp);
		document.getElementById(table).innerHTML = tmp+tstr+'</table>';
   }
   document.getElementById('eduVal').value = parseInt(globalEdu);
} 
function removeEduExp(table,id)
{
	var i =0;
	if(id=='proId')
	{			
		i=proId;
		if(i<=0)
			return;
		else
			proId--;
	}
			
	var str = document.getElementById(table).innerHTML;	
	str = str.substring(0,str.lastIndexOf('<TR>'));		
	document.getElementById(table).innerHTML=str+" </table>";	
}

function createEducation(table,param,id)
{
	var i;
	var tstr = "";
	if(id=='proId')
	{
		proId++;
		i=proId;
		tstr +="<tr><td align='right' width='28%' class='tablefont'>"+param+i+"</td><td align='left' class='tablefont' width='78%'><input name='imgfileedu[]' id='imgfileedu"+i+"' type='file' class='mujib12'/><input name='Submit4"+i+"' type='button' class='mujib12' value='up' onclick='showedu("+i+");' /></td></tr>";
		
	}
	var tmp = document.getElementById(table).innerHTML;
	tmp = tmp.replace('</TABLE>','');
	//alert(tmp);
	document.getElementById(table).innerHTML = tmp+tstr+'</table>';
}
function removeEducation(table,id)
{
	var i =0;
	if(id=='proId')
	{			
		i=proId;
		if(i<=0)
			return;
		else
			proId--;
	}
			
	var str = document.getElementById(table).innerHTML;	
	str = str.substring(0,str.lastIndexOf('<TR>'));		
	document.getElementById(table).innerHTML=str+" </table>";	
}

var globalJob = 0;
var jjjjj = 0;
function createJobExp(table,id)
{
	var func;
	var i;
	var tstr = "";
	var jj = 0;
	if(id=='proId')
	{
		proId++;
		i=proId;
		j=i+1;
		jjjjj++;
		globalJob = i+1;
		//tstr +="<tr><td align='right' width='28%' class='tablefont'>"+param+i+"</td><td align='left' class='tablefont' width='78%'><input name='imgfileedu[]' id='imgfileedu"+i+"' type='file' class='mujib12'/><input name='Submit4"+i+"' type='button' class='mujib12' value='up' onclick='showedu("+i+");' /></td></tr>";
		tstr +="<tr>";
		tstr +="<td width='3%' bgcolor='#F3F3F3'>"+jjjjj+"</td>";
		tstr +="<td width='11%' align='left' bgcolor='#F3F3F3'><label><input name='organization[]' type='text' class='BDJtextBox' size='15' /></label></td>"
        tstr +="<td width='8%' align='left' bgcolor='#F3F3F3'><input name='position[]' type='text' class='BDJtextBox' size='10' /></td>";
		tstr +="<td width='15%' align='left' bgcolor='#F3F3F3'><input name='date_start[]' id='date_start"+i+"' type='text' class='BDJtextBox' size='6' /><input type='button' class='BDJButton3' value='..' name='Button_start"+i+"'  style='cursor:hand'/></td>";
		tstr +="<td  width='13%' align='left' bgcolor='#F3F3F3'><input name='date_end[]' id='date_end"+i+"' type='text' class='BDJtextBox' size='6' /><input type='button' class='BDJButton3' value='..' name='Button"+i+"'  style='cursor:hand' /></td>";		
		
		tstr +="<td width='10%' align='left' bgcolor='#F3F3F3'><input name='reson[]' type='text' class='BDJtextBox' size='15' /></td><td width='13%'align='left' bgcolor='#F3F3F3'><input name='contact[]' type='text' class='BDJtextBox' size='13' /></td>";
		tstr +="</tr>";
		var tmp = document.getElementById(table).innerHTML;
		tmp = tmp.replace('</TABLE>','');
		//alert(tmp);
		document.getElementById(table).innerHTML = tmp+tstr+'</table>';
		
		for(func=1;func<=i;func++)
		{
			showday(func);
			start_day(func);
		}
		
   }
   document.getElementById('job_exp').value = parseInt(globalJob);
} 

function removeJobExp(table,id)
{
	var i =0;
	if(id=='proId')
	{			
		i=proId;
		if(i<=0)
			return;
		else
			proId--;
	}
			
	var str = document.getElementById(table).innerHTML;	
	str = str.substring(0,str.lastIndexOf('<TR>'));		
	document.getElementById(table).innerHTML=str+" </table>";	
}

function showday(num)
{
	     new Zapatec.Calendar.setup({
		inputField:"date_end"+num,
		ifFormat:"%d-%m-%Y",
		button:"Button"+num,
		showsTime:false
	});
}

function start_day(num)
{
	     new Zapatec.Calendar.setup({
		inputField:"date_start"+num,
		ifFormat:"%d-%m-%Y",
		button:"Button_start"+num,
		showsTime:false
	});
}
///////////////////////employee documents//////////////////////
function createEducation(table,param,id)
{
	var i;
	var tstr = "";
	if(id=='proId')
	{
		proId++;
		i=proId;
		tstr +="<tr><td align='right' width='28%' class='tablefont'>"+param+i+"</td><td align='left' class='tablefont' width='78%'><input name='imgfileedu[]' id='imgfileedu"+i+"' type='file' class='mujib12'/><input name='Submit4"+i+"' type='button' class='mujib12' value='up' onclick='showedu("+i+");' /></td></tr>";
		
	}
	var tmp = document.getElementById(table).innerHTML;
	tmp = tmp.replace('</TABLE>','');
	//alert(tmp);
	document.getElementById(table).innerHTML = tmp+tstr+'</table>';
}
function removeEducation(table,id)
{
	var i =0;
	if(id=='proId')
	{			
		i=proId;
		if(i<=0)
			return;
		else
			proId--;
	}
			
	var str = document.getElementById(table).innerHTML;	
	str = str.substring(0,str.lastIndexOf('<TR>'));		
	document.getElementById(table).innerHTML=str+" </table>";	
}


var jobId=0;
function createExperiance(table,param,id)
{
	var i;
	var tstr = "";
	if(id=='jobId')
	{
		jobId++;
		i=jobId;
		tstr +="<tr><td align='right' width='28%' class='tablefont'>"+param+"</td><td align='left' class='tablefont' width='78%'><input name='imgfileexp[]' id='imgfileexp"+i+"' type='file' class='mujib12'/><input name='Submit52"+i+"' type='button' class='mujib12' value='up' onclick='showexp("+i+");' /></td></tr>";
	}
	var tmp = document.getElementById(table).innerHTML;
	tmp = tmp.replace('</TABLE>','');
	document.getElementById(table).innerHTML = tmp+tstr+'</table>';
}
function removeExperiance(table,id)
{
	var i =0;
	if(id=='jobId')
	{			
		i=jobId;
		if(i<=0)
			return;
		else
			jobId--;
	}
			
	var str = document.getElementById(table).innerHTML;	
	str = str.substring(0,str.lastIndexOf('<TR>'));		
	document.getElementById(table).innerHTML=str+" </table>";
}


///////////////////////employee doc //////////////////////////////////////////////////////////////////////////////
function show2()
{
	var name=document.getElementById("imgfilecv").value;
	//alert(name);
	if(name)
		document.getElementById("imgfieldgen").src=name;
}
function show3()
{
	var name=document.getElementById("imgfilejob").value;
	//alert(name);
	if(name)
		document.getElementById("imgfieldgen").src=name;
}
function showedu(st)
{
	var name=document.getElementById('imgfileedu'+st).value;
	//alert(name);
	if(name)
		document.getElementById("imgfieldgen").src=name;
}
function showexp(st)
{
	//alert(st);
	var name=document.getElementById('imgfileexp'+st).value;
	//alert(name);
	if(name)
		document.getElementById("imgfieldgen").src=name;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////





///////////////////////////////////////////////////////////////

////////////////employee posting////////////
var xmlHttpdept;
function getLocation(item)
{
	//alert("error");
	var dep = document.getElementById('department').options[document.getElementById('department').selectedIndex].text;
	
	document.getElementById('dep_hidden').value = dep;
	xmlHttpdept=GetXmlHttpObject();
	if (xmlHttpdept==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	var url="./Ajax/getEmpLocation.php";
	url=url+"?dept="+item.value;
	//alert(url);
	url=url+"&sid="+Math.random();
	xmlHttpdept.onreadystatechange=stateChangedDept;
	xmlHttpdept.open("GET",url,true);
	xmlHttpdept.send(null);	
}
function stateChangedDept() 
{ 
	if (xmlHttpdept.readyState==4)
	{ 
	   document.getElementById("showSpan").innerHTML=xmlHttpdept.responseText;	
	 }
}


////////////////////////////////////////get supervisor/////////////////////////////
var  xmlHttpdesig;
var xmlHttpResp;
function setSupervisor(val)
{
	//alert("sdf");
	var empdesig = document.getElementById('designation').options[document.getElementById('designation').selectedIndex].text;
	document.getElementById('dsg_hidden').value = empdesig;	
	var desg = document.getElementById('designation').value;
	xmlHttpdesig=GetXmlHttpObject();
	if (xmlHttpdesig==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	var url="./Ajax/getSupervisor.php";
	url=url+"?desig="+desg;
	//alert(url);
	url=url+"&sid="+Math.random();
	xmlHttpdesig.onreadystatechange=stateChangedDesig;
	xmlHttpdesig.open("GET",url,true);
	xmlHttpdesig.send(null);
	xmlHttpResp=GetXmlHttpObject();
	if (xmlHttpResp==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	var url="./Ajax/getResponsibility.php";
	url=url+"?desig="+desg;
	//alert(url);
	url=url+"&sid="+Math.random();
	xmlHttpResp.onreadystatechange=stateChangedResp;
	xmlHttpResp.open("GET",url,true);
	xmlHttpResp.send(null);

}

function stateChangedDesig()
{
	if (xmlHttpdesig.readyState==4)
	{ 
		//alert(xmlHttpdesig.responseText);
	   document.getElementById("showSupervisor").innerHTML=xmlHttpdesig.responseText;	
	 }
}
function stateChangedResp()
{
	if (xmlHttpResp.readyState==4)
	{ 
		//alert(xmlHttpdesig.responseText);
	   document.getElementById("showResp").innerHTML=xmlHttpResp.responseText;	
	 }	
}
/////////////////////////////////////////////\
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

/////////////////////////employee lunch rule////////////////
function showLunchRule(str)
{
	if(str=="y")
	{
		document.getElementById('showAtt').style.display = '';
	}
	else
	{
		document.getElementById('showAtt').style.display = 'none';
	}
}
////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////
function showSpan(str)
{
	
	if(str=="basicSal")
	{
		document.getElementById('basic').style.display = '';
		document.getElementById('gross').style.display = 'none';
	}
	else if(str=="grossSal")
	{
		document.getElementById('gross').style.display = '';
		document.getElementById('basic').style.display = 'none';
	}
	else
	{
		document.getElementById('basic').style.display = 'none';
		document.getElementById('gross').style.display = 'none';
	}
}

function showSpan1(str)
{
	//alert(str);
	if(str=="package")
	{
		document.getElementById("EmpSalaryDocs").style.display = 'none';
		document.getElementById('package').style.display = '';
		document.getElementById('custom').style.display = 'none';
		document.getElementById('EmpSalaryDocs').style.display = 'none';
		document.getElementById('name').style.display = 'none';
	}
	else
	{
		document.getElementById("showPackageSalary").style.display = 'none';
		document.getElementById('custom').style.display = '';
		document.getElementById('package').style.display = 'none';
		document.getElementById('EmpSalaryDocs').style.display = '';
		
	}
}
////////////////////////////////////////////////////////////

////////////////emp salary pkg///////////////////////////////
var xmlHttpPack;
var globalVar = 0;
function getPackage(val)
{
	
	document.getElementById("name").style.display = 'none';
	xmlHttpPack=GetXmlHttpObject();
	if (xmlHttpPack==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	var url="./ajax/setPackage.php";
	url=url+"?packid="+val;
	//alert(url);
	url=url+"&sid="+Math.random();
	xmlHttpPack.onreadystatechange=stateChangedPack;
	xmlHttpPack.open("GET",url,true);
	xmlHttpPack.send(null);	
}
function stateChangedPack()
{
	if (xmlHttpPack.readyState==4)
	{ 
	   	document.getElementById("showPackageSalary").style.display = '';
	   	document.getElementById("showPackageSalary").innerHTML=xmlHttpPack.responseText;	
		globalVar = parseInt(document.getElementById('incValue').value);
		document.getElementById("name").style.display = '';
	}
}


function createSalary(table,param,param1,id)
{
	document.getElementById('name').style.display = '';
	var i;
	var tstr = "";
	if(id=='proId')
	{
		proId++;
		i=proId;
		m =i+1;
		globalVar = i+1;
		tstr += "<tbody id ='tbody_salary" + i + "' >";
		
		tstr +="<tr><td width='13%' align='right'>"+param+m+" </td><td width='20%' align='left'><input name='rule1[]' type='text' onblur='document.getElementById(" + '"' + "salary_rule" + i + '"' + ").value = this.value' id='rule"+i+"' class='BDJtextBox' size='20' /><input name='salary_rule[]' type='hidden' id='salary_rule"+i+"'/></td><td width='5%' align='left'>"+param1+"</td><td width='10%' align='left'><input name='ratio1[]' type='text' onblur='document.getElementById(" + '"' + "salary_ratio" + i + '"' + ").value = this.value' id='ratio"+i+"' class='BDJtextBox' onKeyup='removeChar(this);' size='10'/><input name='salary_ratio[]' type='hidden' id='salary_ratio"+i+"'/></td>"
		tstr +="<td width='8%' align='left'><select name='rule_oper1[]' onchange='document.getElementById(" + '"' + "salary_oper" + i + '"' + ").value = this.value' id='rule_oper"+i+"'><option value='%'>%</option><option value='+'>+</option></select><input name='salary_oper[]' type='hidden' id='salary_oper"+i+"'/></td>"
		tstr +="<td width='3%' align='left' valign='middle'>=</td><td width='9%'><input name='result1[]' id='result"+i+"' type='text' onblur='document.getElementById(" + '"' + "salary_result" + i + '"' + ").value = this.value' class='BDJtextBox' size='15' readonly='true' /><input name='salary_result[]' type='hidden' id='salary_result"+i+"'/></td><td width='45' align='left' valign='middle'></td></tr>";
		
			tstr += "</tbody>";

		var tmp = document.getElementById(table).innerHTML;
		tmp = tmp.replace('</TABLE>','');
		document.getElementById(table).innerHTML = tmp+tstr+'</table>';
		
		for (k= 1; k<i; k++)
		{
			document.getElementById("rule"+k).value = document.getElementById("salary_rule"+k).value;
			document.getElementById("ratio"+k).value = document.getElementById("salary_ratio"+k).value;
			document.getElementById("result"+k).value = document.getElementById("salary_result"+k).value;
			if(document.getElementById("salary_oper"+k).value != "")
			document.getElementById("rule_oper"+k).value = document.getElementById("salary_oper"+k).value;
		}
	}
	document.getElementById('globalVal').value = globalVar;
}
function removeSalary(table,id)
{
	var i =0;
	if(id=='proId')
	{			
		i=proId;
		if(i<=0)
			return;
		else
			proId--;
	}	
	
	var tbody= document.getElementById("tbody_salary" + i);
	tbody.parentNode.removeChild(tbody);
	/*var str = document.getElementById(table).innerHTML;	
	str = str.substring(0,str.lastIndexOf('<TR>'));		
	document.getElementById(table).innerHTML=str+" </table>";*/
}

var totalPercentValue = 0;
var totalPlusValue = 0;
function generateTotal()
{
	var salType = "";
	
	salType = parseInt(document.getElementById('basicAmount').value);
	basicToGross(salType);
	
}
/////////////////////////salary increment calculation////////////////////////////
function generateSalaryIncrementTotal()
{
	var salType = "";
	var i = 0;
	//alert("test");
	//if(document.getElementById('sal_incr_name').value == true) //radiobutton custom
	//{
	//	alert('abcdef');
		
		salType = parseInt(document.getElementById('basicAmount').value);
		//alert(salType);
		basicForOtGross(salType);
		
	//}	
	
}
function basicForOtGross(salType)
{
	//alert('kamrul');
	var resultCal = 0;
	globalVar = parseInt(document.getElementById('incValue').value);
	//alert(globalVar);
	for(i=0;i<globalVar;i++)
	{
		//alert(i);
		if(document.getElementById('rule_oper1'+i).value.toString()=="%")
		{
			//alert(document.getElementById('rule_oper1'+i).value.toString());
			resultCal = (salType/100)*parseInt(document.getElementById('ratio1'+i).value);
			document.getElementById('result1'+i).value = resultCal.toFixed(2);
		}
		else
		{	
		
			//alert('test');
			//alert(document.getElementById('rule_oper1'+i).value.toString());
			if(document.getElementById('rule_oper1'+i).value.toString()=="/")
				{
					//alert("division_test");
					result_div = document.getElementById('ratio1'+i).value;
					resultCal = resultCal/document.getElementById('ratio1'+i).value;
					document.getElementById('result1'+i).value = resultCal.toFixed(2);
				}
			else{
					if(document.getElementById('rule_oper1'+i).value.toString()=="*")
					{
					//alert("division_test");
					result_div = document.getElementById('ratio1'+i).value;
					//alert(result_div);
					resultCal = resultCal*result_div;
					//alert(final_div_result);
					document.getElementById('result1'+i).value = resultCal.toFixed(2);
					}
					else
					{
						if(document.getElementById('rule_oper1'+i).value.toString()=="+")
						{
						//alert("division_test");
						result_div = document.getElementById('ratio1'+i).value;
						//alert(result_div);
						//alert(resultCal);
						//alert(resultCal+result_div);
						resultCal = parseFloat(resultCal)+parseFloat(result_div);
						//alert(resultCal);
						document.getElementById('result1'+i).value = resultCal.toFixed(2);
						}
						else
						{
							if(document.getElementById('rule_oper1'+i).value.toString()=="-")
							{
							//alert("division_test");
							result_div = document.getElementById('ratio1'+i).value;
							//alert(result_div);
							resultCal = parseFloat(resultCal) - parseFloat(result_div);;
							//alert(final_div_result);
							document.getElementById('result1'+i).value = resultCal.toFixed(2);
							}	
							
						}
						
						
					}
					
				
				}
		
			//document.getElementById('result1'+i).value = parseInt(document.getElementById('ratio1'+i).value).toFixed(2);
		}
		
		
	}
	//var totalAmount = 0;
	k = globalVar-1;
	document.getElementById('total_taka').value = parseFloat(document.getElementById('result1'+k).value);
	//alert(totalAmount.toFixed(2));
	
}	

/////////////////////////////////overtime calculation//////////////////////////

function generateOvertimeTotal()
{
	var salType = "";
	var i = 0;
	
	if(document.getElementById('allow0').value == 'Y') //radiobutton custom
	{
		//alert('abcdef');
		
		salType = parseInt(document.getElementById('basicAmount').value);
		///alert(salType);
		basicForOtGross(salType);
		
	}	
	
}
function basicForOtGross(salType)
{
	//alert('kamrul');
	var resultCal = 0;
	globalVar = parseInt(document.getElementById('incValue').value);
	//alert(globalVar);
	for(i=0;i<globalVar;i++)
	{
		//alert(i);
		if(document.getElementById('rule_oper1'+i).value.toString()=="%")
		{
			//alert(document.getElementById('rule_oper1'+i).value.toString());
			resultCal = (salType/100)*parseInt(document.getElementById('ratio1'+i).value);
			document.getElementById('result1'+i).value = resultCal.toFixed(2);
		}
		else
		{	
		
			//alert('test');
			//alert(document.getElementById('rule_oper1'+i).value.toString());
			if(document.getElementById('rule_oper1'+i).value.toString()=="/")
				{
					//alert("division_test");
					result_div = document.getElementById('ratio1'+i).value;
					resultCal = resultCal/document.getElementById('ratio1'+i).value;
					document.getElementById('result1'+i).value = resultCal.toFixed(2);
				}
			else{
					if(document.getElementById('rule_oper1'+i).value.toString()=="*")
					{
					//alert("division_test");
					result_div = document.getElementById('ratio1'+i).value;
					//alert(result_div);
					resultCal = resultCal*result_div;
					//alert(final_div_result);
					document.getElementById('result1'+i).value = resultCal.toFixed(2);
					}
					else
					{
						if(document.getElementById('rule_oper1'+i).value.toString()=="+")
						{
						//alert("division_test");
						result_div = document.getElementById('ratio1'+i).value;
						//alert(result_div);
						//alert(resultCal);
						//alert(resultCal+result_div);
						resultCal = parseFloat(resultCal)+parseFloat(result_div);
						//alert(resultCal);
						document.getElementById('result1'+i).value = resultCal.toFixed(2);
						}
						else
						{
							if(document.getElementById('rule_oper1'+i).value.toString()=="-")
							{
							//alert("division_test");
							result_div = document.getElementById('ratio1'+i).value;
							//alert(result_div);
							resultCal = parseFloat(resultCal) - parseFloat(result_div);;
							//alert(final_div_result);
							document.getElementById('result1'+i).value = resultCal.toFixed(2);
							}	
							
						}
						
						
					}
					
				
				}
		
			//document.getElementById('result1'+i).value = parseInt(document.getElementById('ratio1'+i).value).toFixed(2);
		}
		
		
	}
	//var totalAmount = 0;
	k = globalVar-1;
	document.getElementById('total_taka').value = parseFloat(document.getElementById('result1'+k).value);
	//alert(totalAmount.toFixed(2));
	
}	

///////////////////////tax calculation///////////////////////////////

function generateTaxTotal()
{
	
		//alert('abcdef');
		
		salType = parseInt(document.getElementById('basicAmount').value);
		///alert(salType);
		basicForOtGross(salType);
		

	
}
function basicForOtGross(salType)
{
	//alert('kamrul');
	var resultCal = 0;
	globalVar = parseInt(document.getElementById('incValue').value);
	//alert(globalVar);
	for(i=0;i<globalVar;i++)
	{
		//alert(i);
		if(document.getElementById('rule_oper1'+i).value.toString()=="%")
		{
			//alert(document.getElementById('rule_oper1'+i).value.toString());
			resultCal = (salType/100)*parseInt(document.getElementById('ratio1'+i).value);
			document.getElementById('result1'+i).value = resultCal.toFixed(2);
		}
		else
		{	
		
			//alert('test');
			//alert(document.getElementById('rule_oper1'+i).value.toString());
			if(document.getElementById('rule_oper1'+i).value.toString()=="/")
				{
					//alert("division_test");
					result_div = document.getElementById('ratio1'+i).value;
					resultCal = resultCal/document.getElementById('ratio1'+i).value;
					document.getElementById('result1'+i).value = resultCal.toFixed(2);
				}
			else{
					if(document.getElementById('rule_oper1'+i).value.toString()=="*")
					{
					//alert("division_test");
					result_div = document.getElementById('ratio1'+i).value;
					//alert(result_div);
					resultCal = resultCal*result_div;
					//alert(final_div_result);
					document.getElementById('result1'+i).value = resultCal.toFixed(2);
					}
					else
					{
						if(document.getElementById('rule_oper1'+i).value.toString()=="+")
						{
						//alert("division_test");
						result_div = document.getElementById('ratio1'+i).value;
						//alert(result_div);
						//alert(resultCal);
						//alert(resultCal+result_div);
						resultCal = parseFloat(resultCal)+parseFloat(result_div);
						//alert(resultCal);
						document.getElementById('result1'+i).value = resultCal.toFixed(2);
						}
						else
						{
							if(document.getElementById('rule_oper1'+i).value.toString()=="-")
							{
							//alert("division_test");
							result_div = document.getElementById('ratio1'+i).value;
							//alert(result_div);
							resultCal = parseFloat(resultCal) - parseFloat(result_div);;
							//alert(final_div_result);
							document.getElementById('result1'+i).value = resultCal.toFixed(2);
							}	
							
						}
						
						
					}
					
				
				}
		
			//document.getElementById('result1'+i).value = parseInt(document.getElementById('ratio1'+i).value).toFixed(2);
		}
		
		
	}
	//var totalAmount = 0;
	k = globalVar-1;
	document.getElementById('total_taka').value = parseFloat(document.getElementById('result1'+k).value);
	//alert(totalAmount.toFixed(2));
	
}	
////////////////////////////////basic calculation////////////
function basicToGross(salType)
{
	
	var resultCal = 0;
	//alert(globalVar);
	for(i=0;i<globalVar;i++)
	{
		if(document.getElementById('rule_oper'+i).value.toString()=="%")
		{
			resultCal = (salType/100)*parseInt(document.getElementById('ratio'+i).value);
			document.getElementById('result'+i).value = resultCal.toFixed(2);
		}
		else
		{
			document.getElementById('result'+i).value = parseInt(document.getElementById('ratio'+i).value).toFixed(2);
		}
	}
	var totalAmount = 0;
	for(i=0;i<globalVar;i++)
	{
		totalAmount += parseFloat(document.getElementById('result'+i).value);
		//alert(document.getElementById('result'+i).value);
	}
	var all_total = totalAmount + salType;
	document.getElementById('total').value = all_total.toFixed(2);
}	



/////////////////////////////gross calculation///////////////
	
function grossToBasic(salType)
{
	totalPercentValue = 0;
	totalPlusValue = 0;
	for(i=0;i<globalVar;i++)
	{
		if(document.getElementById('rule_oper'+i).value.toString()=="%")
		{
			totalPercentValue += parseInt(document.getElementById('ratio'+i).value);
			
		}
		else
		{
			totalPlusValue += parseInt(document.getElementById('ratio'+i).value);
			document.getElementById('result'+i).value = document.getElementById('ratio'+i).value;
		}
	}
	var netSalary = salType-totalPlusValue;
	var resultCal = 0;
	for(i=0;i<globalVar;i++)
	{
		if(document.getElementById('rule_oper'+i).value.toString()=="%")
		{
			resultCal = (netSalary/totalPercentValue)*parseInt(document.getElementById('ratio'+i).value);
			document.getElementById('result'+i).value = resultCal.toFixed(2);
		}
	}
	var totalAmount = 0;
	for(i=0;i<globalVar;i++)
	{
		totalAmount += parseFloat(document.getElementById('result'+i).value);
	}
	document.getElementById('total').value = totalAmount.toFixed(2);
	
}
/////////////////////////////////////////package////////////////////////////////////////////
function basicToGross1(salType)
{
	
	var resultCal = 0;
	for(i=0;i<globalVar;i++)
	{
		if(document.getElementById('rule_oper1'+i).value.toString()=="%")
		{
			resultCal = (salType/100)*parseInt(document.getElementById('ratio1'+i).value);
			document.getElementById('result1'+i).value = resultCal.toFixed(2);
		}
		else
		{
			document.getElementById('result1'+i).value = parseInt(document.getElementById('ratio1'+i).value).toFixed(2);
		}
	}
	var totalAmount = 0;
	for(i=0;i<globalVar;i++)
	{
		totalAmount += parseFloat(document.getElementById('result1'+i).value);
		//alert(document.getElementById('result1'+i).value);
	}
	document.getElementById('total').value = totalAmount.toFixed(2);
}	
/////////////////////////////gross calculation///////////////
	
function grossToBasic1(salType)
{
	totalPercentValue = 0;
	totalPlusValue = 0;
	for(i=0;i<globalVar;i++)
	{
		if(document.getElementById('rule_oper1'+i).value.toString()=="%")
		{
			totalPercentValue += parseInt(document.getElementById('ratio1'+i).value);
			
		}
		else
		{
			totalPlusValue += parseInt(document.getElementById('ratio1'+i).value);
			document.getElementById('result1'+i).value = document.getElementById('ratio1'+i).value;
		}
	}
	var netSalary = salType-totalPlusValue;
	var resultCal = 0;
	for(i=0;i<globalVar;i++)
	{
		if(document.getElementById('rule_oper1'+i).value.toString()=="%")
		{
			resultCal = (netSalary/totalPercentValue)*parseInt(document.getElementById('ratio1'+i).value);
			document.getElementById('result1'+i).value = resultCal.toFixed(2);
		}
	}
	var totalAmount = 0;
	for(i=0;i<globalVar;i++)
	{
		totalAmount += parseFloat(document.getElementById('result1'+i).value);
	}
	document.getElementById('total').value = totalAmount.toFixed(2);
	
}
/////////////////////////////////////////////////////////////

/////////////////////////Overtime calculation//////////////////////////////////
function showOvertime(str)
{
	if(str=="Y")
	{
		document.getElementById('showAllow').style.display = '';
		document.getElementById("showEmpOvertime").style.display = '';	
	}
	else
	{
		document.getElementById('showAllow').style.display = 'none';
		document.getElementById("showEmpOvertime").style.display = 'none';
		
	}
}

//////////////////////////////////get Overtime ////////////////////////////////////

var xmlHttpOvertime;
var salType = "";
var salAmount = 0;
function getOvertime(str)
{
	var emp = document.getElementById('emp_id').value;
	var salAmount = document.getElementById('total').value;
	
	xmlHttpOvertime = GetXmlHttpObject();
	if (xmlHttpOvertime==null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	var url="./Ajax/setOvertime.php";
	url=url+"?ot_id="+str+"&sal_amount="+salAmount;
	url=url+"&sid="+Math.random();
	xmlHttpOvertime.onreadystatechange=stateChangedOvertime;
	xmlHttpOvertime.open("GET",url,true);
	xmlHttpOvertime.send(null);	
}
function stateChangedOvertime()
{
	if (xmlHttpOvertime.readyState==4)
	{ 
	   document.getElementById("showEmpOvertime").innerHTML=xmlHttpOvertime.responseText;
	}
}

///////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////GET SALARY  ////////////////////////////////////////////////////////////////
var xmlHttp_incr_sal;
var salType = "";
var salAmount = 0;
function getSal_incr(str)
{
	//alert(str);
	var emp = document.getElementById('emp_id').value;
	var salType = document.getElementById('sal_type').value;
	var salAmount = document.getElementById('sal_ammount').value;
	
	var chk = document.getElementById('sal_incr_name').value;
	
	
	xmlHttp_incr_sal = GetXmlHttpObject();
	if (xmlHttp_incr_sal == null)
	{
	  alert ("Your browser does not support AJAX!");
	  return;
	} 
	var url="./Ajax/set_sal_incr.php";
	url=url+"?sal_id="+str+"&empid="+emp+"&sal_name="+salType+"&sal_amount="+salAmount;
	//alert(url);
	url=url+"&sid="+Math.random();
	xmlHttp_incr_sal.onreadystatechange=stateChanged_sal_incr;
	xmlHttp_incr_sal.open("GET",url,true);
	xmlHttp_incr_sal.send(null);	
}
function stateChanged_sal_incr()
{
	if (xmlHttp_incr_sal.readyState==4)
	{ 
		document.getElementById("show_sal_incr_details").innerHTML=xmlHttp_incr_sal.responseText;
	}
}
////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////get TAX ////////////////////////////////////////////////////////////////
var xmlHttpTax;
var salType = "";
var salAmount = 0;
function getTax(str)
{
	var emp = document.getElementById('emp_id').value;
	var salType = document.getElementById('sal_type').value;
	var salAmount = document.getElementById('sal_ammount').value;
	var chk = document.getElementById('tax_name').value;
	
	if(chk=="select")
	{
	
	}
	else
	{
		xmlHttpTax = GetXmlHttpObject();
		if (xmlHttpTax==null)
		{
			alert ("Your browser does not support AJAX!");
			return;
		} 
		var url="./Ajax/set_tax.php";
		url=url+"?tax_id="+str+"&empid="+emp+"&tax_name="+salType+"&tax_amount="+salAmount;
		url=url+"&sid="+Math.random();
		xmlHttpTax.onreadystatechange=stateChangedTax;
		xmlHttpTax.open("GET",url,true);
		xmlHttpTax.send(null);		
	}
}
function stateChangedTax()
{
	if (xmlHttpTax.readyState==4)
	{ 
		document.getElementById("show_tax_details").innerHTML=xmlHttpTax.responseText;	
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

