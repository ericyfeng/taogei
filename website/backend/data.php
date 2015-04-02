<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	$industrycount = "select description, count(*) from projectindustry natural join industry group by description;";
	pg_prepare($dbconn, "count", $industrycount);
	$result = pg_execute($dbconn, "count", array());
?>	
	
<?php		
	$output = "[";
	while ($row = pg_fetch_array($result) ) {
		if ($output != "[") {
			$output .= ",";
		}
		$output .= "{
					industry: '". $row[0] ."',
					count: " . $row[1] . "
					}";
	}
	$output .= "]";
?>	
