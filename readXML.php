<?php

//compares course numbers
function cmp ($a, $b)
{
    if ( $a["number"] == $b["number"] )
	{   
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

        $tmp["offered"] = (string)$class->offered;

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

function concatCourse($class)
{
    $info = "<h3>" . $class["preFix"] . " " . $class["number"] . 
        " - " . $class["name"] . "</h3>" .
      "<b>Credits:</b> " . $class["credits"] . "</br>" ;
          
    if ( ! (empty($class["offered"] ) ) )
        $info = $info . "<b>Offered:</b> " . $class["offered"] . "</br>";
      
    $info = $info . "<b>Description:</b> " . $class["description"] . "</br>" .
      "<b>Prerequisites:</b> " ;

    //check for no preReqs
    if (empty($class["preReq"][0]))
    {
        $info = $info . "None";
    } else 
    {
        //preint each preReq
        foreach ($class["preReq"] as $req)
        {
            $info = $info . $req . " ";
        }
    }        

    $info = $info . "</br><b>Corequisites:</b> ";

    //check for no coReqs
    if (empty($class["coReq"][0]))
    {
        $info = $info . "None";
    } else 
    {
        //print each coReq
        foreach ($class["coReq"] as $req)
        {
            $info = $info . $req . " ";
        }
    }
    
    if (empty($class["notes"]))
    {
        $info = $info . "</br><b>Notes:</b> None";
    } else 
    {
        $info = $info . "</br><b>Notes:</b> " . $class["notes"] . "</br>";
    }
    
    return $info;   
}

?>
