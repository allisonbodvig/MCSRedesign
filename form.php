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
    
    <?php $values = $_POST['class']; ?>
    
    Show class to all users? 
    <input type="radio" name="active" value="Yes" <?php if ( 1 == $values[0] ) { echo "checked"; } ?> > Yes
    <input type="radio" name="active" value="No" <?php if ( 1 != $values[0] ) { echo "checked"; }?> > No
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
    Prerequisites:
    <?php
     foreach ($_POST['pre'] as $item)
     {
        $result = createLink($item);
        //prefix and number in $result[1], anything before in [0] and everything after in [2]
        
     }
    ?>
    
    
    <br><br>
    Corequisites:
    <?php
    include 'readXML.php';
    
    foreach ($_POST['co'] as $item)
    {
        
        
         
    }
    
    ?>
    
    <br/><br/>
    Notes:
    <br/>
    <textarea name="notes" rows="10" cols="50">
        <?php echo $values[7]; ?>
    </textarea>
    
    
    </fieldset>
        <?php

            /*if ($_POST['action'] && $_POST['class']) 
            {
                if ($_POST['action'] == 'Edit') 
                {
                    // edit the post with $_POST['id']
                    foreach ( $_POST['class'] as $item )
                    {
                        echo $item . "<br>";
                    }
                }
            }
            
            if ($_POST['action'] && $_POST['pre']) 
            {
                if ($_POST['action'] == 'Edit') 
                {
                    // edit the post with $_POST['id']
                    foreach ( $_POST['pre'] as $item )
                    {
                        echo $item . "<br>";
                    }
                }
            }
            
            if ($_POST['action'] && $_POST['co']) 
            {
                if ($_POST['action'] == 'Edit') 
                {
                    // edit the post with $_POST['id']
                    foreach ( $_POST['co'] as $item )
                    {
                        echo $item . "<br>";
                    }
                }
            }*/
            
            


        ?>
    </body>

</html>
