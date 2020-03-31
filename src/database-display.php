<div class="database-display-container">
	<?php

		if(isset($_POST['search']))
		{
			$valueToSearch = $_POST['valueToSearch'];
			// search in all table columns
			// using concat mysql function
			$query = "SELECT * FROM `athletedatabase` WHERE CONCAT(`fname`, `lname`, `sport`, `date_excused`, 'departure_time') LIKE '%".$valueToSearch."%'";
			$search_result = filterTable($query);
			
		}
		 else {
			$query = "SELECT * FROM `athletedatabase`";
			$search_result = filterTable($query);
		}

		// function to connect and execute the query
		function filterTable($query)
		{
			require 'includes/dbh.inc.php';
			$filter_Result = mysqli_query($conn, $query);
			return $filter_Result;
		}

	?>
	<form action="index.php" method="post">
		<input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>
		<input type="submit" name="search" value="Filter"><br><br>
		<table>
			<tr>
				<th>Athlete First Name</th>
				<th>Athlete Last Name</th>
				<th>Sport</th>
				<th>Date Excused</th>
				<th>Departure Time</th>
			</tr>
			<?php while($row = mysqli_fetch_array($search_result)):?>
			<tr>
				<td><?php echo $row['fname'];?></td>
				<td><?php echo $row['lname'];?></td>
				<td><?php echo $row['sport'];?></td>
				<td><?php echo $row['date_excused'];?></td>
				<td><?php echo $row['departure_time'];?></td>
			</tr>
			<?php endwhile;?>
		</table>
	</form>
</div>