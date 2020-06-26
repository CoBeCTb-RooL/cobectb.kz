///////////////////////////////////////
///////// РЕГИСТРАЦИЯ	///////////////
///////////////////////////////////////

var Reg={};
Reg.ajaxpath='/ajax/reg/reg.php'

Reg.drawDiv=function()
{
//	alert(123)
var a=str2dim('Регистрация граждан:', 'brick')
	var str=''
	+'<div style="background: url(/ajax/reg/images/reg-bg.png); width: 378px; height: 300px;  ">'
	+'	<div style="padding: 10px 20px">'
	+a
		//+'	<div id="reg-loading-div" style="display: none">щя..</div>	'
		//+'	<div id="reg-info-div" ></div>'
		+'	<div id="reg-div" ></div>'
	+'	</div>'
	+'</div>'
	
	+'<div id="reg-activation-parent-div"></div>'
	
	
	document.write(str)
}





 
Reg.form=function(user)
{
	//Reg.loading(1)
	
	$('#reg-info-div').html('')
	var str=''
	//+a
//	+'РЕГИСТРАЦИЯ ГРАЖДАН'
	+'<p><form name="reg_form" id="reg_form">'
	+'	<table border="0">'
	+'		<tr>'
	+'			<td align="right" >Имя, на *</th>'
	+'			<td ><input class="medium-input-1" type="text" name="name" id="reg-name" value="'+(user.name!= undefined?user.name:'')+'"></td>'
	+'		</tr>'
	
	+'		<tr>'
	+'			<td align="right">Фамилия, на</th>'
	+'			<td ><input class="medium-input-2" type="text" name="surename" id="reg-surename" value="'+(user.surename!= undefined?user.surename:'')+'"></th>'
	+'		</tr>'
	
	+'		<tr>'
	+'			<td align="right">email, на *</th>'
	+'			<td ><input class="medium-input-3" type="text" name="email" id="reg-email" value="'+(user.email!= undefined?user.email:'')+'"></td>'
	+'		</tr>'
	+'	</table>'
	+''
	
	
	if(user.id>0)
	{
		str+=''
		+'	<a href="javascript:void(0)" onclick="$(\'#passes-div\').slideToggle()">сменить пароль</a>'
		str+=''
		+'	<div id="passes-div" style="display: '+(user.id>0?'none':'block')+';" >'
		+'	<table border="0">'
		+'		<tr > '
		+'			<td align="right">Стары пароль, на *</th>'
		+'			<td ><input class="medium-input-1"type="password" name="password" id="reg-password"></td>'
		+'		</tr>'
		
		+'		<tr >'
		+'			<td align="right">Новы, на </th>'
		+'			<td ><input class="medium-input-2" type="password" name="password_new" id="reg-password-new"></td>'
		+'		</tr>'
		+'	</table>'
		+'	</div>'
	}
	else
	{
		str+=''
		+'	<div id="passes-div" style="display: '+(user.id>0?'none':'block')+';" >'
		+'	<table border="0">'
		+'		<tr > '
		+'			<td align="right">Пароль, на *</th>'
		+'			<td ><input class="medium-input-1" type="password" name="password" id="reg-password"></td>'
		+'		</tr>'
		
		+'		<tr >'
		+'			<td align="right">Ещё раз пароль, на *</th>'
		+'			<td ><input class="medium-input-3" type="password" name="password2" id="reg-password2"></td>'
		+'		</tr>'
		+'	</table>'
		+'	</div>'
	}
	//alert(user.id)
	
	
	str+=''
	+'</form>'
	+'<table>'
	+'	<tr style="height: 50px">'
	+'		<td><input type="button" id="reg-check-btn" value="вот так, на" onclick="Reg.checkRegForm('+(user.id != undefined?user.id:'')+')"></td>'
	+'		<td width="30"> <div id="reg-loading-div" style="display: none">Ээ.. <img src="/images/skype_smiles/39.gif"></div></td>'
	+'		<td><div id="reg-info-div" ></div></td>'
	+'	</tr>'
	+'</table>'
	+''
	
	if(user.id>0)
	{}
	else
	{
		//str+='<div id="reg-activation-parent-div"></div>'
		
	}
	
	$('#reg-div').html(str)
	
	if(user.id > 0)
	{
		$('#reg-activation-parent-div').slideUp()
	}
	else
	{
		Reg.Activation.init();
		$('#reg-activation-parent-div').slideDown()
	}
	//Reg.show()
}







