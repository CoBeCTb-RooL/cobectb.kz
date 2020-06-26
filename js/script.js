function show_or_hide(id, soh)
{
	//alert(id)
	if(soh==1)
	{
		//$('#'+id).fadeIn("fast")
		$('#'+id).css('display', 'block')
	}
	else
	{
		//$('#'+id).fadeOut("fast")
		$('#'+id).css('display', 'none')
	}
	
	/*if($('#'+id).is(':hidden'))
		$('#'+id).fadeIn("fast")
	else
		$('#'+id).fadeOut("fast")*/
}






function myRandom(minn, maxx)
{	
	var a
	
	while(1)
	{
		var a=Math.floor(Math.random() * 10) 
		if(a <= maxx && a >= minn)
			return a
	}
}







function mouthString(str, opts)
{
	if(typeof opts != 'undefined')
		boldness=opts.boldness
	else boldness=0
//	alert(str)
	/*
	var ret = ''
	for(var i=0; i<str.length; i++)
	{
		
		//alert(str[i])
		//var a = Math.floor(Math.random() * 10)
		var a=myRandom(0, 2)
		var size=10 + myRandom(1, 2)
		var bold_weight=myRandom(0, 1)
		
//		alert(a)
		
		var char=str[i]
		if(char == ' ')
			char='&nbsp;'
		if(char == '\n')
			ret+='<div style="clear: both"></div>'
		else
			ret+=(char=='&nbsp;'?'</nobr><nobr>':'')+'<div style="float: left; font-style: italic; padding-top: '+a+'px; font-size: '+size+'px; '+(bold_weight > 0?'font-weight: bold; ':'')+'">'+char+'</div>'
		+'';
	}
//	$('#rotting-div').html(ret)
	
	return '<nobr>'+ret+'<div style="clear: both"></nobr>'
	*/
	
	var ret = ''
	for(var i=0; i<str.length; i++)
	{
		
		//alert(str[i])
		//var a = Math.floor(Math.random() * 10)
		var a=myRandom(0, 1)
		var size=10 + myRandom(1, 2)
		var bold_weight=myRandom(0, boldness)	// OR 1
		
//		alert(a)
		
		var char=str[i]
		if(char == ' ')
			char='&nbsp;'
		if(char == '\n')
			ret+='<div style="clear: both"></div>'
		else
			ret+=(char=='&nbsp;'?'</nobr><nobr>':'')+'<span style="float: left;  margin-top: 1px;  font-style: italic; padding-top: '+a+'px; font-size: '+size+'px; '+(bold_weight > 0?'font-weight: bold; ':'')+'">'+char+'</span>'
		+'';
	}
//	$('#rotting-div').html(ret)
	
	return '<nobr>'+ret+'<br></nobr>'
//	alert(str)
}





















function insert_text(id, text, varname, opts)
{
//		alert(123)
//alert(opts)
	//alert(text)
	str=mouthString(text, opts)
	
	$('#song-text-'+id).html(str)
	//setTimeout("insert_text('"+id+"', str, "+varname+")", 100)
}










