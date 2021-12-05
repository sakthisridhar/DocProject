<?php
include_once("db_connect.php");

$target_file='';
$id='';
if($_POST){
	if(!empty($_FILES['doc_file'])){
		$target_dir = "demo_files/";
		$target_file = $target_dir . basename(time().$_FILES["doc_file"]["name"]);
		move_uploaded_file($_FILES["doc_file"]["tmp_name"], $target_file);
		$sql = "INSERT INTO docupload (doc_file_name) VALUES ('".$target_file."')";
		$res = $conn->query($sql);
		$id = mysqli_insert_id($conn);
	}
	if(isset($_POST['update']) && $_POST['update']=='update'){
		$sql = "update docupload set doc_name='".$_POST['doc_name']."',doc_type='".$_POST['doc_type']."',doc_points='".$_POST['points']."',doc_table_size='".$_POST['doc_table_size']."' where id=".$_POST['id'];
		$res = $conn->query($sql);
		header("location: index.php");
	}
}
include_once("header.php");
?>
		<script language="Javascript">
		$(document).ready(function(){
			$(".tableSize").hide();
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
						onSelect: updateCoords
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
  <h4>Document - Add</h4>
		<form method="post" enctype='multipart/form-data'>
			<input type="hidden" name="id" value="<?php echo $id ?>"/>
			<input type="hidden" id="points" name="points"/>
			
			<?php 
			if($target_file!=''){
			?>
			<div class="mb-3">
			<label class="form-label">Document Name</label>
			<input type="text" class="form-control" name="doc_name" required />
			</div>
			<div class="mb-3">
			<label class="form-label">Document Type</label>
			<select class="form-control docType" name="doc_type" required >
			<option value="0">Select Type</option>
<option value="1">Bar Code</option>
<option value="2">QR Code</option>
<option value="3">Table</option>
			</select>
			</div>
			<div class="mb-3 tableSize">
			<label class="form-label">Document Table Size</label>
			<input type="text" class="form-control" name="doc_table_size" />
			</div>
			<div class="mb-3">
			<img src="<?php echo $target_file; ?>" id="cropbox" />
			</div>
			<div class="mb-3">
			<input type="submit" value="update" class="btn btn-primary" name="update"/>
			</div>
			<?php
			}else{
			?>
			<div class="mb-3">
			<label class="form-label">Upload Template</label>
			<input type="file" class="form-control" name="doc_file" required />
			</div>
			<div class="mb-3">
			<input type="submit" name="upload" class="btn btn-primary" value="Upload"/>
			</div>
			<?php			
			}
			?>
		</form>
	</div>
</main>
<?php 
include_once("footer.php");
?>
