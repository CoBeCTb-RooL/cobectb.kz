<?
class User
{
	var $id, $attrs;
	function User($id)
	{
		$id=intval($id);
		$sql="select * from users WHERE id=".$id;
	//	vd($sql);
		$qr=mysql_query($sql);
		echo mysql_error();
		ini_set('display_errors', 1);
		if(mysql_num_rows($qr))
		{
			$next=mysql_fetch_array($qr, MYSQL_ASSOC);
			$this->id=$next['id'];
			$this->attrs=$next;
			
		}
		//else $this=NULL;
	}
	
	
	
	
	
	
	
	
	
}
?>