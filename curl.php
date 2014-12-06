<?php
include("lib/LIB_http.php");
include("lib/LIB_parse.php");
$course_array = array();
$course_count = 0;
//$syear = '1031'; //學期
$target = "http://info.oit.edu.tw/cosinfo/cos/show_cos_info.asp?mSmtr=1031&dept_no=MI&sel_type=1";
$web_page = http_get($target,"");
$table_array = parse_array($web_page["FILE"],"<table","</table>");
// for($xx=0;$xx<count($table_array);$xx++){
	
// }
$course_row_array = parse_array($table_array[0],"<tr ","</tr>");
//print_r($course_row_array[0]);
print_r($course_row_array[1]);
//echo stristr($course_row_array[1], "學期");
echo stristr($course_row_array[1], "1031");
//print_r($course_row_array);
for($table_row=0;$table_row<count($course_row_array);$table_row++){
	
	$heading_landmark = "開課系所";
	if(stristr($course_row_array[$table_row],"學期")){
		echo "FOUND:Table heading row\n";
		$table_cell_array = parse_array($course_row_array[$table_row],"<td","</td>");
		for($heading_cell=0;$heading_cell < count($table_cell_array); $heading_cell++){
			if(stristr(strip_tags(trim($table_cell_array[$heading_cell])),"開課系所"))
				$syear_coumn = $heading_cell;
			if(stristr(strip_tags(trim($table_cell_array[$heading_cell])),"課目代號"))
 				$course_id_coumn = $heading_cell;

		}
		

		$heading_row = $table_row;

		$ending_landmark = "樓館代碼說明 - [第1碼] 1：有庠； 2：誠勤； 3：元智； 5：教學； 6：實習；";
		if((stristr($course_row_array[$table_row],$ending_landmark))){
			echo "PARSING COMPLETE\n";
			break;
		}
		if(isset($heading_row) && $heading_row<$table_row){
			$table_cell_array = parse_array($course_row_array[$table_row],"<td","</td>");
			$course_array[$course_count]['syear']  = strip_tags(trim($table_cell_array[$syear_coumn]));

			$course_count++;
			echo "Item Count $course_count\n";
		}
		for($xx=0;$xx<count($course_array);$xx++){
			echo "$xx. ";
			echo "syear:".$course_array[$course_count]['syear'];
		}

	}
	//print_r($course_row_array);
}



?>
