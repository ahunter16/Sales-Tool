<?php

include '../dblogin.php';

include 'tablereturn.php';

include 'baserow.php';

include 'formula.php';	

<<<<<<< HEAD

=======
>>>>>>> parent of 6bf7399... base development mode added

if (isset($_POST['ttbann'])) 
{
	$form['ttb'] = $_POST['ttbann'];
}

if (isset($_POST['btsann'])) 
{
	$form['bts'] = $_POST['btsann'];
}

if (isset($_POST['btpann'])) 
{
	$form['btp'] = $_POST['btpann'];
}

if (isset($_POST['eadann'])) 
{
	$form['ead'] = $_POST['eadann'];
}


$bandwidths = array(10,20,30,40,50,100);
global $quotearray;
foreach ($bandwidths as $bw){
	$totalcost = array();
	if (!empty($_POST['ttbann'.$bw]) || !empty($_POST['btsann'.$bw]) || !empty($_POST['btpann'.$bw]) || !empty($_POST['eadann'.$bw]))
		
<<<<<<< HEAD
	{	
=======
	{	$form = array();
		$providers = array();
		if ($_POST['ttbann'.$bw] != "") 
		{
			$form['ttb'] = $_POST['ttbann'.$bw];
			$providers[] = 'ttb';
		}

		if ($_POST['btsann'.$bw] != "") 
		{
			$form['bts'] = $_POST['btsann'.$bw];
			$providers[] = 'bts';

		}

		if ($_POST['btpann'.$bw] != "") 
		{
			$form['btp'] = $_POST['btpann'.$bw];
			$providers[] = 'btp';
		}

		if ($_POST['eadann'.$bw] != "") 
		{
			$form['ead'] = $_POST['eadann'.$bw];
			$providers[] = 'ead';
			if ($_POST['eadins'.$bw] != "")
			{
				$providers [] = 'spd';
				$form['spd'] = $_POST['eadann'.$bw];
			}
		}
/*		echo "<br>Providers: ";
		print_r($providers);
		echo "<br>Formstuff:";
		print_r($form);*/
>>>>>>> parent of 6bf7399... base development mode added
		$basevals = array();

			try
			{
				
				$basequery = 'SELECT * FROM sales.active_base_values WHERE Bandwidth_Mbps = '.$bw.' ORDER BY last_updated DESC LIMIT 1';
				$stmt = $pdo->query($basequery);
				$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
<<<<<<< HEAD
			}

=======

			}
>>>>>>> parent of 6bf7399... base development mode added
			catch (PDOException $e)
			{
		        $output = 'Error getting pricing info:' . $e->getMessage();
		        include'output.html.php';
		        exit();
		    }

			$basevals = $stmt->fetch();
<<<<<<< HEAD
			$basekeys = array_keys($basevals);

			$quotearray[$bw] = formfill($basevals, $bw);

		//print_r($_POST);
		

		//print_r($basekeys);
		foreach ($basekeys as $bk)			//using form values as base values, stops on blank cell
		{	/*echo "BASEKEY".$bk;*/
			if (empty($_POST[$bw.$bk]))
			{
				$completeform = 0;
				$baseformval[$bk] = "BLANK";
			}
			else if(!empty($_POST[$bw.$bk."_"])) 
			{
				$baseformval[$bk] = $_POST[$bw.$bk."_"];
				echo "IT HAPPENED";
			}
			else
			{
				$baseformval[$bk] = $_POST[$bw.$bk];
			}

		}
		if (is_null($completeform));
		{	

			$testarray[$bw] = formfill($baseformval, $bw);
		}
		echo "complete".$completeform;
	}

}	//print_r($testarray);
//echo "TEST";





include 'form.html.php';
function formfill($baseformval, $bw)
{	/*echo "PASS";
	print_r($baseformval);*/
	$form = array();
	$providers = array();
	if ($_POST['ttbann'.$bw] != "") 
	{
		$form['ttb'] = $_POST['ttbann'.$bw];
		$providers[] = 'ttb';
	}

	if ($_POST['btsann'.$bw] != "") 
	{
		$form['bts'] = $_POST['btsann'.$bw];
		$providers[] = 'bts';

	}

	if ($_POST['btpann'.$bw] != "") 
	{
		$form['btp'] = $_POST['btpann'.$bw];
		$providers[] = 'btp';
	}

	if ($_POST['eadann'.$bw] != "") 
	{
		$form['ead'] = $_POST['eadann'.$bw];
		$providers[] = 'ead';
		if ($_POST['eadins'.$bw] != "")
		{
			$providers [] = 'spd';
			$form['spd'] = $_POST['eadann'.$bw];
		}
	}
		
	$iterator = 0;
	foreach ($form as $f)
	{
		$index = $providers[$iterator];
		//echo $index;
		if ($index == "bts" || $index == "btp")
		{
			$btcheck = True;
		}
		else
		{
			$btcheck = False;
		}
		if ($index == "ead" || $index == "spd")
		{
			$eadcheck = True;
		}
		else 
		{
			$eadcheck = False;
		}
		if ($index == "spd")
		{
			$spdcheck = True;
		}
		else 
		{
			$spdcheck = False;
		}

		$testcost[$index] = calculate($baseformval, $f);
		$iterator += 1;
	}
	return($testcost);

}
echo "BASE ";
print_r($_POST);
echo "END ";
=======

			$iterator = 0;
			foreach ($form as $f)
			{
				$index = $providers[$iterator];
				//echo $index;
				if ($index == "bts" || $index == "btp")
				{
					$btcheck = True;
				}
				else
				{
					$btcheck = False;
				}
				if ($index == "ead" || $index == "spd")
				{
					$eadcheck = True;
				}
				else 
				{
					$eadcheck = False;
				}
				if ($index == "spd")
				{
					$spdcheck = True;
				}
				else 
				{
					$spdcheck = False;
				}
				$totalcost[$index] = calculate($basevals, $f /*$cost, */);
				$btcheck = False;
				//echo "it: ".$iterator;
				$iterator += 1;
			}
			$quotearray[$bw] = $totalcost;

	}
}


include 'form.html.php';
>>>>>>> parent of 6bf7399... base development mode added
