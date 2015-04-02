<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
?>	
	<table class="table sortable">
		    <thead>
			    <tr>
			        <th>Creater</th>
			        <th>Title</th>
			        <!--<th>Description</th> -->
			        <th>Date Submitted</th>
			    </tr>
		    </thead>
		    <tbody>
				<?php		
					while ($row = pg_fetch_array($result) ) {
				?>	
				<tr <?php echo "industry='" . $row['iid'] . "' tag='" . $row['tagid'] . "'" ?>>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['title']; ?></td>
					<!-- <td><? //php echo $row['description']; ?></td> -->
					<td><?php echo $row['submitdate']; ?></td>
					<td><a <?php echo "href='http://localhost/taogei/website/project.php?pid=".$row['projid']."'";?>>go</a></td>
				</tr>
				<?php } ?>
		
		    </tbody>
	</table>