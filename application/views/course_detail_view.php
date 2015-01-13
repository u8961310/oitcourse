<?php include("header.php"); ?>
<?php include("nav.php");?>


<div class="container-fluid" style="padding-top:60px;">
<h1 class="page-header"> <?=htmlspecialchars($course->cos_title)?> </h1>
	<div class="row-fluid">
		<div class="span2">
		<h4 class="page-header">課程資訊</h4>

		學年:<?=htmlspecialchars($course->syear)?><br />
		系級:<?=htmlspecialchars($course->cos_dept)?><br />
		代碼：<?=htmlspecialchars($course->cos_num)?><br />
		學分：<?=htmlspecialchars($course->cos_credit)?><br />
		必選修:<?=htmlspecialchars($course->cos_require)?><br />
		上課時間：<?=htmlspecialchars($course->cos_time)?><br />
		上課地點：<?=htmlspecialchars($course->cos_room)?><br />
		教師：<?=htmlspecialchars($course->cos_teacher)?><br />
		</div>
	
		<div class="span10">
			<h4 class="page-header">預覽課表</h4>
			<table class="table table-striped table table-hover">

<?php  
//trim
$time = $course->cos_time;
$time_array = explode(",", $time);
for($i=0;$i<count($time_array);$i++){
	$time_array[$i] = explode("0", $time_array[$i]);
}

$week[1][0] = "<b>一</b>";
$week[2][0] = "<b>二</b>";
$week[3][0] = "<b>三</b>";
$week[4][0] = "<b>四</b>";
$week[5][0] = "<b>五</b>";

$p[0][1] = "<b>第一節</b>";
$p[0][2] = "<b>第二節</b>";
$p[0][3] = "<b>第三節</b>";
$p[0][4] = "<b>第四節</b>";
$p[0][5] = "<b>第五節</b>";
$p[0][6] = "<b>第六節</b>";
$p[0][7] = "<b>第七節</b>";
$p[0][8] = "<b>第八節</b>";
$p[0][9] = "<b>第九節</b>";


//print_r($time_array);
//寫法不好 要在改寫 table view
for($i=0;$i<count($time_array);$i++){
		 $week_var[$i] = $time_array[$i][0];
		 $time_var[$i] = $time_array[$i][1];
		 $view_course[$week_var[$i]][$time_var[$i]] = $course->cos_title;
}
//print_r($week_var);
//print_r($time_var);

for($i=0;$i<10;$i++){
	echo "<tr>\n";
	for($j=0;$j<8;$j++){
		echo "<td>\n";
		if(isset($week[$j][$i])){
			echo $week[$j][$i]."\n";
		}
		else
		{
			echo "&nbsp;";
		}
		if(isset($p[$j][$i])){
			echo $p[$j][$i];

		}
		else
		{
			echo "&nbsp;";
		}
		if(isset($view_course[$j][$i])){
			echo $view_course[$j][$i];
		}
		else
		{
			echo "&nbsp;";
		}
		echo "</td>\n";
	}
	echo "</tr>\n";
}


?>
</table>

		</div>


	</div>
</div>