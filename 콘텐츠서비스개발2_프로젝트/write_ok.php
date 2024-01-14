<?php
header('Content-Type: text/html; charset=UTF-8');

session_start();

$comment_content = $_POST['comment_content'];
$message = "";

//MySQL 드라이버 연결 
include("./SQLconstants.php");
$conn = mysqli_connect( $mySQL_host, $mySQL_id, $mySQL_password, $mySQL_database ) or die( "Can't access DB" );

// comment_id 가져와서 확인
$query = "SELECT comment_id FROM comment ORDER BY CONVERT(comment_id, signed) DESC limit 1;";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

// MySQL 책 추가 실행 	
$comment_id = intval($row[0] + 1);
$member_id = $_SESSION['id'];
$product_id = $_SESSION['product_id'];
$dt = $_SESSION['DateAndTime'];
$query = "INSERT INTO comment( comment_id, comment_content, date, member_id, product_id) VALUES ( '$comment_id', '$comment_content', '$dt', '$member_id', '$product_id');";
echo $query;
echo mysqli_query( $conn, $query );


// MySQL 드라이버 연결 해제
mysqli_free_result( $result );
mysqli_close( $conn );
?>

<?php
$_SESSION['message'] = $product_id."||".$comment_content;
include("./writeLog.php");
$_SESSION['message'] = "";
$prevPage = $_SERVER['HTTP_REFERER'];
header('location:'.$prevPage);
?>
