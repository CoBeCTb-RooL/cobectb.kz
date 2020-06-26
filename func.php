<?
function vd($a)
{
	echo '<pre>';
	var_dump($a);
	echo '</pre>';
}






function db_connect($db_login, $db_pass, $db_host, $db_name)
{
	//global $db_host, $db_login, $db_pass, $db_name, $db_prefix, $db_login_table_name, $worker_id;
	//echo "$db_login - $db_pass - $db_host";
	//vd($db_name);
	if(mysql_connect($db_host, $db_login, $db_pass))
	{
		if(mysql_select_db($db_name))
		{
			mysql_query("SET NAMES 'utf8'");
			//mysql_query($q);
			if ($err=mysql_error())
				die("$err");
		
			return;
		}
		else{
			echo "<script>alert('no such database')</script>";
			return;
		}
	}
	else{
		echo "<script>alert('no db connection')</script>";
		return;
	}
}




function json_prepareToSave($str)
{
	$str=str_replace(array("\n", "\r"), '<br>', nl2br(htmlspecialchars($str)));
	return $str;
}



function json_prepareToTransmit($str)
{
	$str=str_replace('"', '\"', /*html_entity_decode($str)*/$str);
	$str=str_replace( array('<br />', '<br>'), "\\n", ($str));
	return $str;
}



function str2dim($str, $font)
{
	//vd($path);
	
	$path='/fonts/'.$font.'/';
	$trans=array(
						'А'=>'<img class="l" src="'.$path.'A.png">',
						'Б'=>'<img class="l" src="'.$path.'B.png">',
						'В'=>'<img class="l" src="'.$path.'V.png">',
						'Г'=>'<img class="l" src="'.$path.'G.png">',
						'Д'=>'<img class="l" src="'.$path.'D.png">',
						'Е'=>'<img class="l" src="'.$path.'E.png">',
						'Ё'=>'<img class="l" src="'.$path.'E.png">',
						'Ж'=>'<img class="l" src="'.$path.'ZH.png">',
						'З'=>'<img class="l" src="'.$path.'Z.png">',
						'И'=>'<img class="l" src="'.$path.'I.png">',
						'Й'=>'<img class="l" src="'.$path.'IY.png">',
						'К'=>'<img class="l" src="'.$path.'K.png">',
						'Л'=>'<img class="l" src="'.$path.'L.png">',
						'М'=>'<img class="l" src="'.$path.'M.png">',
						'Н'=>'<img class="l" src="'.$path.'N.png">',
						'О'=>'<img class="l" src="'.$path.'O.png">',
						'П'=>'<img class="l" src="'.$path.'P.png">',
						'Р'=>'<img class="l" src="'.$path.'R.png">',
						'С'=>'<img class="l" src="'.$path.'S.png">',
						'Т'=>'<img class="l" src="'.$path.'T.png">',
						'У'=>'<img class="l" src="'.$path.'U.png">',
						'Ф'=>'<img class="l" src="'.$path.'F.png">',
						'Х'=>'<img class="l" src="'.$path.'X.png">',
						'Ц'=>'<img class="l" src="'.$path.'TS.png">',
						'Ч'=>'<img class="l" src="'.$path.'CH.png">',
						'Ш'=>'<img class="l" src="'.$path.'SH.png">',
						'Щ'=>'<img class="l" src="'.$path.'SHYA.png">',
						'Ы'=>'<img class="l" src="'.$path.'YY.png">',
						'Ь'=>'<img class="l" src="'.$path.'mz.png">',
						'Э'=>'<img class="l" src="'.$path.'EE.png">',
						'Ю'=>'<img class="l" src="'.$path.'YU.png">',
						'Я'=>'<img class="l" src="'.$path.'YA.png">',
						
						
						'а'=>'<img class="l" src="'.$path.'a_s.png">',
						'б'=>'<img class="l" src="'.$path.'b_s.png">',
						'в'=>'<img class="l" src="'.$path.'v_s.png">',
						'г'=>'<img class="l" src="'.$path.'g_s.png">',
						'д'=>'<img class="l" src="'.$path.'d_s.png">',
						'е'=>'<img class="l" src="'.$path.'e_s.png">',
						'ё'=>'<img class="l" src="'.$path.'yo_s.png">',
						'ж'=>'<img class="l" src="'.$path.'zh_s.png">',
						'з'=>'<img class="l" src="'.$path.'z_s.png">',
						'и'=>'<img class="l" src="'.$path.'i_s.png">',
						'й'=>'<img class="l" src="'.$path.'iy_s.png">',
						'к'=>'<img class="l" src="'.$path.'k_s.png">',
						'л'=>'<img class="l" src="'.$path.'l_s.png">',
						'м'=>'<img class="l" src="'.$path.'m_s.png">',
						'н'=>'<img class="l" src="'.$path.'n_s.png">',
						'о'=>'<img class="l" src="'.$path.'o_s.png">',
						'п'=>'<img class="l" src="'.$path.'p_s.png">',
						'р'=>'<img class="l" src="'.$path.'r_s.png">',
						'с'=>'<img class="l" src="'.$path.'s_s.png">',
						'т'=>'<img class="l" src="'.$path.'t_s.png">',
						'у'=>'<img class="l" src="'.$path.'u_s.png">',
						'ф'=>'<img class="l" src="'.$path.'f_s.png">',
						'х'=>'<img class="l" src="'.$path.'x_s.png">',
						'ц'=>'<img class="l" src="'.$path.'ts_s.png">',
						'ч'=>'<img class="l" src="'.$path.'ch_s.png">',
						'ш'=>'<img class="l" src="'.$path.'sh_s.png">',
						'щ'=>'<img class="l" src="'.$path.'shya_s.png">',
						'Ъ'=>'<img class="l" src="'.$path.'tz_s.png">',
						'ы'=>'<img class="l" src="'.$path.'yy_s.png">',
						'ь'=>'<img class="l" src="'.$path.'mz_s.png">',
						'э'=>'<img class="l" src="'.$path.'ee_s.png">',
						'ю'=>'<img class="l" src="'.$path.'yu_s.png">',
						'я'=>'<img class="l" src="'.$path.'ya_s.png">',
						
						
						' '=>'</nobr><img class="l" src="'.$path.'space.png"><nobr>',
						"\\n"=>'<br>',
						'!'=>'<img class="l" src="'.$path.'voskl.png">',
						'?'=>'<img class="l" src="'.$path.'vopr.png">',
						'.'=>'<img class="l" src="'.$path.'dot.png">',
						','=>'<img class="l" src="'.$path.'zapyat.png">',
						'-'=>'<img class="l" src="'.$path.'tire.png">',
						'+'=>'<img class="l" src="'.$path.'plus.png">',
						'='=>'<img class="l" src="'.$path.'ravno.png">',
						'"'=>'<img class="l" src="'.$path.'dbl_quote.png">',
						"'"=>'<img class="l" src="'.$path.'quot.png">',
						':'=>'<img class="l" src="'.$path.'dvoetoch.png">',
						'('=>'<img class="l" src="'.$path.'skobka_left.png">',
						')'=>'<img class="l" src="'.$path.'skobka_right.png">',
						'<'=>'<img class="l" src="'.$path.'tag_left.png">',
						'>'=>'<img class="l" src="'.$path.'tag_right.png">',
					);
	//$arr=utf8_str_split($str);
	//$arr=array($str);
	
	
	//vd($arr);
	//$ret=strtr(utf8_lowercase($str), $trans);
	$ret='<nobr>'.strtr($str, $trans).'</nobr>';
	return $ret;
	
}













