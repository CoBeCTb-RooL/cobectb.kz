<? 
$title="ай Салем! ";
include ($_SERVER['DOCUMENT_ROOT']."/header.php");
?>











<script>
//Schedule.drawDiv();
//Schedule.init();
</script>



<script>
Reg.drawDiv();
Reg.form(<?='{'.join(', ', arrayToJSON($_SESSION['user'])).'}'?>);
</script>







<script>
//GB.drawDiv();
//GB.drawInput();
</script>







<? include ($_SERVER['DOCUMENT_ROOT']."/template_footer.php");?>