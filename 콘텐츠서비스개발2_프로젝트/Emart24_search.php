<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>EMART24 상품 모음</title>
	<link rel="stylesheet" href="pyonystyle.css">
</head>
<body>
    <div class = "header">
        <h2 id = "small_title" onClick = "location.href='pyony.php'">편띵</h2>
        <div class = "pyony_gather">
            <h3 class = "header_element" onClick = "location.href='CU_search.php'" id = "CU"onmouseover="this.style.cursor='pointer'" >CU</h3>
            <h3 class = "header_element" onClick = "location.href='GS_search.php'" id = "GS25"onmouseover="this.style.cursor='pointer'" >GS25</h3>
	    <h3 class = "header_element" onClick = "location.href='Seven_search.php'" id = "seven-ELEVEn"onmouseover="this.style.cursor='pointer'" >7-ELEVEn</h3>
            <h3 class = "header_element" onClick = "location.href='Ministop_search.php'" id = "MINISTOP"onmouseover="this.style.cursor='pointer'" >MINISTOP</h3>
            <h3 class = "header_element" onClick = "location.href='Emart24_search.php'" id = "emart24"onmouseover="this.style.cursor='pointer'" >emart24</h3>
	</div>
		<?php if($_SESSION['id'] === NULL && $_SESSION['password'] === NULL){ ?>
		<button class = "button_login" onClick = "location.href ='login_test.php'">로그인</button>
	<?php }else {
	$isLogin = true;
	$id = $_SESSION['id'];
	$password = $_SESSION['password'];
		?>
		<form action = "logout.php" method="post">
		<button class = "button_login">로그아웃</button>
		</form>
	<?php } ?>
	</div>


	<h1>편   띵</h1>

	<div class = "input-group">
		<form action = "Emart24_search.php" method = "get">
			<input type = "text" name = "search" placeholder="상품명 검색" class = "search">
			<button id = "submit"onmouseover="this.style.cursor='pointer'" >검색</button><br>
			<select name = "plus">
				<option value = "">행사-전체</option>
				<option value = "1+1">1+1</option>
				<option value = "2+1">2+1</option>
				<option value = "3+1">3+1</option>
			</select>
			<select name = "type">
				<option value = "">분류-전체</option>
				<option value = "음료">음료</option>
				<option value = "과자">과자류</option>
				<option value = "식품">식품</option>
				<option value = "아이스크림">아이스크림</option>
				<option value = "생활용품">생활용품</option>
			</select>
			<select name = "price">
				<option value = "ASC">정렬- 기본</option>
				<option value = "ASC">낮은 가격순</option>
				<option value = "DESC">높은 가격순</option>
			</select>
		</form>
		</div>

		<?php
		$search = $_GET['search'];
		$plus = $_GET['plus'];
		$type = $_GET['type'];
		$price = $_GET['price'];

		include("./SQLconstants.php");
		$conn = mysqli_connect($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database) or die ("Can't access DB");

	// MySQL 검색 실행 및 결과 출력
		$query = "select distinct sale_product.convenience, product.name, product.price, sale_product.event_type, sale_product.event_info, product.image, product.id, product.type FROM sale_product, product where sale_product.id = product.id AND product.name like '%".$search."%' AND sale_product.event_type LIKE '%".$plus."%' AND product.type LIKE '%".$type."%' AND sale_product.convenience = 'emart24' order by CONVERT(product.price, signed) ".$price.";";

		//$query2 = "select count(*) from (select distinct sale_product.convenience, product.name, product.price, sale_product.event_type, sale_product.event_info, product.image, product.id, product.type FROM sale_product, product where sale_product.id = product.id AND product.name like '%".$search."%') as A";


	//AND sale_product.id = product.id AND sale_product.sale_type LIKE '%".$plus."%' AND product.type LIKE '%".$type."%';";

		$result = mysqli_query( $conn, $query );
		//$count_result = mysqli_query($conn, $query2);
		//$count = mysqli_fetch_array( $count_result);

		while($row = mysqli_fetch_array($result)) {
			$count= 0;
		?>

		<br><br><div class = "GS_gather">
			<?php
				do {
					$count = $count + 1;
			?>
			<div class = "menu_gs">
				<small class ="emart24_pn_name"><?php echo $row["convenience"]; ?>
				<span class = "Product_name"><?php echo $row["type"]; ?></span>
			</small>
			<div class = "menu_gs2">
			<div class ="pn_img"> <a href="product_information.php?id=<?php echo $row['id']; ?>">
                        <img src="<?php echo $row['image']; ?>" class = image_size>
                        </a>
			</div>
			<div class ="pn_information">
				<?php
				echo "<BR>이름 : ".$row["name"]."<br>"; 
				echo "<BR>가격 : ".$row["price"]."<br>";
				echo "<BR>행사정보 : ".$row["event_type"]."<br>";
							 	//echo "<BR>할인정보 : ".$row["event_info"];
				?>
			</div>
			</div>
			</div>
			<?php 
				if($count == 5) break;
			}while($row = mysqli_fetch_array($result)) ?>
			</div>
		<?php } ?>


<?php
include("./writeLog.php");    
mysqli_free_result($result);
mysqli_close($conn);
?>

</body>
</html>
