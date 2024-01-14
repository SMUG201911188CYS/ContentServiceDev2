<?php
session_start();
include("./SQLconstants.php");
$conn = mysqli_connect($mySQL_host, $mySQL_id, $mySQL_password, $mySQL_database) or die ("Cant't access DB");
$isLogin = false;
if($_SESSION['id'] === NULL && $_SESSION['password'] === NULL){
	$isLogin = false;
}else{
	$isLogin = true;
	$id = $_SESSION['id'];
	$password = $_SESSION['password'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>편 띵</title>
    <link rel="stylesheet" href="pyonystyle.css">
</head>
<body>
    <div class = "header">
        <h2 id = "small_title" onClick = "location.href='pyony.php'">편띵</h2>
	<div class = "pyony_gather">
            <h3 class="header_element" onClick="location.href='CU_search.php'" id="CU" onmouseover="this.style.cursor='pointer'">CU</h3>
            <h3 class = "header_element" onClick = "location.href='GS_search.php'" id = "GS25"onmouseover="this.style.cursor='pointer'" >GS25</h3>
	    <h3 class = "header_element" onClick = "location.href='Seven_search.php'" id = "seven-ELEVEn"onmouseover="this.style.cursor='pointer'" >7-ELEVEn</h3>
            <h3 class = "header_element" onClick = "location.href='Ministop_search.php'" id = "MINISTOP"onmouseover="this.style.cursor='pointer'" >MINISTOP</h3>
            <h3 class = "header_element" onClick = "location.href='Emart24_search.php'" id = "emart24"onmouseover="this.style.cursor='pointer'" >emart24</h3>
	</div>

	<?php if($isLogin === false){ ?> <!--//$_SESSION['id'] === NULL && $_SESSION['password'] === NULL){ ?> -->
		<button class = "button_login" onClick = "location.href ='login_test.php'">로그인</button>
	<?php }else {
		?>
		<button class = "button_login" onClick = "location.href = 'logout.php'">로그아웃</button>
		</form>
	<?php } ?>
	

    </div>
    
    <h1>편   띵</h1>

    <div class = "input-group">
	    <form action = "Main_search.php" method = "get">
		    <input type = "text" name = "search" placeholder="상품명 검색" class = "search">
		    <button id = "submit"onmouseover="this.style.cursor='pointer'" >검색</button>
	    </form>
    </div>

<?php
	$sql = "SELECT * FROM member WHERE id = '$id' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	echo mysqli_error($conn);
	$fp = $row['fp'];
	$fs = $row['fs'];
	
	if($isLogin){
		$sql2 = "SELECT sale_product.convenience, sale_product.id, sale_product.event_type, product.name, product.price, product.image, product.type FROM product, sale_product WHERE product.id = sale_product.id AND product.type = '$fs' AND sale_product.convenience = '$fp'";
	}else{
		$sql2 = "SELECT sale_product.convenience,sale_product.id ,sale_product.event_type, product.name, product.price, product.image, product.type FROM product, sale_product WHERE product.id = sale_product.id order by sale_product.convenience ASC";
	}
	$result2 = mysqli_query($conn, $sql2);
	while($row2 = mysqli_fetch_array($result2)){
		$count = 0;
	?>
		<div class = "CU_gather">
	<?php 
		do{ 
			$count = $count + 1;
			$name = $row2['convenience'];
			$pnname = "";
			// CU 박스 출력
			if($name === 'CU'){
				$pnname = 'cu_pn_name';
			// GS25 박스
			}else if($name === 'GS25'){
				$pnname = 'gs_pn_name';
			// 7eleven
			}else if($name === '7-ELEVEn'){
				$pnname = 'seleven_pn_name';
			// MINISTOP
			}else if($name === 'MINISTOP'){
				$pnname = 'ministop_pn_name';
			// emart24
			}else if($name === 'emart24'){
				$pnname = 'emart24_pn_name';
			}
?>
			
			<div class = "menu_cu">
				<small class = <?php echo $pnname; ?>> <?php echo $row2['convenience'] ?>
                                        <span class = "Product_name"><?php echo $row2['type'] ?> </span>
                                </small>


			
	 	   	<div class = "menu_cu2">
			<div class ="pn_img">
                        <a href="product_information.php?id=<?php echo $row2['id']; ?>">
                        <img src="<?php echo $row2['image']; ?>" class = image_size>
                        </a></div>
			<div class ="pn_information">

				<?php echo "<BR>이름 : ".$row2['name']."<br>";
					echo "<BR>가격 : ".$row2['price']."<br>";
					echo "<BR>행사정보 : ".$row2['event_type']."<br>";
				?>
			</div>
		    </div>
		</div>
	<?php
			if($count == 5) break; 
		}while($row2 = mysqli_fetch_array($result2))?>
	     </div>
<?php } ?>

<?php
			include("./writeLog.php");
?>
    
</body>
</html>
