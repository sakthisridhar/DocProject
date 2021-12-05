<?php
include_once("db_connect.php");
$sql = "SELECT * FROM docupload where id=".$_GET['id'];
$result = $conn->query($sql);
if (mysqli_num_rows($result) == 0) {
	header("location: index.php");
}
$row = mysqli_fetch_assoc($result);
if($_POST){
	if(isset($_POST['Update']) && $_POST['Update']=='Update'){
		echo $sql = "update docupload set doc_name='".$_POST['doc_name']."',doc_type='".$_POST['doc_type']."',doc_points='".$_POST['points']."',doc_table_size='".$_POST['doc_table_size']."' where id=".$_POST['id'];
		$res = $conn->query($sql);
		header("location: index.php");
	}
}
include_once("header.php");
?>
		<script language="Javascript">
		const points=<?php echo $row['doc_points'] ?>;
		const doctype = <?php echo $row['doc_type'] ?>;
$(document).ready(function(){
			if(doctype == 3){
				$(".tableSize").show();
			}else{
			$(".tableSize").hide();
			}
		$(".docType").change(function(){
			if($(this).val()==3){
				$(".tableSize").show();
			}else{
				$(".tableSize").hide();
			}
		})
		});
					$(function(){
				$('#cropbox').Jcrop({
					onSelect: updateCoords,
					setSelect: [points.x, points.y, points.x2, points.y2],// you have set proper x and y coordinates here
				});

			});
			function updateCoords(c)
			{
				console.log(JSON.stringify(c));
				$("#points").val(JSON.stringify(c));
			};
		</script>
   
<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">
  <h4>Document - Edit</h4>
		<form method="post">
			<input type="hidden" name="id" value="<?php echo $row['id'] ?>"/>
			<textarea type="text" id="points" name="points" style="display:none"><?php echo $row['doc_points'] ?></textarea>
			<div class="mb-3">
			<label class="form-label">Document Name</label>
			<input type="text" class="form-control" name="doc_name" required value="<?php echo $row['doc_name'] ?>"/>
			</div>
			<div class="mb-3">
			<label class="form-label">Document Type</label>
			<select class="form-control docType" name="doc_type" required >
			<option value="0">Select Type</option>
<option <?php echo $row['doc_type'] == 1 ?'selected':''?> value="1">Bar Code</option>
<option <?php echo $row['doc_type'] == 2 ?'selected':''?> value="2">QR Code</option>
<option <?php echo $row['doc_type'] == 3 ?'selected':''?> value="3">Table</option>
			</select>
			</div>
			<div class="mb-3 tableSize">
			<label class="form-label">Document Table Size</label>
			<input type="text" class="form-control" name="doc_table_size" value="<?php echo $row['doc_table_size'] ?>"/>
			</div>
			<div class="mb-3">
			<img src="<?php echo $row['doc_file_name']; ?>" id="cropbox" />
			</div>
			<div class="mb-3">
			<input type="submit" name="Update" class="btn btn-primary" value="Update"/>
			</div>
		</form>
	</div>
</main>
<?php 
include_once("footer.php");
?>
