<!-- 
                    ****math-courses.php****

    This is the main page for math courses

    Authors: Forrest Miller, Zachary Pierson, Allison Bodvig
    Class: CSC 468 (GUI)
    Proffesor: Dr. John Weiss
 -->

<!DOCTYPE html>

<?php
  session_start();
?>
<html>
  <head>
    <title>Math Courses</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="courseStyle.css">
  </head>
  <body>
    <img src="math-csc-logo.png">
    <?php
      if(isset($_SESSION["username"]))
      {
        echo "<div class='login'>Welcome " . $_SESSION["username"] . "!" . 
          "<form action='login.php' method='post'>" . 
          "<input type='submit' value='Logout' name='logout'> </form></div>";
      }
    ?>
    <div class="login">
    <h1> Math Courses</h1>
    </ br>
    <div>
      <ul class="menu">
        <div class="menuTitle">MCS Menu</div>
        <hr class="menuDivider">
        <a href="MCS.php">
          <li>Home</li>
        </a>
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
              <a href="empty-redirect.html">CS Course Scheduler</a>
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
        <a href="empty-redirect.html">
          <li>
            Departmental Directory
          </li>
        </a>
        <a href="empty-redirect.html">
          <li>
            Building Map
          </li>
        </a>
        <a href="empty-redirect.html">
        <li>
          Submit It!
        </li>
        </a>
      </ul>
    </div>
    
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

    <div class="footer">
      <hr>
      <div>
        <a href="https://www.google.com">Google</a>
        <a href="MCS.php">Home</a>
        <a href="#">Top</a>
      </div>
    </div>
  </body>

</html>
