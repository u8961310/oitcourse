<?php
include "simple_html_dom.php";
//$url = 'http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=1031';
$url = 'http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=1031&dept_no=MI&sel_type=1';
$cURL = curl_init();
curl_setopt($cURL, CURLOPT_URL, $url); 
curl_setopt($cURL, CURLOPT_HEADER,0); 

curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($cURL, CURLOPT_COOKIESESSION, true); 
curl_setopt($cURL, CURLOPT_FOLLOWLOCATION, 1); 
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
		 	echo "第 $i 項刪除<br />\n";
			unset($theData[$i]);
		 }
	}

print_r($theData );

?>
