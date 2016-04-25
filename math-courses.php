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
    <?php 
      if(isset($_SESSION["admin"]) && $_SESSION["admin"] == true)
      { ?>
        <div class="addCourse">
          <form action="form.php" method="post">
            <input type="submit" name="addCourse" value="Add Course">
          </form>
        </div>
      <?php } ?>
    <div>
      <ul class="menu">
        <div class="menuTitle">MCS Menu</div>
        <hr class="menuDivider">
        <a href="MCS.php">
          <li>Home</li>
        </a>
        <li> Courses
          <ul>
            <a href="csc-courses.php">
              <li>Computer Science Courses</li>
            </a>
            <a href="math-courses.php">
              <li>Math Courses</li>
            </a>
          </ul>
        </li>
        <li> Web Pages
          <ul>
            <a href="empty-redirect.html">
              <li>Faculty</li>
            </a>
            <a href="empty-redirect.html">
              <li>Students</li>
            </a>
            <a href="empty-redirect.html">
              <li>Alumni</li>
            </a>
          </ul>
        </li>
        <li> Checklist
          <ul>
            <a href="empty-redirect.html">
              <li>CS Checklist</li>
            </a>
            <a href="empty-redirect.html">
              <li>CS Flowchart</li>
            </a>
            <a href="empty-redirect.html">
              <li>CS Course Scheduler</li>
            </a>
          </ul>
        </li>
        <li> Research
          <ul>
            <a href="empty-redirect.html">
              <li>MCS Colloquium</li>
            </a>
            <a href="empty-redirect.html">
              <li>MCS Research</li>
            </a>
          </ul>
        </li>
        <li> Resources
          <ul>
            <a href="empty-redirect.html">
              <li>Student Organizations</li>
            </a>
            <a href="empty-redirect.html">
              <li>Tutorials and Resources</li>
            </a>
            <a href="empty-redirect.html">
              <li>Policy, Forms, Coding Standards</li>
            </a>
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
