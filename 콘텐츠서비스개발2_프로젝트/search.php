<?php 
	header('Content-Type: text/html; charset=UTF-8');
?>
<html>
	<HEAD>      
		<script language="javascript">
			// 전달받은 메시지 출력
			function showMessage( message )
			{
				if ( ( message != null ) && ( message != "" ) && ( message.substring( 0, 3 ) == " * " )  ) 
				{
					alert( message );
				}
			}     
			// 지정한 url로 이동하는 함수 
			function move( url )	
	 		{
				document.formm.action = url;
				document.formm.submit();
			}
		</script>
	</HEAD>
<body onLoad="showMessage( '<?php echo $_POST['message'];?>' );" >
		<!-- 화면구성 -->
		<BR> 
		<form name = "formm" method = "post">				
			&nbsp; &nbsp; &nbsp; 
			책 제목 : <INPUT TYPE="text" NAME="message" SIZE="60"> 
		</form>  
		 &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   
		<INPUT TYPE = "button" value = "책 제목 검색" onClick="javascript:move( './search.php' );">
		<INPUT TYPE = "button" value = "새 책  추가" onClick="javascript:move( './add.php' );">	
		<INPUT TYPE = "button" value = "책 삭제" onClick="javascript:move( './delete.php' );">	
		<BR> <BR> &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
		<BR> <BR>  
<?php 
	// 전달 받은 메시지 확인
	$message =  $_POST['message'];
	$message = ( ( ( $message == null ) || ( $message == "" ) ) ? "_%" : $message );

	// MySQL 드라이버 연결 
	include("./SQLconstants.php"); 
	$conn = mysqli_connect($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database) or die ("Can't access DB");

	// MySQL 검색 실행 및 결과 출력
	$query = "select * from book where title like '%".$message."%';";
	$result = mysqli_query( $conn, $query );
	while( $row = mysqli_fetch_array( $result ) )
	{
		echo "<BR>ID : ".$row['id'];
		echo "<BR>책제목 : ".$row['title'];
		echo "<BR>저자 : ".$row['author'];
		echo "<BR>출판사 : ".$row['publisher'];
		echo "<BR>출판일 : ".$row['date'];
		echo "<BR><img src = '".$row['image']."' height='280' width='180'> <br>";
	}

	// MySQL 드라이버 연결 해제
	mysqli_free_result( $result );
	mysqli_close( $conn );
?>
</body>
</html> 
