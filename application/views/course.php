<?php include("header.php"); ?>
<?php include("nav.php");?>
<div class="container" style="padding-top:60px;">
<form>
	<select>
		<option value="">選擇學期年</option>
		<?php for($i=0;$i<count($syear);$i++) { ?>
		<option value="<?=$syear[$i]['syear']; ?>"><?=$syear[$i]['syear']; ?></option>
		<?php } ?>
	</select>
	<select>

		<option value="">所有系級</option>
		<?php for($i=0;$i<count($search_dept);$i++) { ?>
		<option value="<?=$search_dept[$i]['cos_dept']; ?>"><?=$search_dept[$i]['cos_dept']; ?></option>
		<?php } ?>
		
	</select>
	<select>
		<option>必/選修</option>
		<?php for($i=0;$i<count($search_require);$i++) { ?>
		<option value="<?=$search_require[$i]['cos_require']; ?>"><?=$search_require[$i]['cos_require']; ?></option>
		<?php } ?>
	</select>
	
	<button type="submit" class="btn btn-default">搜尋</button> </form>

	<table class="table table-striped table table-hover">
		<thead>
		<tr>
			<th>學年</th>
			<th>代號</th>
			<th>系級</th>
			<th>課名</th>
			<th>老師</th>
			<th>必/選修</th>
			<th>時間</th>
			<th>學分</th>
			<th>評等</th>

		</tr>
		</thead>
		  <tbody>
		<?php  foreach ($query as $row):?>
		<tr>
			<td><?php echo $row['syear']; ?></td>
			<td><?php echo $row['cos_num']; ?></td>
			<td><?php echo $row['cos_dept']; ?></td>
			<td><a href="<?php echo site_url('course/view')."/".$row['course_id']; ?>"><?php echo $row['cos_title']; ?><a></td>
			<td><?php echo $row['cos_teacher']; ?></td>
			<td><?php echo $row['cos_time']; ?>
			<td><?php echo $row['cos_require']; ?></td>
			<td><?php echo $row['cos_credit']; ?></td>
			<td>0</td>


		</tr>
		<?php endforeach ?>
		</tbody>
	</table>
	<div class="pagination pagination-large pagination-centered">
	<?= $this->pagination->create_links(); ?>
	</div>
	共 <?=count($query);?> 筆符合的課程
</div>
<?php include("footer.php"); ?>