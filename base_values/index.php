<?php

include '../dblogin.php';


$unset = 0;
include 'form.html.php';
if (!empty($_POST))
{
	foreach($_POST as $p)
	{
		if (empty($p))
		{
			$unset = 1;
		}
	}	
}
echo "<br><br><br><br>";
print_r($_POST);
if ($unset == 0)
{
	$sql = 'INSERT INTO sales.base_value SET ';

	foreach ($tablekeys as $key)
		{	
			$baseinsert = array();
			if ( $key != 'Base_ID' || $key !='Last_Updated')
			{
				$sql .= $key.' = :'.$key.', ';
				$baseinsert[] = $key;
			}
		}
	$sql = rtrim($sql, ", ");

	try
	{
        $s = $pdo -> prepare($sql);
        foreach ($baseinsert as $colname)
        {
        	$s -> bindValue(':'.$colname, $_POST[$colname]);
        }
        $s -> execute();
        $output = 'Table updated successfully.';
        include 'output.html.php';
	}

    catch (PDOException $e)
    {
        $output = 'Error updating '.$key. ' or '.$colname.' field of base_values table:' . $e->getMessage();
        include'output.html.php';
        echo $sql;
        exit();
    }
}

/*$IDcheck = 0;
if (isset($_POST['internet_bandwidth']))
	{ echo "issettest";
		print_r($_POST);
		$baseinsert = array();
		$sql = 'INSERT INTO sales.base_values10 SET ';
		foreach (array_keys($modbasevals) as $arindex)//{
		  //if (isset($_POST[$arindex])){
			{if ($IDcheck ==1 && $arindex != 'last_updated')
				{
					$sql = $sql . $arindex.'= :'.$arindex.', ';
					$baseinsert[] = $arindex	;
				}
			$IDcheck = 1;
			}
			$sql = rtrim($sql, ", ");
			
	    try
	    {	
	        $s = $pdo -> prepare($sql);
	        foreach ($baseinsert as $colname)
	        {
	    		if ($colname != 'last_updated')
	    		{
	        		$s -> bindValue(':'.$colname, $_POST[$colname]);
	        	}
	        }

	        $s -> execute();
	        $output = 'Table updated successfully.';
	        include 'output.html.php';
	    }

	    catch (PDOException $e)
	    {
	        $output = 'Error updating '.$arindex. ' or '.$colname.' field of base_values table:' . $e->getMessage();
	        include'output.html.php';
	        echo $sql;
	        exit();
	    }

}*/
?>