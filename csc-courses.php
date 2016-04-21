<!-- 
                    ****csc-courses.php****

    This is the main page for both the math and computer science courses

    Authors: Forrest Miller, Zachary Pierson, Allison Bodvig
    Class: CSC 468 (GUI)
    Proffesor: Dr. John Weiss
 -->

<!DOCTYPE html>
<html>
  <head>
    <title>Computer Science Courses</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="courseStyle.css">
  </head>
  <body>
    <img src="math-csc-logo.png">
    <h1>Computer Science Courses</h1>
    </ br>
    <div>
      <ul class="menu">
        <div class="menuTitle">MCS Menu</div>
        <hr class="menuDivider">
        <li>
          <a href="MCS.php">Home</a>
        </li>
        <li> Courses
          <ul>
            <li>
              <a href="csc-courses.php">Computer Science Courses</a>
            </li>
            <li>
              <a href="math-courses.php">Math Courses</a>
            </li>
          </ul>
        </li>
        <li> Web Pages
          <ul>
            <li>
              <a href="empty-redirect.html">Faculty</a>
            </li>
            <li>
              <a href="empty-redirect.html">Students</a>
            </li>
            <li>
              <a href="empty-redirect.html">Alumni</a>
            </li>
          </ul>
        </li>
        <li> Checklist
          <ul>
            <li>
              <a href="empty-redirect.html">CS Checklist</a>
            </li>
            <li>
              <a href="empty-redirect.html">CS Flowchart</a>
            </li>
            <li>
              <a href="empty-redirect.html">CS Course Schedualer</a>
            </li>
          </ul>
        </li>
        <li> Research
          <ul>
            <li>
              <a href="empty-redirect.html">MCS Colloquium</a>
            </li>
            <li>
              <a href="empty-redirect.html">MCS Research</a>
            </li>
          </ul>
        </li>
        <li> Resources
          <ul>
            <li>
              <a href="empty-redirect.html">Student Organizations</a>
            </li>
            <li>
              <a href="empty-redirect.html">Tutorials and Resources</a>
            </li>
            <li>
              <a href="empty-redirect.html">Policy, Forms, Coding Standards</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="empty-redirect.html">Departmental Directory</a>
        </li>
        <li>
          <a href="empty-redirect.html">Building Map</a>
        </li>
        <li>
          <a href="empty-redirect.html">Submit It!</a>
        </li>
      </ul>
    </div>
    
    <?php
      //print each element
      include 'readXML.php';
      
      //read in list of classes
      $cscDB = readXML("csc.xml");
      
      //create paragraph for each class
      foreach ($cscDB as $class)
      {
        echo "<div id=\"course\">" . concatCourse($class) . "</div>\n";
      }

    ?>
    
    
  </body>

</html>
