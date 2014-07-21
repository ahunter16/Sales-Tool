
<?php 		//A file for displaying the most recent sets of base values

function basevals()
{
	include '../dblogin.php';
	$bandwidths = array(10,20,30,40,50,100);	
	foreach ($bandwidths as &$b)
	{
		try
		{
			$modbasequery = 'SELECT * FROM sales.base_value WHERE Bandwidth_Mbps = '.$b.' ORDER BY last_updated DESC LIMIT 1';
			$modstmt = $pdo->query($modbasequery);
			$modresult = $modstmt->setFetchMode(PDO::FETCH_ASSOC);
		}

		catch (PDOException $e)
		{
		    $output = 'Error getting pricing info:' . $e->getMessage();
		    include'output.html.php';
		    exit();
		}
		while ($modrow = $modstmt->fetch())
		{	

			$modbasevals[] = $modrow;

		}
		
	}
	//print_r($modbasevals);
	function tabledefine($modbasevals)		//creates a table with headings using base_valuesx column names
	{
		echo '<table id = "baseinputs"><tr>';

		$tablerows = "";
		$tablehead = "";
		foreach (array_keys($modbasevals) as $modkeys)
			{	
				$tablehead .= '<th>'.$modkeys.'</th>'."\n";
			}
		echo $tablehead;
	}
	echo '<form>';


tabledefine($modbasevals[0]);
$tablekeys = array_keys($modbasevals[0]); //fields

$iterator = [0,1,2,3,4,5];

foreach ($iterator as $b)
{	
	$fieldnames = array(); 
	foreach($tablekeys as $f)
	{
		echo " CAPS".$f;
		$bwidths = array(10,20,30,40,50,100);
		if (!empty($_POST[$bwidths[$b].$f]) && $f !='Base_ID' && $f != 'Last_Updated')
		{
			$fieldval[$f] = $_POST[$bwidths[$b].$f];
			
			//print_r($fieldval[$f]);
		}
	}
}

	$i = 0;
	foreach ($modbasevals as $modtable)
	{	
		echo'<tr>';
		$tablerows = '';
		$ki = 0;

		foreach ($tablekeys as $key)
			{	
				//echo "KEY ".$key;
				if (!empty($fieldval[$key]))
				{
					$active = $fieldval[$key];
				}
				
				else
				{
					$active = $modtable[$key];
				}
				if ( $key == 'Base_ID' || $key =='Last_Updated')
				{
					$insert = $modtable[$key];
				}
				elseif ($key == 'Bandwidth_Mbps')
				{
					$insert = '<input id = "'.$modtable['Bandwidth_Mbps'].$key.'" name = "'.$modtable['Bandwidth_Mbps'].$key.'" type = "hidden" placeholder = "'.$modtable[$key].'" value = "'.$active.'" >'.$active;
				}
				elseif ($ki >= 3 && $ki < 10)
				{
					$insert = '&pound <input class = "baseinput" id = "'.$modtable['Bandwidth_Mbps'].$key.'" name = "'.$modtable['Bandwidth_Mbps'].$key.'" type = "text" placeholder = "'.$modtable[$key].'" value = "'.$active.'" >';
				}
				else
				{
					$insert = '<input class = "baseinput" id = "'.$modtable['Bandwidth_Mbps'].$key.'" name = "'.$modtable['Bandwidth_Mbps'].$key.'" type = "text" placeholder = "'.$modtable[$key].'" value = "'.$active.'" > %';
				}
				$ki += 1;

					$tablerows .= '<td>'.$insert.'</td>'."\n";
			}
		$i += 1;
		//echo $tablerows;
		echo'</tr></form>';
	}
}			
?>