function  str2dim(str, font)
{
	path='/fonts/'+font+'/';
	str=str_replace('<br/>', '', str)
	
	trans={
						'А' : '<img class="l" src="'+path+'A.png">',
						'Б' : '<img class="l" src="'+path+'B.png">',
						'В' : '<img class="l" src="'+path+'V.png">',
						'Г' : '<img class="l" src="'+path+'G.png">',
						'Д' : '<img class="l" src="'+path+'D.png">',
						'Е' : '<img class="l" src="'+path+'E.png">',
						'Ё' : '<img class="l" src="'+path+'E.png">',
						'Ж' : '<img class="l" src="'+path+'ZH.png">',
						'З' : '<img class="l" src="'+path+'Z.png">',
						'И' : '<img class="l" src="'+path+'I.png">',
						'Й' : '<img class="l" src="'+path+'IY.png">',
						'К' : '<img class="l" src="'+path+'K.png">',
						'Л' : '<img class="l" src="'+path+'L.png">',
						'М' : '<img class="l" src="'+path+'M.png">',
						'Н' : '<img class="l" src="'+path+'N.png">',
						'О' : '<img class="l" src="'+path+'O.png">',
						'П' : '<img class="l" src="'+path+'P.png">',
						'Р' : '<img class="l" src="'+path+'R.png">',
						'С' : '<img class="l" src="'+path+'S.png">',
						'Т' : '<img class="l" src="'+path+'T.png">',
						'У' : '<img class="l" src="'+path+'U.png">',
						'Ф' : '<img class="l" src="'+path+'F.png">',
						'Х' : '<img class="l" src="'+path+'X.png">',
						'Ц' : '<img class="l" src="'+path+'TS.png">',
						'Ч' : '<img class="l" src="'+path+'CH.png">',
						'Ш' : '<img class="l" src="'+path+'SH.png">',
						'Щ' : '<img class="l" src="'+path+'SHYA.png">',
						'Ы' : '<img class="l" src="'+path+'YY.png">',
						'Ь' : '<img class="l" src="'+path+'mz.png">',
						'Э' : '<img class="l" src="'+path+'EE.png">',
						'Ю' : '<img class="l" src="'+path+'YU.png">',
						'Я' : '<img class="l" src="'+path+'YA.png">',
						
						
						'а' : '<img class="l" src="'+path+'a_s.png">',
						'б' : '<img class="l" src="'+path+'b_s.png">',
						'в' : '<img class="l" src="'+path+'v_s.png">',
						'г' : '<img class="l" src="'+path+'g_s.png">',
						'д' : '<img class="l" src="'+path+'d_s.png">',
						'е' : '<img class="l" src="'+path+'e_s.png">',
						'ё' : '<img class="l" src="'+path+'yo_s.png">',
						'ж' : '<img class="l" src="'+path+'zh_s.png">',
						'з' : '<img class="l" src="'+path+'z_s.png">',
						'и' : '<img class="l" src="'+path+'i_s.png">',
						'й' : '<img class="l" src="'+path+'iy_s.png">',
						'к' : '<img class="l" src="'+path+'k_s.png">',
						'л' : '<img class="l" src="'+path+'l_s.png">',
						'м' : '<img class="l" src="'+path+'m_s.png">',
						'н' : '<img class="l" src="'+path+'n_s.png">',
						'о' : '<img class="l" src="'+path+'o_s.png">',
						'п' : '<img class="l" src="'+path+'p_s.png">',
						'р' : '<img class="l" src="'+path+'r_s.png">',
						'с' : '<img class="l" src="'+path+'s_s.png">',
						'т' : '<img class="l" src="'+path+'t_s.png">',
						'у' : '<img class="l" src="'+path+'u_s.png">',
						'ф' : '<img class="l" src="'+path+'f_s.png">',
						'х' : '<img class="l" src="'+path+'x_s.png">',
						'ц' : '<img class="l" src="'+path+'ts_s.png">',
						'ч' : '<img class="l" src="'+path+'ch_s.png">',
						'ш' : '<img class="l" src="'+path+'sh_s.png">',
						'щ' : '<img class="l" src="'+path+'shya_s.png">',
						'Ъ' : '<img class="l" src="'+path+'tz_s.png">',
						'ы' : '<img class="l" src="'+path+'yy_s.png">',
						'ь' : '<img class="l" src="'+path+'mz_s.png">',
						'э' : '<img class="l" src="'+path+'ee_s.png">',
						'ю' : '<img class="l" src="'+path+'yu_s.png">',
						'я' : '<img class="l" src="'+path+'ya_s.png">',
						
						
						' ' : '</nobr><img class="l" src="'+path+'space.png"><nobr>',
						"\n" : '<br>',
						'!' : '<img class="l" src="'+path+'voskl.png">',
						'?' : '<img class="l" src="'+path+'vopr.png">',
						'.' : '<img class="l" src="'+path+'dot.png">',
						',' : '<img class="l" src="'+path+'zapyat.png">',
						'-' : '<img class="l" src="'+path+'tire.png">',
						'+' : '<img class="l" src="'+path+'plus.png">',
						'=' : '<img class="l" src="'+path+'ravno.png">',
						'"' : '<img class="l" src="'+path+'dbl_quote.png">',
						"'" : '<img class="l" src="'+path+'quot.png">',
						':' : '<img class="l" src="'+path+'dvoetoch.png">',
						'(' : '<img class="l" src="'+path+'skobka_left.png">',
						')' : '<img class="l" src="'+path+'skobka_right.png">',
						'<' : '<img class="l" src="'+path+'tag_left.png">',
						'>' : '<img class="l" src="'+path+'tag_right.png">',
					};
	return strtr(str, trans)
}