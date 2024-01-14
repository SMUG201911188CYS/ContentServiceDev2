<?php 

session_start();
include("./SQLconstants.php");
$conn = mysqli_connect($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database) or die ("Can't access DB");

if (isset($_POST['id']) && isset($_POST['password']) 
	&& isset($_POST['phnum']) && isset($_POST['re_password'])) {

	$uname =  $_POST['id'];
	$pass =  $_POST['password'];
	$re_pass =  $_POST['re_password'];
	$ph = $_POST['phnum'];
	$fp =  $_POST['favorite_p'];
	$fs =  $_POST['favorite_s'];

	if (empty($uname)) {
		echo "<script>alert('ID를 입력해주세요.');</script>";
		echo "<script>location.replace('join_the_membership.php')</script>";
		include("./writeErrorLog.php");
		exit();
	}else if(empty($pass)){
		echo "<script>alert('비밀번호를 입력해주세요.');</script>";
		echo "<script>location.replace('join_the_membership.php')</script>";
		include("./writeErrorLog.php");
		exit();
	}
	else if(empty($re_pass)){
		echo "<script>alert('비밀번호 재확인을 입력해주세요.');</script>";
		echo "<script>location.replace('join_the_membership.php')</script>";
		include("./writeErrorLog.php");
		exit();
	}

	else if(empty($ph)){
		echo "<script>alert('번호를 입력해주세요.');</script>";
		echo "<script>location.replace('join_the_membership.php')</script>";
		include("./writeErrorLog.php");
		exit();
	}

	else if($pass !== $re_pass){
		echo "<script>alert('비밀번호가 다릅니다.');</script>";
		echo "<script>location.replace('join_the_membership.php')</script>";
		include("./writeErrorLog.php");
		exit();

	}
	
	else if($fp === ""){
		echo "<script>alert('선호 편의점을 선택해주세요.');</script>";
		echo "<script>location.replace('join_the_membership.php')</script>";
		include("./writeErrorLog.php");
		exit();
	}
	
	else if($fs === ""){
		echo "<script>alert('선호 종류를 선택해주세요.');</script>";
		echo "<script>location.replace('join_the_membership.php')</script>";
		include("./writeErrorLog.php");
		exit();

	}
	 

	$sql = "SELECT * FROM member WHERE ph  = '$ph'";
	$result = mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($result)>0){
		echo "<script>alert('이미 가입한 아이디가 있습니다.');</script>";
		echo "<script>location.replace('join_the_membership.php')</script>";
		include("./writeErrorLog.php");
		exit();
	}
	
	else{
		$sql2 = "INSERT INTO member(id, password, ph, fp, fs) VALUES ('$uname', '$pass', '$ph', '$fp', '$fs')";
		echo $sql2;
		$result2 = mysqli_query($conn, $sql2);
		echo mysqli_error($conn);
		if($result2){
			echo "<script>alert('회원 가입 완료.');</script>";
			echo "<script>location.replace('login_test.php')</script>";
			include("./writeLog.php");
			exit();
		}else{
			echo "<script>alert('이미 가입된 아이디가 있습니다.');</script>";
			echo "<script>location.replace('join_the_membership.php')</script>";
			exit();
		}
	}
	 

}

?>