Reg.checkRegForm=function(edit)
{
	//alert(edit>0)
	
	var str = $("#reg_form").serializeArray();
	//alert(str)
	
	var name=$('#reg-name').val()
	var surename=$('#reg-surename').val()
	var email=$('#reg-email').val()
	var password=$('#reg-password').val()
	var password2=$('#reg-password2').val()
	var password_new=$('#reg-password-new').val()
	if(password_new==undefined)
		password_new=''
	
	
	
	
	if(name== '')
	{
		Reg.showError('Атын кiм, ээ?')
		$('#reg-name').focus()
		return
	}
	
	if(email == '')
	{
		Reg.showError('э, Емейл, на!')
		$('#reg-email').focus()
		return
	}
	
	if(edit > 0)
	{
		if(password != '' && password_new == '')
		{
			Reg.showError('Новы пароль напиши ей!')
			$('#reg-password-new').focus()
			return
		}
		if(password == '' && password_new != '')
		{
			Reg.showError('Стары пароль тоже нужно братан..')
			$('#reg-password-new').focus()
			return
		}
	}
	else
	{
		if(password == '')
		{
			Reg.showError('Е, парол!')
			$('#reg-password').focus()
			return
		}
		
		
		if(password2 == '')
		{
			Reg.showError('Ээ, ещё рас пороль!')
			$('#reg-password2').focus()
			return
		}
		
		
		if(password != password2)
		{
			Reg.showError('Е, пароли ты же разные написал, надоел э!')
			$('#reg-password').focus()
			return
		}
	}
	
	
	
	Reg.loading(1)
	Reg.turnInputs(0)
	
	$('#reg-info-div').html('');
	/*$.ajax({
		url: Reg.ajaxpath+'?action=checkReg&name='+name+'&surename='+surename+'&email='+email+'&password='+password+'&password2='+password2+'&password_new='+password_new+'',
		success: function (data, textStatus) 
		{
		//	alert(data);Reg.turnInputs(1);return;
			eval('data='+data);
			if(data.result=='ok')
			{
				if(data.user.id > 0 )
					Reg.form(data.user)
				else
				{
					Reg.showNotice('Э всё тебе письмо на мыло ушло! там активизируйся туда, сюда там... ')
					$('#reg-div').html('')
				}
				Auth.showGreeting(data.user);
				//Reg.form(data.user)
			//	Reg.drawDiv();
//			alert('ok')
				
				//Reg.showGreeting(data.user);
				
			}
			else
			{
				Reg.showError(data.result)
			}
			Reg.loading(0)
			Reg.turnInputs(1)
		},
		error: function (data, textStatus) 
		{
			Reg.showError('Мя, так ы так, братан. Чё то мя сервак канифолит.. щя давай попожжя, э...')
			Reg.loading(0)
			Reg.turnInputs(1)
		}
		
	});	*/
	
	$.ajax({
		url: Reg.ajaxpath+'?action=checkReg',
		type: 'POST',
		data: str,
		success: function (data, textStatus) 
		{
			//alert(data);Reg.turnInputs(1);return;
			eval('data='+data);
			if(data.result=='ok')
			{
//				alert(data.user.id)
				if(data.user.id != undefined )
				{
					Reg.form(data.user)
					Auth.showGreeting(data.user);
					Reg.showNotice('сохранено на!')
				}
				else
				{
					Reg.showNotice('Э всё тебе письмо на мыло ушло! там активизируйся туда, сюда там... ')
					//Reg.turnInputs(0)
					//$('#reg-div').html('')
				}
				
				//Reg.form(data.user)
			//	Reg.drawDiv();
//			alert('ok')
				
				//Reg.showGreeting(data.user);
				
			}
			else
			{
				Reg.showError(data.result)
			}
			Reg.loading(0)
			Reg.turnInputs(1)
		},
		error: function (data, textStatus) 
		{
			Reg.showError('Мя, так ы так, братан. Чё то мя сервак канифолит.. щя давай попожжя, э...')
			Reg.loading(0)
			Reg.turnInputs(1)
		}
		
	});
}






Reg.turnInputs=function(on_off)
{
	if(on_off==0)
	{
		$('#reg-div input').attr('disabled', 'true');
	}
	else
	{
		$('#reg-div input').removeAttr('disabled');
	}
}






Reg.loading=function(a)
{
	if(a>0)
		$('#reg-loading-div').fadeIn('fast')
	else
		$('#reg-loading-div').fadeOut('fast')
		
}





