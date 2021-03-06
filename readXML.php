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
        $tmp["active"] = (string)$class->attributes()->isActive;

		$tmp["name"] = (string)$class->name;

		$tmp["preFix"] = (string)$class->preFix;

		$tmp["number"] = (string)$class->number;

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

function addAnchor ( $str, $preFix )
{
    $tag = null;
    
    //math page and math req
    if ( (strpos($str, "MATH") !== false) and ("MATH" == $preFix ) )
    {
        //finds course number
        preg_match('/\d+[L]*/', $str, $matches);
        $tag = "#MATH" . $matches[0];   
    //csc page and csc req 
    } else if ( ( strpos( $str, "CSC" ) !== false ) and ("CSC" == $preFix ) )
    {
        //finds course number
        preg_match('/\d+[L]*/', $str, $matches);
        $tag = "#CSC" . $matches[0];
    //math page and csc req    
    } else if ( ( strpos( $str, "CSC" ) !== false ) and ("MATH" == $preFix ) )
    {
        preg_match('/\d+[L]*/', $str, $matches);
        $tag = "csc-courses.php#CSC" .$matches[0] ;
        
    //csc page and math req
    } else if ( ( strpos( $str, "MATH" ) !== false ) and ("CSC" == $preFix ) )
    {
        preg_match('/\d+[L]*/', $str, $matches);
        $tag = "math-courses.php#MATH" .$matches[0] ;
    }
    
    return $tag;


}

//isolate class from pre and co reqs
function createLink( $str )
{
    $tag = null;

    if ( strpos ($str, "MATH") !== false )
    {
        preg_match('/\d+[L]*/', $str, $matches);
        $tag = "MATH " . $matches[0];
    } else if ( strpos ($str, "CSC") !== false )
    {
        preg_match('/\d+[L]*/', $str, $matches);
        $tag = "CSC " . $matches[0];
    }

    if ( empty ( $tag ) )
    {
        return null;
    } else
    {

        $length = strpos($str, $tag);
        
        $pieces[0] = substr($str, 0, $length);
        $pieces[1] = $tag;
        $pieces[2] = substr( $str, $length + strlen($tag) );
        
        return $pieces;
        
    }
}

function concatCourse($class)
{
    $id = $class["preFix"] . $class["number"];
    
    $info = "<h3><a id=\"" . $id . "\">" . $class["preFix"] . " " . $class["number"] . 
        " - " . $class["name"] . "</a></h3>" .
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
        //print each preReq
        foreach ($class["preReq"] as $req)
        {
           $tag = addAnchor($req, $class["preFix"]);
           $pieces = createLink($req);           
                       
           //create anchor tag for classes
           if ( is_null ( $tag ) )
           {
                $info = $info . $req . " ";
           } else
           {
               if ( ! (is_null ( $pieces ) ) )
               {
                    $info = $info . $pieces[0] . "<a href=\"" . $tag . "\">" . 
                        $pieces[1] . "</a> " . $pieces[2] . " "  ;
               } 
                    
           }

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
           $tag = addAnchor($req, $class["preFix"]);
           $pieces = createLink($req); 
           
           //create anchor tag for classes
           if ( is_null ( $tag ) )
           {
                $info = $info . $req . " ";
           } else
           {
               if ( ! (is_null ( $pieces ) ) )
               {
                    $info = $info . $pieces[0] . "<a href=\"" . $tag . "\">" . 
                        $pieces[1] . "</a> " . $pieces[2] . " "  ;
               } 
           }
        }
    }
    
    if (empty($class["notes"]))
    {
        $info = $info . "</br><b>Notes:</b> None";
    } else 
    {
        $info = $info . "</br><b>Notes:</b> " . $class["notes"] . "</br>";
    }
    
    //add edit button
    if(isset($_SESSION["admin"]) && $_SESSION["admin"] == true)
    {
        $info = $info . "<form action = \"form.php\" method=\"post\"> \n <input type=\"submit\" name=\"action\" value=\"Edit\"/> \n";
        
        /*foreach ($class as $item)
        {
             
            if (is_array($item) )
            {
                foreach ($item as $stuff)
                    $info = $info . "<input type=\"hidden\" name=\"class[]\" value=\"" . $stuff . "\"/>";
            } else 
                $info = $info . "<input type=\"hidden\" name=\"class[]\" value=\"" . $item . "\"/>";
            
        }*/
        
        $info = $info . "<input type=\"hidden\" name=\"class[]\" value=\"" . $class["active"] . "\"/>";
        $info = $info . "<input type=\"hidden\" name=\"class[]\" value=\"" . $class["name"] . "\"/>";
        $info = $info . "<input type=\"hidden\" name=\"class[]\" value=\"" . $class["preFix"] . "\"/>";
        $info = $info . "<input type=\"hidden\" name=\"class[]\" value=\"" . $class["number"] . "\"/>";
        $info = $info . "<input type=\"hidden\" name=\"class[]\" value=\"" . $class["credits"] . "\"/>";
        $info = $info . "<input type=\"hidden\" name=\"class[]\" value=\"" . $class["offered"] . "\"/>";
        $info = $info . "<input type=\"hidden\" name=\"class[]\" value=\"" . $class["description"] . "\"/>";
        
        foreach ($class["preReq"] as $stuff)
                    $info = $info . "<input type=\"hidden\" name=\"pre[]\" value=\"" . $stuff . "\"/>";
       
        foreach ($class["coReq"] as $stuff)
                    $info = $info . "<input type=\"hidden\" name=\"co[]\" value=\"" . $stuff . "\"/>";
        
        $info = $info . "<input type=\"hidden\" name=\"class[]\" value=\"" . $class["notes"] . "\"/>";
        
        
        $info = $info . "</form>";
    }
    
    return $info;   
}

