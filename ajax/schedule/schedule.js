///////////////////////////////////////
///////// УЧАСТИЕ В АКЦИЯХ	///////////
///////////////////////////////////////

var Schedule={};

Schedule.ajaxpath='/ajax/schedule/schedule.php'
Schedule.rootpath='/ajax/schedule'




Schedule.drawDiv=function()
{
//	alert(123)
	var str=''
	+'<div style="  padding: 0px; " >'


	+'	<div id="schedule-div"></div>'
	+'	<div style="height: 30px; "><div id="schedule-loading-div" style="display: none">секунду...</div></div>	'
//	+'		<div style="height: 30px; padding-top: 10px;"><div id="schedule-info-div" ></div></div>'
	+'</div>'
	+'<input type="button" value="get" onclick="Schedule.getSchedule()">'
	
//	+'<input type="button" value="turnInputs(0)" onclick="Schedule.turnInputs(0)">'
//	+'<input type="button" value="turnInputs(1)" onclick="Schedule.turnInputs(1)">'
	
	
	
	document.write(str)
}















Schedule.firstTime=true


Schedule.getSchedule=function(date)
{
	Schedule.loading(1)
	//Schedule.turnInputs(0)
	$('#schedule-info-div').html('');
	$.ajax({
		url: Schedule.ajaxpath+'?action=getSchedule&date='+(typeof date != 'undefined'?date:''),
		success: function (data, textStatus) 
		{
			//alert(data)
			//return;
			
			eval('data='+data)
			if(data.result=='ok')
			{
				if(Schedule.firstTime)
				{
					Schedule.drawGrid()
					Schedule.setDateInfo(data)
					Schedule.firstTime=false
				}
				else
					Schedule.drawSchedule(data)
			}
			else
			{
				Schedule.showError(data.error)
			}
			Schedule.loading(0)
			//Schedule.turnInputs(1)
		},
		error: function (data, textStatus) 
		{
			Schedule.showError('Ошибка на сервере...')
			Schedule.loading(0)
			//Schedule.turnInputs(1)
		}
	});	
}






Schedule.drawGrid=function()
{
	$('#schedule-div').html('')
	
	str=''
	+'<table width="700"  border="0" style="margin: 25px; background: #fff; border: 1px solid #000"> '
	+'	<tr>'
	+'		<td width="100%" valign="top" style="padding: 15px 15px 15px 30px">'
	+'			<table width="100%" border="0">'
	+'				<tr>'
	+'					<td style="font-size: 70; color: 626365; font-weight: bold"><span id="schedule-dateinfo-day"></span></td>'
	+'					<td style="text-align: right; font-size: 30; color: 626365; font-weight: bold; vertical-align: bottom"><span id="schedule-dateinfo-month"></span></td>'
	+'				</tr>'
	+'				<tr>'
	+'					<td colspan="2"> <hr style="background-color: #E6C9CE; border: 1px solid #E6C9CE; height: 5"> </td>'
	+'				</tr>'
	+'				<tr>'
	+'					<td style="font-size: 20; color: 626365; font-weight: bold"><span id="schedule-dateinfo-weekday"></span></td>'
	+'					<td style="text-align: right; color: #626365"><span id="schedule-dateinfo-days-passed"></span> - <span id="schedule-dateinfo-days-left"></span></td>'
	+'				</tr>'
	+'				<tr>'
	+'					<td colspan="2"> <hr style="background-color: #C993A1; border: 1px solid #C993A1"> </td>'
	+'				</tr>'
	+'			</table>'
	+'		</td>'
	+'		<td style="padding: 0 30px 0 0 "><div id="datepicker"></div></td>'
	+'	</tr>'
	+'	<tr>'
	+'		<td colspan="2" style="padding: 15px 30px">'
	
	+'			<table width="100%" border="1" class="schedule-grid">'
	for(i=8; i<=23; i++)
	{	
		str+=''
		+'			<tr style="height: 30px; background-color: #F8F8F8" >'
		+'				<td rowspan="2" style="width: 30px; text-align: center; font-weight: bold; border-right: 0px solid black; background-color: #ececee;">'+i+'</td>'
		+'				<td colspan="2" style="padding: 2px 10px"> something - '+i+'</td>'
		+'				<td width="100">&nbsp;</td>'
		+'			</tr>'
		+'			<tr style="height: 30px">'
		+'				<td width="30" style="border-left: 0px solid black; background-color: #ececee; ">:30</td>'
		+'				<td style="padding: 2px 10px">something - HALF - '+i+'</td>'
		+'				<td >&nbsp;</td>'
		+'			</tr>'
	}
	
	str+=''
	+'			</table>'
	+'		</td>'
	+'	</tr>'
	+'	<tr>'
	+'		<td colspan="2" style="padding-right: 50px">'
	+'		<table width="100%">'
	+'			<tr>'
	+'				<td style="background: url('+Schedule.rootpath+'/images/schedule_bg.gif); "><img src="'+Schedule.rootpath+'/images/schedule_corner.gif"></td>'
	+'			</tr>'
	+'		</table>'
	+'		</td>'
	+'	</tr>'
	+'</table>'
	+''
	
	
	$('#schedule-div').html(str)
	$('#datepicker').datepick({onSelect: ddd});
	
	
	
}



