<?php
include_once("db_connect.php");
include_once("header.php");
?>
    
<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container">
	<div class="align-right"><a class="btn btn-primary" href="docAdd.php">Add</a></div>
		<form>
			<table class="table table-hover">
				<tr>
				<th>Sno</th>
				<th>Doc Name</th>
				<th>Doc Type</th>
				<th>Action</th>
				</tr>
			<?php
				$sql = "SELECT * FROM docupload";
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) {
				  // output data of each row
				  $i=0;
				  while($row = $result->fetch_assoc()) {
					 $i=$i+1; 
			?>
				<tr>
					<td><?php echo $i ?></td>
					<td><?php echo $row["doc_name"] ?></td>
					<td><?php echo $row["doc_type"]==1?'Bar Code':$row["doc_type"]==2?'QR Code':'Table' ?></td>
					<td>
						<a class="btn btn-primary btn-sm" href="docEdit.php?id=<?php echo $row["id"] ?>">Edit </a>
						<a class="btn btn-primary btn-sm" href="docDelete.php?id=<?php echo $row["id"] ?>"> Delete</a>
					</td>
				</tr>
			<?php			
				  }
				}else{
					echo "<tr><td colspan='4' style='text-align:center'>No Records Found</td></tr>";
				}
					
			?>
			</table>
		</form>
   </div>
</main>
<?php 
include_once("footer.php");
?>