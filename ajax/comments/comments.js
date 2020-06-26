///////////////////////////////////////
//////////// ГОСТЕВАЯ	///////////////
///////////////////////////////////////

var Comments={};
Comments.ajaxpath='/ajax/comments/comments.php'

Comments.colors=[
				 'comment-stripe-blue.png', 
				 'comment-stripe-green.png', 
				 'comment-stripe-orange.png',
				 'comment-stripe-pink.png', 
				 'comment-stripe-red.png',
				 'comment-stripe-teal.png', 
				 'comment-stripe-yellow.png', 
				 'comment-stripe-purple.png', 
				 'comment-stripe-green2.png', 
				 'comment-stripe-maroon.png'
				 ]




//alert(Comments.colors.length)


Comments.drawDiv=function()
{
//	alert(123)
	var str=''
	+'<div>'
	//+'	<div id="comments-loading-div" style="display: none">щя..</div>	'

	+'	<div id="comments-div" style="width: 400px; border: 0px solid black;"></div>'
	+'	<div id="comments-info-div" ></div>'
	+'	<div id="comments-input-div"  ></div>'
	+'</div>'
	
	document.write(str)
}





Comments.drawInput=function()
{
	var str=''
	str+=''
	+'	<div id="comments-loading-div" style="display: none">щя..</div>	'
	+'<form name="comment_form" id="comment_form" >'
	+'<textarea id="comments-input" name="comments_msg" style="width: 295px; height: 127px; background: url(/ajax/comments/images/textarea-bg.png); padding: 26px 26px 26px 26px ; border: 0px solid black;"></textarea>'
	+'</form>'
	+'<div style="margin: 0px 0 0 40px;;"><input type="button" id="comments-send-btn" value="молвить" onclick="Comments.addMessage(song_id)">'
	


	+'<div  style="cursor: pointer;  width: 78px; height: 38px; background-image: url(/ajax/comments/images/go-btn-bg.png); background-position: 0px 0px" onMouseOver="this.style.backgroundPosition=\'0px -38px\'; " onMouseOut="this.style.backgroundPosition=\'0px 0px\'; " ></div>'


	$('#comments-input-div').html(str)
}













Comments.getComments=function(id)
{
	Comments.loading(1)
//	Comments.turnInputs(0)
	$('#comments-info-div').html('');
	$.ajax({
		url: Comments.ajaxpath+'?action=getComments&id='+id,
		success: function (data, textStatus) 
		{
			//alert(data)
			//return;
			eval('data='+data)
			if(data.error=='')
			{
//				Comments.showNotice(data.result)
				Comments.drawComments(data.messages)
			}
			else
			{
				Comments.showError(data.error)
			}
			Comments.loading(0)
			Comments.turnInputs(1)
		},
		error: function (data, textStatus) 
		{
			Comments.showError('Мя, так ы так, братан. Чё то мя сервак канифолит.. щя давай попожжя, э...')
			Comments.loading(0)
			Comments.turnInputs(1)
		}
	});	
}











Comments.drawComments=function(data)
{
	//alert(typeof user)
	$('#comments-div').html('')
	if(typeof user !='undefined')
		user_id=user.id
	else user_id=0;
	
	//return;
	var str=''
	str+=''
	for(var i in data)
	{
		var a=myRandom(0,(Comments.colors.length-1))
		str+=''
		+'<div style="padding: 20px; font-family: verdana" id="comment-'+data[i].id+'">'
		+'<table>'
		+'	<tr>'
		+'		<td valign="top" align="left" width="13"><img style="margin-bottom: -3px; " src="/ajax/comments/images/'+Comments.colors[a]+'"></td>'
		+'		<td valign="top" style="padding-top: 2px;">'
		+'<div style=" font-size: 10px; padding-bottom: 4px; font-weight: bold">'+data[i].user+': &nbsp;&nbsp;&nbsp;&nbsp;</div><div style=" "> '+/*mouthString*/(data[i].text)+' '
		+(data[i].user_id == user_id?'<div   style=";cursor: pointer;  width: 19px; height:20px; background-image: url(/ajax/comments/images/comments-btns.png); background-position: 0px -20px" onMouseOver="this.style.backgroundPosition=\'0px 0px\'; " onMouseOut="this.style.backgroundPosition=\'0px -20px\'; " ></div> ':'')+'</div>'
		+'		</td>'
		+'	</tr>'
		+'</table>'
		
		+'</div>'
			+''
	}
//	alert(user.id)


	$('#comments-div').html(str)
}










//	получаем дела на выбранную дату и вызываем их отрисовку
Comments.addMessage=function(id)
{
		var str = $("#comment_form").serializeArray();
//	alert(str)
		Comments.loading(1)
	Comments.turnInputs(0)
	$('#comments-info-div').html('');

	$.ajax({
		url: Comments.ajaxpath+'?action=addMessage&id='+id,
		type: 'POST',
		data: str,
		success: function (data, textStatus) 
		{
		//	alert(data)
//			return;
			eval('data='+data)
			if(data.result=='ok')
			{
				$('#comments-input').val('')
				Comments.showNotice('сохранил на ')
				Comments.getComments(id)
			}
			else
			{
				Comments.showError(data.error)
			}
			Comments.loading(0)
			Comments.turnInputs(1)
		},
		error: function (data, textStatus) 
		{
			Comments.showError('Мя, так ы так, братан. Чё то мя сервак канифолит.. щя давай попожжя, э...')
			Comments.loading(0)
			Comments.turnInputs(1)
		}
	});	
}






Comments.turnInputs=function(on_off)
{
	if(on_off==0)
	{
		$('#comments-input').attr('disabled', 'true');
		$('#comments-send-btn').attr('disabled', 'true');
	}
	else
	{
		$('#comments-input').removeAttr('disabled');
		$('#comments-send-btn').removeAttr('disabled');
	}
}






Comments.loading=function(a)
{
	if(a>0)
		$('#comments-loading-div').fadeIn('medium')
	else
		$('#comments-loading-div').fadeOut('fast')
		
}





Comments.showError=function(msg)
{
	Comments.showMessage(msg, 1)
}




Comments.showNotice=function(msg)
{
	Comments.showMessage(msg, 0)
}




Comments.showMessage=function(msg, error)
{
	var color=''
	if(error>0)
		color='#ba5236'
	else color='green'
	$('#comments-info-div').html('<span style="font-size: 12px; color: '+color+'">'+msg+'</span>')
}