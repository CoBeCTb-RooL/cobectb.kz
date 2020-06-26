<? 
$title="ай Салем! ";
include ($_SERVER['DOCUMENT_ROOT']."/header.php");
?>





<?
$id=intval($_REQUEST['id']);
$sql="select * from pesenki where id=".$id;
$qr=mysql_query($sql);
echo mysql_error();
$next=mysql_fetch_array($qr, MYSQL_ASSOC);
//vd($next);

//vd(htmlspecialchars($text));
//$text=nl2br($text);
$text=$next['text'];
$text=preRottedString($text);

//$text=html_entitiec($next['text']);
//vd(htmlspecialchars($text));


echo '

';
//vd($next);
?>

<div   style="position: absolute; margin: 120px  0 0 0px;cursor: pointer;  width: 18px; height:72px; background-image: url(/images/songs-back-btn.png); background-position: 0px -72px" onMouseOver="this.style.backgroundPosition='0px 0px'; " onMouseOut="this.style.backgroundPosition='0px -72px'; " onclick="history.go(-1)"></div>


<?
if($next['original_text'] || $next['original_name'])
{?>
<div id="switch-<?=$next['id']?>" style="width: 70px; height: 23px ; background: url(/images/text-mode.png); cursor: pointer;  display: ; margin: 0 0 10 340px;" onclick="switchMode(<?=$next['id']?>)"></div>
<?	
}
?>

<?
$pic=$pics[$next['id']];

if($pic)
{
	echo '<div id="pic-'.$next['id'].'" style="position: absolute; left: '.($next['width'] + 140).'px; top: 100px;"><img style="" src="'.$pic['pic'].'" ></div>';
}

?>




<div id="mouthed-<?=$next['id'] ?>">
	<div style="margin-bottom: -20px; margin-left: 50px;"><img src="/images/song-top.png"></div>
	<div style="margin: 0 0 40 50px;  ">
		<table >
			<tr>
		    	<td style="background-color: <?=$next['color']?>;">
		        	<table border="0" style="background1111: url(/images/song-postpaper-bg.png) ;"   >
		                <tr>
		                    <td style="background: url(/images/song-stripe-left.png) ; background-repeat: repeat-y; background-position: top left;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
		                    <td >
		                        <div id="song-name-<?=$next['id']?>" style="margin: 40px 10px 25px 0px;"></div>
		                        <div id="song-text-<?=$next['id']?>" style="margin: 10px 10px 10px 10px; " ><? //echo $next['text'] ?></div> 
		                    </td>
		                    <td  style="background: url(/images/song-stripe-right.png) ; background-repeat: repeat-y; background-position: top right;">&nbsp;&nbsp;&nbsp;&nbsp;
		                    </td>
		                </tr>
		            </table>
		        </td>
		    </tr>
		</table>
	</div>
	<div style="margin-top: -60px; margin-left: 50px;"><img src="/images/song-bottom.png"></div>
</div>









<div id="orig-<?=$next['id'] ?>" style="display: none">

	<div style="margin: 0 0 40 50px; width: <?=$width?>px; ">
		<table >
			<tr>
		    	<td style="background-color: <?=$next['color']?>;">
		        	<table style="border: 3px solid #ececec"  >
		                <tr>
		                    <td >
		                        <div style="margin: 30px 10px 25px 13px;; display: "><font style="font-size: 25px;"><?=$next['original_title'];?></font></div>
		                        <div style="margin: 10px 10px 10px 30px; display: "><? echo $next['original_text'] ?></div>
		                    </td>
		                </tr>
		            </table>
		        </td>
		    </tr>
		</table>	
	</div>
</div>


<div style="font-size: 9px; font-style: italic; margin: 0 0 40 50px;"><?=$next['artist']?></div>


<script>
var str2='<?=$text?>'
insert_text(<?=$next['id']?>, str2, '', {"boldness":"1"})

$('#song-name-<?=$next['id']?>').html(str2dim('<?=str_replace("<br>", '\n', $next['title'])?>', 'brick'))
</script>



<script>
var song_id=<?=$_REQUEST['id']?>;
Comments.drawDiv()
Comments.drawInput()
Comments.getComments(song_id)
//Comments.getComments()
</script>







<script>
function switchMode(id)
{
	if($('#orig-'+id).is(':hidden'))
	{
		$('#orig-'+id).css('display', 'block')
		$('#mouthed-'+id).css('display', 'none')
		document.getElementById('switch-'+id).style.backgroundPosition='-70px 0px';
	}
	else
	{
		$('#orig-'+id).css('display', 'none')
		$('#mouthed-'+id).css('display', 'block')
		document.getElementById('switch-'+id).style.backgroundPosition='0px 0px';
	}

}
</script>



<? include ($_SERVER['DOCUMENT_ROOT']."/template_footer.php");?>