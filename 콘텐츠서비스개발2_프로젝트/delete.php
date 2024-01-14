<?php 
	header('Content-Type: text/html; charset=UTF-8');
?>
<HTML>
	<BODY>
		<BR> 
		<!-- 화면구성 -->
		<form name = "formm" method = "post" action = "./deleteSQL.php">				
			&nbsp; &nbsp; &nbsp; 
			삭제할 책 ID : <INPUT TYPE="text" NAME="id" SIZE="60"> 
		</form>  
		 &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  
		 <INPUT TYPE="button" value="삭제" onClick="javascript:document.formm.submit();"> &nbsp; 
		<BR><BR>  

<?php 
	// MySQL 드라이버 연결 
	include("./SQLconstants.php"); 
	$conn = mysqli_connect($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database) or die ("Can't access DB");

	// MySQL 검색 실행 및 결과 출력
	$query = "select * from book;";
	$result = mysqli_query($conn,$query);
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
	</BODY>
</HTML>
 