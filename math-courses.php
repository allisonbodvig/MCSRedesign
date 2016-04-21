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
    <title>Math Courses</title>
    <link rel="stylesheet" href="courseStyle.css">
  </head>
  <body>
    <h1> Math Courses</h1>
    
    <?php
      //print each element
      include 'readXML.php';
      
      //read in list of classes
      $mathDB = readXML("math.xml");
      
      //read in list of classes
      foreach ($mathDB as $class)
      {
        echo "<div id=\"course\">" . concatCourse($class) . "</div>\n";
      }

    ?>

  </body>

</html>
