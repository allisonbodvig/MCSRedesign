<?php
  session_start();

if( isset($_POST["login"]))
{
  if(isset($_POST["username"]) && isset($_POST["password"]))
    {
      $_SESSION["username"] = $_POST["username"];
      if($_POST["password"] == "admin")
      {
        $_SESSION["admin"] = true;
      }
    }
}
if( isset($_POST["logout"]))
{
  session_unset();
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
