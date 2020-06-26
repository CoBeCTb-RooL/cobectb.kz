///////////////////////////////////////
//////////// ЕЖЕДНЕВНИК	///////////////
///////////////////////////////////////

var Schedule={};
Schedule.ajaxpath='/ajax/schedule/schedule.php'

Schedule.drawDiv=function()
{
//	alert(123)
	var str=''
	+'<div>'
	+'	<div id="schedule-loading-div" style="display: ">щя..</div>	'
	+'	<div id="schedule-div" ></div>'
	+'	<div id="schedule-info-div" ></div>'
	+'</div>'
	
	document.write(str)
}





//	рисуем сетку часов 
Schedule.init=function()
{
	Schedule.loading(1)
	var str=''
	+'<input type="button" id="schedule-show-btn" value="show" onclick="Schedule.show()">'
	+'<table border="1" width="300">'
	for(var i=8; i<=23; i++)
	{
		str+=Schedule.drawRow(i, 0)
		str+=Schedule.drawRow(i, 1)
	}
	str+=''
	+'</table>'
	
	$('#schedule-div').html(str)

	Schedule.show()
}




Schedule.drawRow=function(hour, half)
{
	var str=''
	str+=''
		+'	<tr>'
		+'		<td id="time-'+hour+'-'+(half==0?'00':'30')+'" style="'+(half==0?'font-weight: bold':'')+'" width="1">'
		+			hour+':'+(half == 0?'00':'30')
		+'		</td>'
		+'		<td id="message-'+hour+'-'+(half==0?'00':'30')+'">'
		+'		&nbsp;'
		+'		</td>'
		+'	</tr>'
	
	return str
}







//	получаем дела на выбранную дату и вызываем их отрисовку
Schedule.show=function()
{
	Schedule.loading(1)
	$('#schedule-info-div').html('');
	$.ajax({
		url: Schedule.ajaxpath+'?action=showSchedule',
		success: function (data, textStatus) 
		{
			//alert(data)
			//return;
			eval('data='+data)
			if(data.result=='ok')
			{
				for(var i in data.schedule)
				{
					$('#message-'+data.schedule[i].time).html(data.schedule[i].message)
				}
			}
			else
			{
				$('#activation-info-div').html('<span style="font-size: 11px;color: #ba5236">'+data.result+'</span>')
			}
			Schedule.loading(0)
		},
		error: function (data, textStatus) 
		{
			$('#schedule-info-div').html('<span style="font-size: 11px; color: #ba5236">Возникла ошибка на сервере. Попробуйте позднее..</span>')
			Schedule.loading(0)
		}
	});	
}






Schedule.turnInputs=function(on_off)
{
	if(on_off==0)
	{
		$('#code').attr('disabled', 'true');
		$('#schedule-btn').attr('disabled', 'true');
	}
	else
	{
		$('#code').removeAttr('disabled');
		$('#schedule-btn').removeAttr('disabled');
	}
}






Schedule.loading=function(a)
{
	if(a>0)
		$('#schedule-loading-div').fadeIn('medium')
	else
		$('#schedule-loading-div').fadeOut('fast')
		
}