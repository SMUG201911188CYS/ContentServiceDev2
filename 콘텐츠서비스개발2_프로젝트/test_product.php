        <?php
	        $num = 0;
	        $search = $_GET['search'];
		        $plus = $_GET['plus'];
		        $type = $_GET['type'];
			        $price = $_GET['price'];

        include("./SQLconstants.php");
        $conn = mysqli_connect($mySQL_host,$mySQL_id,$mySQL_password,$mySQL_database) or die ("Can't access DB");

        //MySQL 검색 실행 및 결과 출력
$query = "select distinct sale_product.convenience, product.name, product.price, sale_product.event_type, sale_product.event_info, product.image, product.id, product.type FROM sale_product, product where product.name like '%".$search."%';";
$query2 = "select count(*) from (select distinct sale_product.convenience, product.name, product.price, sale_product.event_type, sale_product.event_info, product.image, product.id, product.type FROM sale_product, product where product.name like '%".$search."%') as A";
AND sale_product.id = product.id AND sale_product.sale_type LIKE '%".$plus."%' AND product.type LIKE '%".$type."%';;
$result = mysqli_query( $conn, $query );
$count_result = mysqli_query($conn, $query2);
$count = mysqli_fetch_array( $count_result); 
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
<div class="header">
<h2 id="small_title" onClick="location.href='pyony.html'">편띵</h2>
<div class="pyony_gather">
<h3 class="header_element" id="CU">CU</h3>
<h3 class="header_element" id="GS25">GS25</h3>
<h3 class="header_element" id="seven-ELEVEn">7-ELEVEn</h3>
<h3 class="header_element" id="MINISTOP">MINISTOP</h3>
<h3 class="header_element" id="emart24">emart24</h3>
</div>
<button class="button_login" onClick="location.href='pyony_login.html'">로그인</button>
</div>

<div class="p_comment">
<div class="CU_product">
<h2>CU 할인 상품</h2>
<div class="CU_gather">
<div class="menu_cu">
<small class="cu_pn_name">CU
<span class="Product_name">과자</span>
</small>
<div class="menu_cu2">
<div class="pn_img">
<?php
 //GET 파라미터에서 상품 ID 값 추출
 $productId = $_GET['id'];
 // 데이터베이스에서 해당 상품의 이미지 URL 가져오기
 // 이 부분은 데이터베이스 연결 및 쿼리 실행 로직이 들어가야 합니다.
 $imageURL = '상품의_이미지_파일_경로_또는_이미지_주소';

 // 이미지 출력
 echo '<img src="' . $imageURL . '" alt="Product Image">';
 ?>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </body>
 </html>

