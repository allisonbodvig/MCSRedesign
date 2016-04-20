<!-- 
                    ****math-courses.php****

    This is the main page for math courses

    Authors: Forrest Miller, Zachary Pierson, Allison Bodvig
    Class: CSC 468 (GUI)
    Proffesor: Dr. John Weiss
 -->

<!DOCTYPE html>
<html>
  <head>
    <title>Computer Science Courses</title>
  </head>
  <body>
    <h1> Math Courses</h1>
    <p>add course things...</p>
    
    <?php
      //print each element
      include 'readXML.php';
      
      //read in list of classes
      $mathDB = readXML("test.xml");

      //print each class name
      foreach ($mathDB as $class)
	  {
        echo "<p>" . $class["name"] . "</br>" .
          $class["preFix"] . $class["number"] . "</br>" .
          "Credits:" . $class["credits"] . "</br>" ;
              
         
          //"Offered:" . $class["offered"] . "</br>" .
          
          echo "Description:" . $class["description"] . "</br>" .
          "Prerequisites: " ;

        //check for no preReqs
        if (empty($class["preReq"]))
        {
            echo "None";
        } else 
        {
            //preint each preReq
            foreach ($class["preReq"] as $req)
            {
                echo $req . " ";
            }
        }        
    
        echo "</br>Corequisites: ";
    
        //check for no coReqs
        if (empty($class["coReq"]))
        {
            echo "None";
        } else 
        {
            //print each coReq
            foreach ($class["coReq"] as $req)
            {
                echo $req . " ";
            }
        }
        
        echo "</br>Notes: " . $class["notes"] . "</br></p>";  
        
              
            
	}

    ?>

  </body>

</html>
