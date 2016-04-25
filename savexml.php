<?php

if(isset($_POST['save']))
{
    include_once("readXML.php");

    $tmp = $_POST;

    //var_dump($tmp);

    $class["isActive"] = $tmp["active"];
    $class["name"] = $tmp["name"];
    $class["preFix"] = $tmp["preFix"];
    $class["number"] = $tmp["number"];
    $class["credits"] = $tmp["credits"];
    $class["offered"] = $tmp["offered"];
    $class["description"] = $tmp["description"];

    $keys = array_keys($tmp);

    //var_dump($keys);

    $matches = preg_grep("/^pre[^F]/", $keys);

    //var_dump($pres);


    $pre = array();
    $i = 0;
    $stuff = "";
    
    foreach ($matches as $item)
    {
        $stuff = $stuff . $tmp[$item]; 

        if ($i == 2)
        {
            $pre[] = $stuff;
            $i = 0;
            $stuff = "";
        }

       $i++; 

    }

    $co = array();
    $class["preReq"] = $pre;

    $i = 0;
    $stuff = "";
    
    $matches = preg_grep("/^co/", $keys);

    foreach ($matches as $item)
    {
        $stuff = $stuff . $tmp[$item]; 

        if ($i == 2)
        {
            $co[] = $stuff;
            $i = 0;
            $stuff = "";
        }

       $i++; 

    }

    $class["coReq"] = $co;

    $class["notes"] = $tmp["notes"];
    getCourse($class);
    
}

?>