Reg.showError=function(msg)
{
	Reg.showMessage(msg, 1)
}




Reg.showNotice=function(msg)
{
	Reg.showMessage(msg, 0)
}




Reg.showMessage=function(msg, error)
{
	var color=''
	if(error>0)
		color='#ba5236'
	else color='green'
	
	
	$('#reg-info-div').html('<span id="blabla" style="font-size: 12px; color: '+color+'">'+msg+'</span>')
/*
	$('#blabla').animate({ 
  //  width: "70%",
    //opacity: 0.4,
  //  marginLeft: "0.6in",
    fontSize: "16", 
  //  borderWidth: "10px",
	fontColor: '#fff'
  }, 500 );
	
	
	$('#blabla').animate({ 
  //  width: "70%",
    //opacity: 0.4,
  //  marginLeft: "0.6in",
    fontSize: "12", 
  //  borderWidth: "10px",
	fontColor: '#fff'
  }, 500 );
*/

}










Reg.Activation={};

Reg.Activation.init=function()
{
	var str=''
	str+=''
	
	+'<a href="javascript:void(0)" onclick="$(this).css(\'display\', \'none\'); $(\'#reg-activation-div\').slideDown()" >или братка, если ключ ввести надо?</a>'
	+'<div  id="reg-activation-div" style="display: none; margin-top: -24px; background: url(/ajax/reg/images/reg-activate-bg.png); width: 448px; height: 87px;  " >'
	+'	<div style="padding: 20px; width: 600px;">'
		+'<table>'
		+'	<tr>'
		+'		<td>'
		+'			ключ на: <input type="text" class="medium-input-2" name="code" id="reg-code">  <input type="button" id="reg-code-btn" value="окей, на!"  onclick="Reg.Activation.activate()">'
		+'		</td>'
		+'		<td width="50px">'
		+'			<div id="reg-activation-loading-div" style="display: none">щя..</div>	'
		+'		<td>'
		+'	</tr>'
		+'	<tr>'
		+'		<td colspan="2">'
		+'			<div id="reg-activation-info-div" ></div>'			
		+'		</td>'
		+'	</tr>'
		+'</table>'
	+'	</div>'

	
	+'</div>'
	
	$('#reg-activation-parent-div').html(str)
}









Reg.Activation.turnInputs=function(on_off)
{
	if(on_off==0)
	{

		$('#reg-activation-div input').attr('disabled', 'true');
	}
	else
	{
		$('#reg-activation-div input').removeAttr('disabled');
	}
}






Reg.Activation.loading=function(a)
{
	if(a>0)
		$('#reg-activation-loading-div').fadeIn('fast')
	else
		$('#reg-activation-loading-div').fadeOut('fast')
		
}








Reg.Activation.activate=function()
{
	if($('#reg-code').val()=='')
	{
		Reg.Activation.showError('Ключ какой?')
		return
	}
	
	$('#reg-activation-info-div').html('')
	Reg.Activation.loading(1)
	Reg.Activation.turnInputs(0)
	$.ajax({
		url: Reg.ajaxpath+'?action=activate&code='+$('#reg-code').val(),
		success: function (data, textStatus) 
		{
			//alert(data);Reg.Activation.turnInputs(1);return;
			
			eval('data='+data)
			if(data.result=='ok')
			{
//				alert('ok')
				Reg.Activation.turnInputs(0)
				Reg.Activation.showNotice('эЭэ! сё нищтек, братуха! давай терь заходи!! =))) ')
			}
			else
			{
				
				Reg.Activation.showError(data.result)
			}
			Reg.Activation.loading(0)
			Reg.Activation.turnInputs(1)
			$('#reg-code').val('')
		},
		error: function (data, textStatus) 
		{
			//alert('Возникла ошибка на сервере. Попробуйте позднее..')
			Reg.Activation.showError('Мя, так ы так, братан. Чё то мя сервак канифолит.. щя давай попожжя, э...')
		
			Reg.Activation.loading(0)
			Reg.Activation.turnInputs(1)
		}
		
	});	
	
}









Reg.Activation.showError=function(msg)
{
	Reg.Activation.showMessage(msg, 1)
}




Reg.Activation.showNotice=function(msg)
{
	Reg.Activation.showMessage(msg, 0)
}




Reg.Activation.showMessage=function(msg, error)
{
	var color=''
	if(error>0)
		color='#ba5236'
	else color='green'
	$('#reg-activation-info-div').html('<span style="font-size: 12px; color: '+color+'">'+msg+'</span>')
}