function getCourse($course)
{
    $filename = "";

    if($course["preFix"] == "CSC")
    {
        $filename = "csc.xml";
    }
    else if($course["preFix"] == "MATH")
    {
        $filename = "math.xml";
    }

    $xml = simplexml_load_file($filename) or die ("Error: Cannot create object\n");

    foreach($xml->children() as $child)
    {
        if($child->number == $course["number"])
        {
            updateCourse($xml, $child, $course, $filename);
            return;
        }
    }

    addCourse($xml, $course, $filename);
}

function updateCourse($xml, $child, $course, $filename) 
{
    $child->isActive = $course["isActive"];
    $child->name = $course["name"];
    $child->preFix = $course["preFix"];
    $child->number = $course["number"];
    $child->credits = $course["credits"];
    $child->offered = $course["offered"];
    $child->description = $course["description"];

    foreach($course['preReq'] as $preReq)
    {
	    
 	#echo $preReq . "\n";   
	$child->addChild('preReq',  $preReq);
    
    }

    foreach($course['coReq'] as $coReq)
    {
        $child->coReq = $coReq;
    }
     
    $child->notes = $course["notes"];
    
    $xml->asXML($filename);

    if($course["preFix"] == "CSC")
    {
        echo "<script>window.location = 'csc-courses.php'</script>";
    }
    else
    {
        echo "<script>window.location = 'math-courses.php'</script>";
    }
}

function addCourse($xml, $course, $filename)
{
    $newChild = $xml->addChild('course');
    $newChild->addAttribute('isActive', $course["isActive"]);
    $newChild->addChild('name', $course["name"]);
    $newChild->addChild('preFix', $course["preFix"]);
    $newChild->addChild('number', $course["number"]);
    $newChild->addChild('credits', $course["credits"]);
    $newChild->addChild('offered', $course["offered"]);
    $newChild->addChild('description', $course["description"]);
    
    foreach($course['preReq'] as $preReq)
    {
        $newChild->addChild('preReq', $preReq);
    }

    foreach($course['coReq'] as $coReq)
    {
        $newChild->addChild('coReq', $coReq);
    }
     

    $newChild->addChild('notes', $course["notes"]);

    $xml->asXML($filename);
    
    if($course["preFix"] == "CSC")
    {
        echo "<script>window.location = 'csc-courses.php'</script>";
    }
    else
    {
        echo "<script>window.location = 'math-courses.php'</script>";
    }

}

#addCourse("blah");

//addAnchor("MATH 110");
//$str = "MATH 321";

//$result = createLink($str);

//print_r ($result);

?>
