<?php
include "simple_html_dom.php";
ini_set("max_execution_time", 300);

$syear = "1031";
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear";//通識
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=CI&sel_type=1";//電通
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=MH&sel_type=1"; //管建
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=MT&sel_type=1"; //材纖必
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=MT&sel_type=2"; //材纖選
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=ME&sel_type=1"; //機械必
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=ME&sel_type=2"; //機械選
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=EE&sel_type=1"; //電機必
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=EE&sel_type=2"; //電機選
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=IM&sel_type=1"; //工管必
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=IM&sel_type=2"; //工管選
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=DN&sel_type=1"; //工設必
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=DN&sel_type=2"; //工設選
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=NS&sel_type=1"; //護理必
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=NS&sel_type=2"; //護理選
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=CE&sel_type=1"; //通訊必
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=CE&sel_type=2"; //通訊選
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=HA&sel_type=1"; //醫管必
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=HA&sel_type=2"; //醫管選
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=MI&sel_type=1"; //資管必
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=MI&sel_type=2"; //資管選
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=MD&sel_type=1"; //行銷必
$url[] = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=$syear&dept_no=MD&sel_type=2"; //行銷選

for($url_array=0;$url_array<count($url);$url_array++){
	parser_script($url[$url_array]);
}


function parser_script($url){
	$cURL = curl_init();
	curl_setopt($cURL, CURLOPT_RETURNTRANSFER,	true);
	//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,	1);
	curl_setopt($cURL, CURLOPT_FRESH_CONNECT,	false);
	curl_setopt($cURL, CURLOPT_DNS_CACHE_TIMEOUT,	360000);
	curl_setopt($cURL, CURLOPT_HTTPAUTH,	CURLAUTH_ANY);
	curl_setopt($cURL, CURLOPT_TIMEOUT,	36000);
	curl_setopt($cURL,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cURL, CURLOPT_URL,	$url);
	$page = curl_exec($cURL); 
	curl_close($cURL); 
	$html = str_get_html($page);
	$data = array();

	foreach ($html->find('tr') as $row) {
		$rowData = array();
		foreach($row->find('td')as $cell){
			$rowData[]= $cell->innertext;
		}
		$theData[] = $rowData;
	}

	for($i=0;$i<count($theData);$i++){
		for($j=0;$j<count($theData[$i]);$j++){
			$theData[$i][$j] = str_replace("<div align=\"center\"><span class=\"contact\">樓館代碼說明 - [第1碼] 1：有庠； 2：誠勤； 3：元智； 5：教學； 6：實習；</span></div>",null, $theData[$i][$j]);
			$theData[$i][$j] = str_replace("<div align=\"center\"><span class=\"contact\">[第2,3碼] 樓層</span></div>",null, $theData[$i][$j]);
			$theData[$i][$j] = str_replace("<div align=\"center\"><span class=\"contact\">[第4,5碼] 教室流水號</span></div>",null, $theData[$i][$j]);
			$theData[$i][$j] = str_replace("<div align=\"center\">        <input name=\"Submit\" type=\"button\" class=\"btm\" onclick=\"MM_callJS('javascript:history.go(-1);')\" value=\"回上一頁\">      </div>",null, $theData[$i][$j]);
			$theData[$i][$j] = strip_tags($theData[$i][$j]);
			$theData[$i][$j] = trim($theData[$i][$j]);
			
	 	}
	}
	//有bug
	for($i=0;$i<count($theData);$i++){
		for($j=0;$j<count($theData[$i]);$j++){
			if(empty($theData[$i][$j])){
				//echo "第$i $j 項刪除<br />\n";
				unset($theData[$i][$j]);
			 }
	 }
		}
		$theData = array_values($theData);
	for($i=0;$i<count($theData);$i++){
		if(empty($theData[$i])){
			 	//echo "第 $i 項刪除<br />\n";
				unset($theData[$i]);
			 }
		}

	$cos_array[] = array();
	for($i=1;$i<=count($theData);$i++){

		@$cos_array[$i]['syear'] = $theData[$i][0];
		@$cos_array[$i]['cos_dept'] = $theData[$i][1];
		@$cos_array[$i]['cos_num'] = $theData[$i][2];
		@$cos_array[$i]['cos_title'] = $theData[$i][3];
		@$cos_array[$i]['cos_require'] = $theData[$i][4];
		@$cos_array[$i]['cos_credit'] = $theData[$i][6];
		@$cos_array[$i]['cos_hours'] = $theData[$i][7];
		@$cos_array[$i]['cos_teacher'] = $theData[$i][8];
		@$cos_array[$i]['cos_room'] = $theData[$i][12];
		@$cos_array[$i]['cos_time'] = $theData[$i][13];
		@$tmp_array[$i] = explode(' ', $cos_array[$i]['cos_dept']);
		@$cos_array[$i]['cos_dept'] = $tmp_array[$i][0];
		@$cos_array[$i]['cos_year'] = $tmp_array[$i][1];
	}
	//print_r($cos_array);
	$dbserver = "localhost";
	$dbname = "oit";
	$dbuser = "root";
	$dbpassword = "";

	if(!@mysql_connect($dbserver,$dbuser,$dbpassword))
		die("無法連線伺服器");
	$db = mysql_select_db($dbname);
	mysql_query("SET NAMES utf8");
	for($i=1;$i<count($cos_array);$i++)
	{
		$sql="Insert Into course (syear,cos_dept,cos_num,cos_title,cos_require,cos_credit,cos_hours,cos_teacher,cos_room,cos_time,cos_year) values ('".$cos_array[$i]['syear']."','".$cos_array[$i]['cos_dept']."','".$cos_array[$i]['cos_num']."','".$cos_array[$i]['cos_title']."','".$cos_array[$i]['cos_require']."','".$cos_array[$i]['cos_credit']."','".$cos_array[$i]['cos_hours']."','".$cos_array[$i]['cos_teacher']."','".$cos_array[$i]['cos_room']."','".$cos_array[$i]['cos_time']."','".$cos_array[$i]['cos_year']."');";
		mysql_query($sql);
		echo $cos_array[$i]['cos_dept'].",".$cos_array[$i]['cos_year'].",".$cos_array[$i]['cos_num'].",".$cos_array[$i]['cos_title']."<b>INSERT.</b><br />";

	}
	return true;
}
?>
