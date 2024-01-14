<?php

function write_log(){
	$log_dir = '/home/project/PHP/Log';
        /*
        if(!is_dir($log_dir)){
                mkdir($log_dir, 0777, true);
                chmod($log_dir,0777);
                echo "디렉토리 생성!\r\n";
        }
 */
        $id = "";
	$pagename = $_SERVER["PHP_SELF"];

        if($_SESSION['id'] === NULL){
                $id = 'Non-member';
        }else{
                $id = $_SESSION['id'];
        }

        // 시간
        date_default_timezone_set("Asia/Seoul");
        $DateAndTime = date('m-d-Y h:i:s a', time());

        $log_entry = '['.date("Y-m-d H:i:s"). '] ';
        $log_entry .= ' Member : ' . $id;
	$log_entry .= ' | location : ' . $pagename;
	$log_entry .= 'ERROR';


	//$file_name = date('Ymd').".txt";
	$file_name = $id.".txt";
        $log_file = fopen($log_dir."/".$file_name, "a");
        if($log_file){
                fwrite($log_file, $log_entry."\r\n");
                fclose($log_file);
        }else{
                $error = error_get_last();
                echo $error['message'];
                echo "파일을 열 수 없습니다.";
        }
}

write_log();

?>
