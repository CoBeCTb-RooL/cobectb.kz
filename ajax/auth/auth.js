///////////////////////////////////////
/////////// АВТОРИЗАЦИЯ	///////////////
///////////////////////////////////////

var Auth={};
Auth.ajaxpath='/ajax/auth/auth.php'

Auth.drawDiv=function()
{
//	alert(123)
	//	форма логинации
	var str=''
	+'<div id="auth-parent-div" style="width: 233px; height: 134px;  background: url(/ajax/auth/images/auth-form-bg.jpg); display: none">'
	+'	<div style="padding: 5px ">'
		
		+'	<div id="auth-info-div" ></div>'
		+'	<div id="auth-div" ></div>'
		
	+'	</div>'
	+'</div>'
	
	
	//	приветствие
	+'<div id="auth-greeting-div"  style="width: 234px; height: 29px; display: none; position: relative; background: url(/ajax/auth/images/auth-greeting-bg.png); "></div>'
	
	document.write(str)
}






Auth.loginForm=function()
{
	$('#auth-info-div').html('<img src="/images/skype_smiles/13.gif"> Еорот, атын кiм?')
	//Auth.loading(1)
	var str=''
	+''
	
	+'<form name="auth_form" id="auth_form">'
	+'	<table border="0" style="border-collapse: separate;">'
	+'		<tr>'
	+'			<td align="right" valign="top">Кто на?<br><span style="font-size: 9px">(email)</span></td>'
	+'			<td valign="top"><input class="auth-input" type="text" name="email" id="auth-email" style=" background: url(/ajax/auth/images/auth-form-inputs-bg.png)"></td>'
	+'		</tr>'
	+'		<tr>'
	+'			<td align="right" valign="top">А?<br><span style="font-size: 9px">(пароль)</span></td>'
	+'			<td valign="top"><input class="auth-input" type="password" name="password" id="auth-password" style=" background: url(/ajax/auth/images/auth-form-inputs-bg.png); background-position: 0 45px "></td>'
	+'		</tr>'
	+'	</table>'
	+'</form>'
	+'<table>'
	+'	<tr>'
	+'		<td><input type="button" id="auth-check-btn" value="атичяю э" onclick="Auth.checkAuth()"></td>'
	+'		<td style="padding-left: 10px;"><div id="auth-loading-div" style="display: none "><img src="/images/skype_smiles/39.gif"> Ээ.. </div></td>'
	+'	</tr>'
	+'</table>'
	
	+'<div   style="position: absolute;margin: 25px 0 0 10px;cursor: pointer;  width: 79px; height:10px; background-image: url(/ajax/auth/images/auth-images.png); background-position: 0px -16px" onMouseOver="this.style.backgroundPosition=\'0px -26px\'; " onMouseOut="this.style.backgroundPosition=\'0px -16px\'; " onclick="location.href=\'/modules/cabinet.php\'"></div> '
	
	
	
	
	
	$('#auth-div').html(str)
	//$('#auth-parent-div').css('display', 'block')
	$('#auth-parent-div').slideDown()

	//Auth.show()
}







Auth.checkAuth=function()
{
	var str = $("#auth_form").serializeArray();
	var email=$('#auth-email').val()
	var password=$('#auth-password').val()
	
	if(email == '')
	{
		Auth.showError('е Кто э?')
		return
	}
	if(password == '')
	{
		Auth.showError('Е, парол!')
		return
	}
	
	
	
	Auth.loading(1)
	Auth.turnInputs(0)
	
	//$('#auth-info-div').html('&nbsp;');
	$.ajax({
		url: Auth.ajaxpath+'?action=checkAuth',
		data: str,
		success: function (data, textStatus) 
		{
		//	alert(data);Auth.turnInputs(1);return;
			eval('data='+data);
			if(data.result=='ok')
			{
				//Auth.showNotice('ЕЕе, салем, '+data.user.name+'!! ')
			//	Auth.drawDiv();
				//$('#auth-parent-div').css('display', 'none')
				$('#auth-parent-div').slideUp()
				Auth.showGreeting(data.user);
				Reg.form(data.user)
			//	Comments.getComments(song_id)
			}
			else
			{
				Auth.showError(data.result)
			}
			Auth.loading(0)
			Auth.turnInputs(1)
		},
		error: function (data, textStatus) 
		{
			Auth.showError('Мя, так ы так, братан. Чё то мя сервак канифолит.. щя давай попожжя, э...')
			Auth.loading(0)
			Auth.turnInputs(1)
		}
		
	});	
}






Auth.turnInputs=function(on_off)
{
	if(on_off==0)
	{
		$('#auth-email').attr('disabled', 'true');
		$('#auth-password').attr('disabled', 'true');
		$('#auth-check-btn').attr('disabled', 'true');
	}
	else
	{
		$('#auth-email').removeAttr('disabled');
		$('#auth-password').removeAttr('disabled');
		$('#auth-check-btn').removeAttr('disabled');
	}
}






Auth.loading=function(a)
{
	if(a>0)
	{
		//$('#auth-loading-div').fadeIn('medium')
		$('#auth-info-div').html('<img src="/images/skype_smiles/39.gif"> Ээ..')
	//	 alert(123)
	}
	else
	{
		$('#auth-loading-div').fadeOut('medium')
	}
		
}





Auth.showError=function(msg)
{
	Auth.showMessage(msg, 1)
}




Auth.showNotice=function(msg)
{
	Auth.showMessage(msg, 0)
}




Auth.showMessage=function(msg, error)
{
	var color=''
	if(error>0)
		color='#ba5236'
	else color='green'
	$('#auth-info-div').html('<span style="font-size: ; color: '+color+'">'+msg+'</span>')
}






Auth.showGreeting=function(user)
{
	//$('#auth-parent-div').css('background', 'url(/ajax/auth/images/auth-greeting-bg.png)')
	var str=''
	+'<div style="padding: 6px 0 0 3px; ">э, <b>'+user.name+'</b>! Калайсын?</div>'
	+'<div style="margin-top: -4px; position: absolute; right: -10px;"><input type="button" id="auth-exit" value="уйти на" onclick="Auth.exit()"></div>'
	
	+'<div   style="position: absolute;margin: 10px 0 0 10px;cursor: pointer;  width: 54px; height:8px; background-image: url(/ajax/auth/images/auth-images.png); background-position: 0px 0px" onMouseOver="this.style.backgroundPosition=\'0px -8px\'; " onMouseOut="this.style.backgroundPosition=\'0px 0px\'; " onclick="location.href=\'/modules/cabinet.php\'"></div> '
	
//	str=''
	$('#auth-greeting-div').html(str)
	//$('#auth-greeting-div').css('display', 'block')
	$('#auth-greeting-div').slideDown()
}






Auth.exit=function()
{
	Auth.loading(1)
	
	$('#auth-info-div').html('&nbsp;');
	$.ajax({
		url: Auth.ajaxpath+'?action=exit1',
		success: function (data, textStatus) 
		{
		//	alert(data);Auth.turnInputs(1);return;
			eval('data='+data);
			if(data.result=='ok')
			{
//				Auth.drawDiv();
				//$('#auth-greeting-div').css('display', 'none')
				$('#auth-greeting-div').slideUp()
				Auth.loginForm();
				Reg.form({})
			}
			else
			{
				Auth.showError(data.result)
			}
			Auth.loading(0)
		},
		error: function (data, textStatus) 
		{
			Auth.showError('Мя, так ы так, братан. Чё то мя сервак канифолит.. щя давай попожжя, э...')
			Auth.loading(0)
		}
		
	});	
}