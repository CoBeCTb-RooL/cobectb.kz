<? 
$title="ай Салем! ";
include ($_SERVER['DOCUMENT_ROOT']."/header.php");
?>


<img src="/images/personaji.png" alt="">&nbsp;&nbsp;<img src="/images/mans.png" width="50" alt="">

<p>

<?
$str="show me the money
operation cwal ";

echo strToRot($str);


#	походу уже не юзается
function strToRot($str)
{
//	vd(strlen($str));
//	$str=str_replace
//	$str=iconv('utf8', 'windows-1251', $str);
	$strings=explode("\n", $str);
	foreach($strings as $key=>$val)
	{
		$words=explode(' ', $val);
		
		foreach($words as $key2=>$val2)
		{
			$len=strlen($val2);
			for($i=0; $i<$len; $i++)
			{
				//$j=$i;
				if(!($key%2))
					$j++;
				else $j--;
				$char=$val2{$i};
				echo'<div style="float: left; font-style: italic; padding-top: '.(rand(0, 2)).'px">'.$char.'</div>';
			}
			echo '<div style="float: left;">&nbsp;</div>';
			
		}
		echo '<div style="clear: both"></div><br>';
	}
	
	echo '
			';
//	vd($words);
	
	
	
	
	$str=nl2br($str);
	
}
?>

<script>







function showHideSwitch(id)
{
	if($('#switch-'+id).is(':hidden'))
		$('#switch-'+id).css('display', 'block')
	else
		$('#switch-'+id).css('display', 'none')
}




function onmouseover1(id)
{
	$('#pic-'+id).css('display', 'block')
	$('#comment-smile-'+id).css('display', 'block')
	//alert(123)
	var str="  insert_text("+id+", rot_text_"+id+", 'rot_text_"+id+"')"
//	alert(str)
	eval(str)
	
	
	//$("#song-text-"+id).html=rotted_text[id]
}



function onmouseout1(id)
{
	$('#pic-'+id).css('display', 'none')
	$('#comment-smile-'+id).css('display', 'none')
	
	
	
	//$('#song-text-'+id).html(eval('commonText_'+id))
	//var str="  insert_text("+id+", commonText_"+id+", 'rot_text_"+id+"')"
	//$('#song-text-'+id).html(eval("rot_text_"+id))
	//eval("insert_text("+id+", rot_text_"+id+")")
}






</script>





<?





$songs=getSongs();
//vd($songs);

foreach($songs as $key=>$val)
{	
	$pic=$pics[$val['id']];
	
	//vd($pic);
	//width: '.$val['width'].'px;
	//onclick="$(\'#song-body-'.$val['id'].'\').slideToggle()"
	//onMouseOver="showHideSwitch('.$val['id'].')" onmouseout="showHideSwitch('.$val['id'].')"
	$rot_title=preRottedString($val['title']);
	//$rot_text=preRottedString($val['text']);
	
	$anons=substr($val['text'], 0, strpos($val['text'], "<br />\r\n<br />", 4));
	echo '
	<script>
		var rot_text_'.$val['id'].' = \''.preRottedString($anons).'\';
		var commonText_'.$val['id'].' = \''.preRottedString($anons).'\';
	</script>';
	
	$val['text']=substr($val['text'], 0, strpos($val['text'], "<br />\r\n<br />", 4)).'<img style="margin: 0 0 -1px 1px;" src="/images/song-dots.png">';
	

	
	$sql="select count(id) from song_comments where pid=".$val['id'];
	$qr=mysql_query($sql);
	echo mysql_error();
	$next=mysql_fetch_array($qr);
	$commentsCount=$next[0];
	//vd($rot_title);
	
	/*echo'
	<div class="song" style="z-index:'.$pic['z-index'].';  padding: 10px 15px 10px 15px; background: '.$val['color'].'; width: '.$val['width'].'px;  float: left; margin: 15px;   position: relative "    onmouseover="onmouseover1('.$val['id'].')" onmouseout="onmouseout1('.$val['id'].')">';*/
	
	echo'
	<div class="song" style="z-index:'.$pic['z-index'].'; overflow: visible; border: 1px solid black;  padding: 10px 15px 10px 15px;background: '.$val['color'].'; border: 1px dashed black; width: '.$val['width'].'px;  float: left; margin: 15px;   position: relative "    onmouseover="onmouseover1('.$val['id'].'); $(this).css(\'background\', \''.$val['color'].'\')" onmouseout="onmouseout1('.$val['id'].'); $(this).css(\'background\', \''.$val['color'].'\')">
	';
	
	if(rand(0, 1))
	{
		echo '<div style="position: absolute; left: -7px; top: '.(rand(20, 40)).'px; width:13px; height: 19px; background: url(/images/scissors-vert.png)"></div>';
	}
	else
	{
		echo '<div style="position: absolute; top: -8px; left: '.(rand(30, 60)).'px; width: 18px; height: 14px; background: url(/images/scissors-hor.png)"></div>';
	}
	
	
	
	
	
	echo '	
	
		<div id="song-name-'.$val['id'].'">'.str2dim($rot_title, 'brick').'</div>
		<div style="display: none" id="song-original-name-'.$val['id'].'">'.$val['original_title'].'</div>
	
		<div id="song-body-'.$val['id'].'" style="display: block">
			<p>
			<div id="song-text-'.$val['id'].'" >'.$val['text'].'</div>
			
	<script>
		
		var commonText_'.$val['id'].' = $(\'#song-text-'.$val['id'].'\').html();
	</script>
			
			<!--<div id="song-original-text-'.$val['id'].'" style="display: none">'.$val['original_text'].'</div>-->
		<div style="clear: both"></div>
			<div style="font-size: 9px; font-style: italic">'.$val['artist'].'</div>
		</div>
		
		
		'.(($val['original_text'] || $val['original_title']) && 0?'
			<div id="switch-'.$val['id'].'" style="width: 70px; height: 23px ; background: url(/images/text-mode.png); cursor: pointer; position: absolute; top: 10px; right: 10px; display: " onclick="switchMode('.$val['id'].')"></div>
		':'').'
		
		'.($pic?'
		<div id="pic-'.$val['id'].'" style="position: absolute;  '.$pic['oy'].': '.$pic['oy_val'].'px; '.$pic['ox'].': '.$pic['ox_val'].'px; display: none"><img style="" src="'.$pic['pic'].'" ></div>
		':'').'
		
		<div id="comment-smile-'.$val['id'].'" style="position: absolute;  bottom: 10px; right: 10px; display: none "><a href="/modules/song.php?id='.$val['id'].'"  title="опсудидь"><img border="0" src="/images/skype_smiles/talk.gif" alt="" style="" alt="опсудидь"></a></div>
		
		
<!--		<div  style="position: absolute;  z-index: 1; bottom: 0px; right: 0px; display:  ; background: url(/images/trep-white-stripe-bg.png); width: 99px; height: 98px; background-color: '.$val['color'].'"></div>-->
		
		
	</div>

'.($val['clear_after']?'<div style="clear: both"></div>':'').'
';
}

?>












<?
function getSongs()
{
	$sql="select * from pesenki order by idx, id";
	$qr=mysql_query($sql);
	echo mysql_error();
	if(mysql_num_rows($qr))
	{
		while($next=mysql_fetch_array($qr, MYSQL_ASSOC))
		{
			$arr[]=$next;
		}
	}
	return $arr;
}
?>



<? include ($_SERVER['DOCUMENT_ROOT']."/template_footer.php");?>