function draw_pages($total_elements, $pg, $onepage, $get_params)
{
	//vd($total_elements);
//$total_elements = mysql_num_rows(mysql_query($search_sql));
$print_pages = '';
    if(ceil($total_elements/$onepage)>1)
      {
	  	foreach($get_params as $key=>$val)
		{
			 $page_atrubites[] = $val.'='.$_GET[$val];
		}
	   
        $print_pages .= "<div align=\"center\" class=\"pages-div\">";
        if($pg>0) $print_pages .= "<a id=\"arrow\" title=\"предыдущая\" href=\"".$_SERVER['PHP_SELF']."?pg=".$pg.($page_atrubites ? '&'.join('&', $page_atrubites) : '')."\">&larr;</a> ";
        $index = $pg>=6 ? ($pg+1<ceil($total_elements/$onepage)-5 ? $pg-5 : (ceil($total_elements/$onepage)>11 ? ceil($total_elements/$onepage)-11 : 0)) : 0;
        for($i=1; $i<=(ceil($total_elements/$onepage)<11 ? ceil($total_elements/$onepage) : 11); $i++)
           {
             $index++;
             if($index>ceil($total_elements/$onepage)) break;
             if($index==$pg+1)
               {
                 $print_pages .= "<div>".$index."</div> ";
               }else{
                 $print_pages .= "<a href=\"".$_SERVER['PHP_SELF']."?pg=".$index.($page_atrubites ? '&'.join('&', $page_atrubites) : '')."\">".$index."</a> ";
               }

           }
        if($pg+1<ceil($total_elements/$onepage)) $print_pages .= "<a id=\"arrow\" title=\"следующая\" href=\"".$_SERVER['PHP_SELF']."?pg=".($pg+2).($page_atrubites ? '&'.join('&', $page_atrubites) : '')."\">&rarr;</a> ";
        $print_pages .= "</div><div style=\"clear:both;\">&nbsp;</div>";
      }

	return  $print_pages;
}





















function arrayToJSON($arr)
{
	foreach($arr as $key=>$val)
	{
		$b[]=$key.': "'.htmlspecialchars($val, ENT_QUOTES).'"';
	}
	return $b;
}







function getToken()
{
	$arr=array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' );
	$count=count($arr);
	$a='';
	for($i=0; $i<16; $i++)
	{
		$a.=$arr[rand(0, ($count-1))];
	}
	
	return $a;
}






function preRottedString($text)
{	
$text=str_replace("'", "\'", html_entity_decode($text));
$text=str_replace('<br />
', "\\n ", $text);
$text=str_replace('<br>', "\\n ", $text);
$text=str_replace('<p>', "\\n ", $text);
$text=str_replace('<p>
', "\\n ", $text);
$text=str_replace('</p>
', "\\n ", $text);
$text=str_replace('</p>', "\\n ", $text);

$text=str_replace(array('&quot;'), '"', $text);
$text=str_replace(array('&nbsp;'), ' ', $text);
return $text;
}

?>