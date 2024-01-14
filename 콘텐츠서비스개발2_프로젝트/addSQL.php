<?php 
	header('Content-Type: text/html; charset=UTF-8');

	$id = $_POST['id'];
	$title = $_POST['title'];
	$author = $_POST['author'];
	$publisher = $_POST['publisher'];
	$date = $_POST['date'];
	$image = $_POST['image'];
	$message = "";

	// MySQL 드라이버 연결 
	include("./SQLconstants.php");
	$conn = mysqli_connect( $mySQL_host, $mySQL_id, $mySQL_password, $mySQL_database ) or die( "Can't access DB" );

	// MySQL 책 추가 실행 	
	$query = "INSERT INTO book( id, title, author, publisher, date, image ) VALUES ( '".$id."', '".$title."', '".$author."', '".$publisher."', '".$date."', '".$image."');"; 
	$resut = mysqli_query( $conn, $query );
	if( !$result ) 
	{	
		$message = "책 (".$title.")을 등록하였습니다"; 
	} 
	else 
	{
		$message = "책 (".$title.")을 등록할 수 없습니다"; 
	} 

	// MySQL 드라이버 연결 해제
	mysqli_free_result( $result );
	mysqli_close( $conn );
?>

<form name = "frm" method = "post" action = "./search.php" >
	<input type = 'hidden' name = 'message' value = ' * <?php echo $message;?>' >
</form>
<script language="javascript">
	document.frm.submit();
</script>
