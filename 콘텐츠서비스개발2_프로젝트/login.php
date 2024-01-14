<?php 
session_start(); 
include("./SQLconstants.php"); 
$conn = mysqli_connect($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database) or die ("Can't access DB");


if (isset($_POST['id']) && isset($_POST['password'])) {
	
	// 입력한 id pw 저장
	$uname = $_POST['id'];
	$pass = $_POST['password'];

	$sql = "SELECT * FROM member WHERE id ='$uname' AND password='$pass'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);

	echo mysqli_error($conn);
	
	if ($row['id'] === $uname && $row['password'] === $pass) {
		$_SESSION['id'] = $row['id'];
		$_SESSION['password'] = $row['password'];
		echo "<script>alert('로그인');</script>"; 
		//echo $_SESSION['prevPage'];
		//header('location:'.$_SESSION['prevPage'];
		//echo "<script>location.replace('pyony.php')</script>";
		$prevPage = $_SESSION['prevPage'];
		$pagename =  basename($prevPage);
		
		if($pagename = 'login.php' || $pagename = 'join_the_membership.php'){
			echo "<script>location.replace('pyony.php')</script>";
		}
		else{
			echo "<script>location.replace('$prevPage')</script>";
		}

		include("./writeLog.php");
		exit();

	}else{
		echo "<script>alert('로그인 실패');</script>";
		echo "<script>location.replace('login_test.php')</script>";
		include("./writeErrorLog.php");
		exit();
	}
	 
}
?>
