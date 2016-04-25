<!-- 
                    ****MCS.html****

    This is the starting point for the MCS Home page redesign.
    development branch is on the mcs server at dev.mcs.sdsmt.edu/~<StudentId>
    Where <StudentId> is either 7103025, 7182112, 7213465.

    Authors: Forrest Miller, Zachary Pierson, Allison Bodvig
    Class: CSC 468 (GUI)
    Proffesor: Dr. John Weiss
 -->

<!DOCTYPE html>

<?php
  session_start();

  $loggedIn = false;

  if(isset($_SESSION["username"]))
    {
      $loggedIn = true;
    }

?>


<html>
  <head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="menu.css">
  </head>
  <body>
    <img src="math-csc-logo.png">
    <?php
      if ($loggedIn != true)
      { ?>
        <form class="login" action="login.php" method="post">
          <label>Username: </label>
          <input type="text" name="username" maxlength="50">

          <label>Password: </label>
          <input type="password" name="password" maxlength="50">

          <input type="submit" name="login" value="Login">
        </form>
      <?php
      }
      else
      { 
        echo "<div class='login'>Welcome " . $_SESSION["username"] . "!" . 
          "<form action='login.php' method='post'>" . 
          "<input type='submit' value='Logout' name='logout'> </form></div>";
      } ?>
    </ br>
    <div>
      <ul class="menu">
        <div class="menuTitle">MCS Menu</div>
        <hr class="menuDivider">
        <li>Home</li>
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

    <img src="McLaury.jpg" width="40%" style="float:left;margin:63px 20px 10px 0px;">

    <p style="margin:100px 10px 10px 0px;">Welcome to Mathematics and Computer Science @ SDSM&T
  We are in the process of moving all our materials to the main campus website. You can find the new department home at http://www.sdsmt.edu/MCS/.
  Our department offers a B.S. in Computer Science, a B.S. in Applied and Computational Mathematics, and a new M.S. in Computational Sciences and Robotics. Our B.S. Computer Science degree is accredited by the Computing Accreditation Commission of ABET, http://www.abet.org.</p>
    <p>A Few Items Still on this Website
The code submission page has been redesigned to hopefully make it more user friendly and intuitive. The code submission page can now be found under "Students Submit It!". The Alumni, resources, and policy pages on the left navigation menu are still complete with the information we have been maintaining. Please check out the new department home at http://www.sdsmt.edu/MCS/ to get the latest and greatest information.</p>

    <div class="footer">
      <hr>
      <div>
        <a href="https://www.google.com">Google</a>
        <a href="MCS.php">Home</a>
      </div>
    </div>
  </body>

</html>
