<?php

//compares course numbers
function cmp ($a, $b)
{
    if( $a["number"] == $b["number"] )
	{
		echo "numbers are equal\n";     
	   	return 0;
	}

    return ( $a["number"] < $b["number"] ) ? -1 : 1; 

}

function readXML($filename)
{

	//load in xml file
	$xml = simplexml_load_file($filename) or die ("Error: Cannot create object\n");
    
    //print_r($xml);

	//declare initial array
	$db = array();

	//loop through xml file
	foreach ($xml->children() as $class)
	{
		//set temp array
		$tmp = array();

		//set each value of the array to data from xml
        $tmp["active"] = (bool)$class->attributes()->isActive;

		$tmp["name"] = (string)$class->name;

		$tmp["preFix"] = (string)$class->preFix;

		$tmp["number"] = (int)$class->number;

		$tmp["credits"] = (string)$class->credits;

		$tmp["description"] = (string)$class->description;

        $Preq = array();		

        //loop through preReqs incase there is more than one
        foreach ($class->preReq as $req)
		{
			$Preq[] = (string)$req;	
		}
	
		//push preReqs aray
		$tmp["preReq"] = $Preq;

        $Creq = array();

		//loop through co-reqs incase there is more than one
		foreach ($class->coReq as $req)
		{
			$Creq[] = (string)$req;	
		}
		//push coReqs array
		$tmp["coReq"] = $Creq;

		$tmp["notes"] = (string)$class->notes;
	
		//push course to main array
		array_push($db, $tmp);
	} 

	//sort based on course number
	uasort ($db, 'cmp');

    //return array of xml file
    return $db;

}

?>
