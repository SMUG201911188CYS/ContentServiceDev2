<?php
	session_start();
	$_SESSION['prevPage'] = $_SERVER['HTTP_REFERER'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login_style.css">
</head>
<body>
    <div class = "login_screen">
        <div class = "header">
            <h2 id = "small_title" onClick = "location.href='pyony.php'">편띵</h2>
            <div class = "pyony_gather">
                <h3 class = "header_element" onClick = "location.href='CU_search.php'" id = "CU"onmouseover="this.style.cursor='pointer'" >CU</h3>
            <h3 class = "header_element" onClick = "location.href='GS_search.php'" id = "GS25"onmouseover="this.style.cursor='pointer'" >GS25</h3>
            <h3 class = "header_element" onClick = "location.href='Seven_search.php'" id = "seven-ELEVEn"onmouseover="this.style.cursor='pointer'" >7-ELEVEn</h3>
            <h3 class = "header_element" onClick = "location.href='Ministop_search.php'" id = "MINISTOP"onmouseover="this.style.cursor='pointer'" >MINISTOP</h3>
            <h3 class = "header_element" onClick = "location.href='Emart24_search.php'" id = "emart24"onmouseover="this.style.cursor='pointer'" >emart24</h3>

            </div>
            <div></div>
        </div>

	<!-- 로그인 하는 곳 -->
        <div class = "login_form">
            <form action = "login.php" method="post">
                <input type = "text" name = "id" class = "login_element" placeholder="아이디">
                <input type = "password" name = "password" class = "login_element" placeholder="비밀번호">
                <input type = "submit" value = "로그인" class = "login_btn" onmouseover="this.style.cursor='pointer'" >
                <input type = "button" value = "회원가입" class = "join_btn" onClick = "location.href ='join_the_membership.php'" onmouseover="this.style.cursor='pointer'"  >
            </form>
            <div class="links">
                <a href="#">비밀번호를 잊어버리셨나요?</a>
            </div>
        </div>
    </div>
    
</body>
</html>

<?php
include("./writeLog.php");
?>
