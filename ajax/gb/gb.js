///////////////////////////////////////
//////////// ГОСТЕВАЯ	///////////////
///////////////////////////////////////

var GB={};
GB.ajaxpath='/ajax/gb/gb.php'

GB.drawDiv=function()
{
//	alert(123)
	var str=''
	+'<div>'
	+'	<div id="gb-loading-div" style="display: none">щя..</div>	'
	+'	<div id="gb-info-div" ></div>'
	+'	<div id="gb-div" ></div>'
	+'	<div id="gb-input-div" ></div>'
	+'</div>'
	
	document.write(str)
}





GB.drawInput=function()
{
	var str=''
	str+=''
	+'<textarea id="gb-input"></textarea>'
	+'<br><input type="button" id="gb-send-btn" value="молвить" onclick="GB.addMessage()">'

	$('#gb-input-div').html(str)
}







//	получаем дела на выбранную дату и вызываем их отрисовку
GB.addMessage=function()
{
	//alert($('#gb-input').val())
	//return
	if($('#gb-input').val() == '')
	{
		GB.showError('Ты, а написать чёньть??')
		return
	}
	
	GB.loading(1)
//	GB.turnInputs(0)
	$('#gb-info-div').html('');
	$.ajax({
		url: GB.ajaxpath+'?action=addMessage&msg='+$('#gb-input').val(),
		success: function (data, textStatus) 
		{
			alert(data)
			return;
			eval('data='+data)
			if(data.result=='ok')
			{
				GB.showNotice(data.result)
			}
			else
			{
				GB.showError(data.result)
			}
			GB.loading(0)
			GB.turnInputs(1)
		},
		error: function (data, textStatus) 
		{
			GB.showError('Мя, так ы так, братан. Чё то мя сервак канифолит.. щя давай попожжя, э...')
			GB.loading(0)
			GB.turnInputs(1)
		}
	});	
}






GB.turnInputs=function(on_off)
{
	if(on_off==0)
	{
		$('#gb-input').attr('disabled', 'true');
		$('#gb-send-btn').attr('disabled', 'true');
	}
	else
	{
		$('#gb-input').removeAttr('disabled');
		$('#gb-send-btn').removeAttr('disabled');
	}
}






GB.loading=function(a)
{
	if(a>0)
		$('#gb-loading-div').fadeIn('medium')
	else
		$('#gb-loading-div').fadeOut('fast')
		
}





GB.showError=function(msg)
{
	GB.showMessage(msg, 1)
}




GB.showNotice=function(msg)
{
	GB.showMessage(msg, 0)
}




GB.showMessage=function(msg, error)
{
	var color=''
	if(error>0)
		color='#ba5236'
	else color='green'
	$('#gb-info-div').html('<span style="font-size: 12px; color: '+color+'">'+msg+'</span>')
}