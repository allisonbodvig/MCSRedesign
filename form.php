<!DOCTYPE html>
<html>
    <head>
        <title>Edit Courses</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="form-style.css">
        <script src="form-validation.js"></script>
    </head>
    <body>
    
    <fieldset>
    <legend>Class Information</legend>

    <form method="post" action="savexml.php">
    
    <?php $values = $_POST['class']; ?>
    
    Show class to all users? 
    <input type="radio" name="active" value="Yes" <?php if ( (!strcasecmp($values[0], "Yes" )) or (empty($values[0]) )) { echo "checked"; } ?> > Yes
    <input type="radio" name="active" value="No" <?php if ( !strcasecmp($values[0], "No") ) { echo "checked"; }?> > No
    <br/>
    <span class="error" id="nameError"></span>
    <br/>
    Name: 
    <input type="text" name="name" size="40" onblur="validateName(this, 'nameError')" value="<?php echo $values[1]; ?>" />
    <br/>
    <span class="error" id="numberError"></span>
    <br/>
    Course: 
    <select name="preFix">
        <option value="CSC" <?php if ( !strcmp( "CSC", $values[2] ) ) { echo "selected"; }?> >CSC</option>
        <option value="MATH" <?php if ( !strcmp( "MATH", $values[2] ) ) { echo "selected"; } ?> >MATH</option>
    </select>
    <input type="text" name="number" onblur="validateCourseNumber(this, 'numberError')" size="5" value="<?php echo $values[3]; ?>" />
    
    <br/>
    <span class="error" id="creditsError"></span>
    <br/>
    Credits:
    <input type="text" name="credits" onblur="validateCredits(this, 'creditsError')" size="10" value="<?php echo $values[4]; ?>" />
    
    <br/><br/>
    Offered: 
    <input type="text" name="offered" size="20" value="<?php echo $values[5]; ?>" />
    
    <br/><br/>
    Description:
    <br/>
    <textarea name="description" rows="10" cols="50">
        <?php echo $values[6]; ?>
    </textarea>
    
    <br><br>
    Prerequisites (Course Prefix, Course Number, Notes):
    <br><br>
    
    <?php
    
    $j = 0;

    echo "<input type=\"button\" value=\"Add\" onclick=\"addReq('req', 'pre', " . $j++ .")\">";

    echo "<div id=\"req\">";

    
     include 'readXML.php';
     $reqs = $_POST['pre'];

     foreach ($reqs as $item)
     {
        if (!empty ($item))
        {
           $result = createLink($item);
           
           if ( empty ($result) )
           {
             $notes = $item;
             $info = null;
               
           } else 
           {
             $info = explode(" ", $result[1] );
             $notes = $result[2];
           }

           //select for preFix - automatically set to NONE
           echo "<div><br><select name=\"pre" . $j . "\"> <option value=\"NONE\" selected>NONE</option> <option value=\"CSC\"";
             
           if ( strpos($info[0], "CSC" ) !== false ) 
           { 
              echo "selected"; 
           } 
            
           echo ">CSC</option>" ;
            
           echo "<option value=\"MATH\" ";
             
           if ( strpos($info[0], "MATH" ) !== false ) 
           { 
              echo "selected";
           }
             
           echo ">MATH</option> </select> ";
            
            //echo class number
           echo "<input type=\"text\" name=\"prenumber". $j . "\" onblur=\"validateCourseNumber(this, 'numberError')\" size=\"5\" value=\" ". $info[1] . "\" />" ;
           
           echo "<input type=\"text\" name=\"preinfo". $j . "\" size=\"45\" value=\"". $notes . "\" /> <input type=\"button\" value=\"Remove\" onclick=\"removeReq(this)\"></div>" ;

           $j = $j + 1;
        
        }
     }
    ?>
    </div>
    
    <br><br>
    Corequisites (Course PreFix, Course Number, Notes):
    <br/><br/>
<?php

    $i = 0;
    echo "<input type=\"button\" value=\"Add\" onclick=\"addReq('Creq', 'co'," . $i++ . ")\">";
    
    echo "<div id=\"Creq\">";
    
    
     //include 'readXML.php';
     $reqs = $_POST['co'];

     //print_r ($reqs);
     
     foreach ($reqs as $item)
     {
        
       $result = createLink($item);
       
       if ( !empty ($item))
       {
        if ( empty ($result) )
        {
          $notes = $item;
          $info = null;
           
        } else 
        {
          $info = explode(" ", $result[1] );
          $notes = $result[2];
         }

       //select for preFix - automatically set to NONE
        echo "<div><br><select name=\"co" . $i  ."\"> <option value=\"NONE\" selected>NONE</option> <option value=\"CSC\"";
         
         if ( strpos($info[0], "CSC" ) !== false ) 
         { 
            echo "selected"; 
         } 
        
         echo ">CSC</option>" ;
        
         echo "<option value=\"MATH\" ";
         
         if ( strpos($info[0], "MATH" ) !== false ) 
         { 
          echo "selected";
         }
           
         echo ">MATH</option> </select> ";
          
        //echo class number
         echo "<input type=\"text\" name=\"conumber" . $i  . "\" onblur=\"validateCourseNumber(this, 'numberError')\" size=\"5\" value=\" ". $info[1] . "\" />" ;
       
         echo "<input type=\"text\" name=\"coinfo" . $i . "\" size=\"45\" value=\"". $notes . "\" /> <input type=\"button\" value=\"Remove\" onclick=\"removeReq(this)\"></div>" ;
        
        $i = $i + 1;
       }

     } 
    ?>
     </div>
    
    <br/><br/>
    Notes:
    <br/>
    <textarea name="notes" rows="10" cols="50">
        <?php echo $values[7]; ?>
    </textarea>
    
    
    <input type="submit" name="save" value="Save">
    <input type="button" onclick="cancel()" value="Cancel">
    
    </form>
    </fieldset>
   
    </body>

</html>
