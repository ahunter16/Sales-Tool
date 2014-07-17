<?php
mb_internal_encoding("UTF-8");
function tablegenerate ()
{	$bwidths = array(10,20,30,40,50,100);
	$margins = array('Low Margin', 'Medium Margin', 'High Margin');
	$years = array(1,2,3,4,5);

	echo 
	'<br><br><br><table id = "entryfield" class = "0martable"><tr>
	<th class = "side">Supplier</th>
	<th class = "ttb" colspan = "3">TalkTalk Business</th>
	<th class = "bt" colspan = "3">BT 21CN Etherway</th>
	<th class = "bt" colspan = "2">BT 21CN Etherflow Standard CoS</th>
	<th class = "bt" colspan = "2">BT 21CN Etherflow Premium CoS</th>
	<th class = "ead" colspan = "2">BT Openreach EAD</th></tr>
	</tr>
	<tr>
	<th class = "side" >Bandwidth Mbps</th>
	<th class = "ttb"> Annual Rental</th>
	<th class = "ttb">1 Year Install</th>
	<th class = "ttb">3 Year Install</th>	
	<th class = "bt"> Annual Rental</th>
	<th class = "bt">1 Year Install</th>
	<th class = "bt">3 Year Install</th>
	<th class = "bt">Annual Rental</th>
	<th class = "bt">Total Price Inc. Etherway</th>
	<th class = "bt">Annual Rental</th>
	<th class = "bt">Total Price Inc. Etherway</th>
	<th class = "ead">Annual Rental</th>
	<th class = "ead">Install</th>
	</tr>';

		$fields = array('ttbann','ttb1yr','ttb3yr','wayann','wayann','way1yr','way3yr','btsann','btpann','eadann','eadins','eadins');

		foreach ($bwidths as $b)
		{	
			$fieldnames = array(); 
			foreach($fields as $f)
			{
				if (!empty($_POST[$f.$b]))
				{
					$fieldnames[$f] = $_POST[$f.$b];
				}
				else
				{
					$fieldnames[$f] = "";
				}
			}

			if (!empty($fieldnames['wayann']) || !empty($fieldnames['btsann']) || !empty($fieldnames['btpann']))
			{
				$fieldnames['btstot'] = $fieldnames['wayann'] + $fieldnames['btsann'];
				$fieldnames['btptot'] = $fieldnames['wayann'] + $fieldnames['btpann'];
			}
			else 
			{
				$fieldnames['btstot'] = "";
				$fieldnames['btptot'] = "";
			}

		//echo "ttbann".$b." ".$ttbann;
			//onblur = "formsub()"
		echo '<tr>
			<th class = "side">'.$b.'</th>
			<td>&pound<input type = "text" class = "inputtext" name = "ttbann'.$b.'" id = "ttbann'.$b.'" value = "'.$fieldnames["ttbann"].'"></td>
			<td>&pound<input type = "text" class = "inputtext" name = "ttb1yr'.$b.'" id = "ttb1yr'.$b.'" value = "'.$fieldnames["ttb1yr"].'"></td>
			<td>&pound<input type = "text" class = "inputtext" name = "ttb3yr'.$b.'" id = "ttb3yr'.$b.'" value = "'.$fieldnames["ttb3yr"].'"></td>
			<td>&pound<input type = "text" class = "inputtext" name = "wayann'.$b.'" id = "wayann'.$b.'" value = "'.$fieldnames["wayann"].'"></td>
			<td>&pound<input type = "text" class = "inputtext" name = "way1yr'.$b.'" id = "way1yr'.$b.'" value = "'.$fieldnames["way1yr"].'"></td>
			<td>&pound<input type = "text" class = "inputtext" name = "way3yr'.$b.'" id = "way3yr'.$b.'" value = "'.$fieldnames["way3yr"].'"></td>
			<td>&pound<input type = "text" class = "inputtext" name = "btsann'.$b.'" id = "btsann'.$b.'" value = "'.$fieldnames["btsann"].'" onblur = "ewayadd()"></td>
			<td class = "btsi1" >&pound<label id = "btstot'.$b.'">'.$fieldnames["btstot"].'</label></input></td>
			<td>&pound<input type = "text" class = "inputtext" name = "btpann'.$b.'" id = "btpann'.$b.'" value = "'.$fieldnames["btpann"].'" onblur = "ewayadd()"></td>
			<td class = "btsi1" >&pound<label  id = "btptot'.$b.'">'.$fieldnames["btptot"].'</label></td>	
			<td>&pound<input type = "text" class = "inputtext" name = "eadann'.$b.'" id = "eadann'.$b.'" value = "'.$fieldnames["eadann"].'"></td>				
			<td>&pound<input type = "text" class = "inputtext" name = "eadins'.$b.'" id = "eadins'.$b.'" value = "'.$fieldnames["eadins"].'"></td></tr>';
		};
			echo '</table><br>';
}
function table_populate($inputdata, $x)
{	$bwidths = array(10,20,30,40,50,100);
	$margins = array('l' => 'Low Margin', 'm' => 'Medium Margin', 'h' => 'High Margin');
	$years = array(1,2,3,4,5);
	$marginindex = array('l', 'm', 'h');
	$supp = array("ttb", "bts", "btp", "ead", "spd");

	
				//echo "QUOTEARRAY: <br>";
			//print_r($inputdata);
	foreach ($marginindex as $m)
	{echo '<table id = "'.$x.$m.'table" class = "martable'.$x.$m.'"><tr>
			<th class = "side">'.$margins[$m].'</th>
			<th class = "ttb" colspan = "2"><label>TTB</label></th>
			<th class = "bt" colspan = "2"><label>BT 21CN Standard</label></th>
			<th class = "bt" colspan = "2"><label>BT 21CN Premium</label></th>
			<th class = "ead" colspan = "2"><label>BT Openreach EAD</label></th>
			<th class = "ead" colspan = "2"><label>EAD Spread Install</label></th>
			</tr>
			<tr>
			<th class = "side" >Term</th>';
			foreach($supp as $s){echo '
				<th class = "'.$s.$m.'1 '.$s.'i1"><label for = "'.$s.$m.'1"> 1 Year </label></th>'."\n".'
				<th class = "'.$s.$m.'3 '.$s.'i3"><label for = "'.$s.$m.'3">3 Years </label></th>
			';}

		foreach ($bwidths as $bdw)
		{	
			echo '<tr>
			<th class = "side">'.$bdw.' Mbps</th>';
			foreach ($supp as $s)
			{ 

				$yrs = array(1, 3);

				foreach ($yrs as $ys)
				{
					$y1 = $m.$ys;
					$sub1 = '--';
					if ($bdw == "")
					{
						$bdw = 10;
					}
					//echo "DATA".$bdw;
					//print_r($inputdata[$bdw]['ttb']);
					if (isset($inputdata[$bdw]))
					{
						if (array_key_exists($s, $inputdata[$bdw]))
						{
							//echo "bws: ".$bwnums[$s][$y1]." ";
							if ($inputdata[$bdw][$s][$y1]!= "") 
							{
								$sub1 = $inputdata[$bdw][$s][$y1];
							} 
							else 
							{
								$sub1 = '  --';
							}
							//echo "keyexists";
						}//echo "is set";
					}
					else {$sub1 = '  --';}

					echo'<td id = "'.$s.$y1.$bdw.$x.'"class = "'.$s.'i'.$ys.'" onmouseenter = "cellhighlight(this)" onmouseleave = "cellunhighlight(this)">&pound '.$sub1.'</td>'."\n";
				}
			};
		echo "</tr>";}
		echo '</table><br>';
	}echo'<br><br><br>';
}