Schedule.setDateInfo=function(data)
{
	$("#schedule-dateinfo-day").html(data.date['d'])
	$("#schedule-dateinfo-month").html(data.date['month_name'])
	$("#schedule-dateinfo-weekday").html(data.date['weekday_name'])
	$("#schedule-dateinfo-days-passed").html(data.date['days_passed'])
	$("#schedule-dateinfo-days-left").html(data.date['days_left'])
}


function ddd(a)
{
	//alert(a)
	var c= new Date(Date.parse(a));
	
	//alert(c.getDate())
	var d=c.getDate()
	var m=(c.getMonth()+1)
	var y=c.getFullYear()
	Schedule.getSchedule(y+'-'+m+'-'+d)
}






Schedule.drawSchedule=function(data)
{
	Schedule.setDateInfo(data)
}






Schedule.resign=function(id)
{
	$('#action-info-'+id).html('')
	Schedule.loadingLocal(1, id)
	
	//Schedule.turnInputs(0)
	$('#schedule-info-div').html('');
	$.ajax({
		url: Schedule.ajaxpath+'?action=resign&action_id='+id,
		success: function (data, textStatus) 
		{
			//alert(data)
			//return;
			
			eval('data='+data)
			if(data.result=='ok')
			{
				if(data.action=='removed')
				{
					$('#action-pic-'+id).attr("src", Schedule.rootpath+'/images/no.png')
					$('#action-btn-'+id).html('хочу!')
					Schedule.showNoticeLocal(id, 'вы не участвуете в акции! ')
				}
				else
				{
					$('#action-pic-'+id).attr("src", Schedule.rootpath+'/images/yes.png')
					$('#action-btn-'+id).html('не хочу!')
					Schedule.showNoticeLocal(id, 'вы участвуете в акции! ')
				}
				
			}
			else
			{
				Schedule.showErrorLocal(id, data.error)
			}
			Schedule.loadingLocal(0, id)
			//Schedule.turnInputs(1)
		},
		error: function (data, textStatus) 
		{
			Schedule.showErrorLocal(id, 'Ошибка на сервере...')
			Schedule.loadingLocal(0, id)
			//Schedule.turnInputs(1)
		}
	});	
}










Schedule.turnInputs=function(on_off)
{
	return;
	if(on_off==0)
	{
		$('.schedule-buy-btn').attr('disabled', 'true');
	}
	else
	{
		$('.schedule-buy-btn').removeAttr('disabled');
	}
}






Schedule.loading=function(a)
{
	if(a>0)
		$('#schedule-loading-div').css('display', 'block')
	else
		$('#schedule-loading-div').css('display', 'none')
		//$('#schedule-loading-div').fadeOut('fast')
		
}




Schedule.loadingLocal=function(a, id)
{
	if(a>0)
		$('#action-loading-'+id).fadeIn('fast')
		//$('#action-loading-'+id).css('display', 'block')
	else
		$('#action-loading-'+id).fadeOut('fast')
		//$('#action-loading-'+id).css('display', 'none')
		
		
}





Schedule.showError=function(msg)
{
	Schedule.showMessage(msg, 1)
}




Schedule.showNotice=function(msg)
{
	Schedule.showMessage(msg, 0)
}




Schedule.showMessage=function(msg, error)
{
	var color=''
	if(error>0)
		color='#ba5236'
	else color='green'

	$('#schedule-info-div').html('<span style="font-size: 12px; color: '+color+'">'+msg+'</span>')
	$('#schedule-info-div').stop(true).css('display', 'block').css('opacity', '1')	
	$('#schedule-info-div').fadeOut(9000)

}










Schedule.showErrorLocal=function(id, msg)
{
	Schedule.showMessageLocal(id, msg, 1)
}




Schedule.showNoticeLocal=function(id, msg)
{
	Schedule.showMessageLocal(id, msg, 0)
}




Schedule.showMessageLocal=function(id, msg, error)
{
	var color=''
	if(error>0)
		color='#ba5236'
	else color='green'

	$('#action-info-'+id).html('<span style="font-size: 10px; font-weight: bold; color: '+color+'">'+msg+'</span>')
	$('#action-info-'+id).stop(true).css('display', 'inline').css('opacity', '1')	
	$('#action-info-'+id).fadeOut(9000)

}