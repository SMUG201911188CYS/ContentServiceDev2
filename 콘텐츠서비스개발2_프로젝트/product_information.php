<?php

session_start();
include("./SQLconstants.php");
$conn = mysqli_connect($mySQL_host, $mySQL_id, $mySQL_password, $mySQL_database) or die ("Cant't access DB");

$isLogin = false;
$name = "";
$password = "";
if($_SESSION['id'] === NULL && $_SESSION['password'] === NULL){	
	$isLogin = false;
}
else{
	$isLogin = true;
	$name = $_SESSION['id'];
	$password = $_SESSION['password'];
}


if($isLogin){
	//시간 정보 저장
	date_default_timezone_set("Asia/Seoul");
	$DateAndTime = date('m-d-Y h:i:s a', time());
	$_SESSION['DateAndTime'] = $DateAndTime;

	$_SESSION['product_id'] = $_GET['id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>편 띵</title>
    <link rel="stylesheet" href="p_informationstyle.css">
</head>
<body>
    <?php
$id = $_GET['id']; // 주소에서 id 값을 가져옴

$sql = "SELECT * FROM product WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo mysqli_error($conn);

$sql2 = "SELECT sale_product.convenience, sale_product.event_type, product.name, product.price, product.image, product.type FROM product, sale_product WHERE product.id = '$id' AND sale_product.id = '$id'";
$result2 = mysqli_query($conn, $sql2);
$row = mysqli_fetch_assoc($result2);
?>
<div class = "header">
    <h2 id = "small_title" onClick = "location.href='pyony.php'">편띵</h2>
    <div class = "pyony_gather">
       <h3 class = "header_element" onClick = "location.href='CU_search.php'" id = "CU"onmouseover="this.style.cursor='pointer'">CU</h3>
       <h3 class = "header_element" onClick = "location.href='GS_search.php'" id = "GS25" onmouseover="this.style.cursor='pointer'">GS25</h3>
       <h3 class = "header_element" onClick = "location.href='Seven_search.php'" id = "seven-ELEVEn"onmouseover="this.style.cursor='pointer'" >7-ELEVEn</h3>
       <h3 class = "header_element" onClick = "location.href='Ministop_search.php'" id = "MINISTOP" onmouseover="this.style.cursor='pointer'">MINISTOP</h3>
       <h3 class = "header_element" onClick = "location.href='Emart24_search.php'" id = "emart24"onmouseover="this.style.cursor='pointer'" >emart24</h3>
   </div>
   <?php

   if($isLogin === false){
    ?>
    <button class = "button_login" onClick = "location.href ='login_test.php'">로그인</button>
    <?php
}else{
  ?>	
  <form action = "logout.php" method="post">
    <button class = "button_login">로그아웃</button>
</form>
<?php
}

?>

</div>

<div class = "p_comment">
    <div class = "CU_product">
        <h2>할인 상품</h2>
        <div class = "CU_gather">
            <div class = "menu_cu">

              <?php


              $name = $row['convenience'];
              $pnname = "";

              if($name === 'CU'){
               $pnname = 'cu_pn_name';
           }else if($name === 'GS25'){
            $pnname = 'gs_pn_name';

        }else if($name === '7-ELEVEn'){
            $pnname = 'seleven_pn_name';

        }else if($name === 'MINISTOP'){
            $pnname = 'ministop_pn_name';

        }else if($name === 'emart24'){
            $pnname = 'emart24_pn_name';
        }
        ?>

        <div class = "menu_cu">
            <small class = <?php echo $pnname; ?>> <?php echo $row['convenience'] ?>
            <span class = "Product_name"><?php echo $row['type'] ?> </span>
        </small>

        <div class = "menu_cu2">
            <div class ="pn_img"><img src="<?php echo $row['image']; ?>" height='290' width='295'>
                <?php   echo "<BR>이름 : ".$row['name']."<br>";
                echo "<BR>가격 : ".$row['price']."<br>";
                echo "<BR>행사정보 : ".$row['event_type']."<br><br>"; ?>
            </div>
        </div>
    </div>
</div>
</div>

<?php 
$comment = "select comment.comment_id, comment.member_id, comment.comment_content, comment.date from comment where comment.product_id like ".$id." order by CONVERT(comment.comment_id, signed) DESC;";
$commentResult = mysqli_query($conn, $comment);
?>

<div class = "comment">
    <h2>댓글</h2>
    <div class = "comment_write">
        <?php

        if ($isLogin === false)
        {
         echo "<form style = 'text-align:center;'>";
                echo "<input type = 'text' class ='write' placeholder = '로그인 후 입력 가능합니다' maxlength=30 disabled style = 'text-align :center;'>";
            echo "</form>";
        }
        else
        {
        echo "<form style = 'text-align:center;' action = 'write_ok.php', method = 'post'>";
            echo "<input type = 'text' name = 'comment_content'  class ='write' placeholder = '댓글을 입력해주세요.' maxlength=30 required = requried style = 'text-align :center;'>";
            echo "<button id = 'submit'>작성</button><br>";
        echo "</form>";
        }

        ?>
    </div>
    <div class = "User_comment_gather">
        <?php
        while($commentRow = mysqli_fetch_array($commentResult))
        {
            ?>
            <div class = "user_comment">
                <div class = "user">
                    <small class="comment_pn_name" style="text-align: left;">
                    <span >
                        <?php 
                        echo $commentRow["member_id"];
                        ?>
                    </span>
                    </small>
                    <small class="comment_pn_name" style="text-align: right;">
                    <span>
                        <?php echo $commentRow["date"];?>
                    </span>
                    </small>
                </div>
            <div class = "comment_detail"><?php echo $commentRow["comment_content"]?></div>
        </div>
    <?php }?>
</div>
</div>
<script>
    function btn() {
        alert("로그인 후 작성 가능합니다")
    }
</script>
</body>
</html>
