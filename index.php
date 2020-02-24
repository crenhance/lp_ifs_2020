<?php
include_once('backup.php');
mysqli_select_db($conn,'ifs_db');
$query = "select * from shipments";
$result = mysqli_query($conn,$query);

?>

<!DOCTYPE html>
<html>
	<title>
		<head>TITLE</head>
	</title>
	<body>
		<?php
			while($rows = mysqli_fetch_assoc($result))
			{
		?>
		<table>
			<tr>
				<td><?php echo $rows.['cntr']; ?></td>
				<td><?php echo $rows.['bkg']; ?></td>
				<td><?php echo $rows.['pcs']; ?></td>
				<td><?php echo $rows.['kgs']; ?></td>
				<td><?php echo $rows.['m3']; ?></td>
				<td><?php echo $rows.['week']; ?></td>
				<td><?php echo $rows.['destination']; ?></td>
			</tr>
		<?php
			}
		?>
		</table>
	</body>
</html>