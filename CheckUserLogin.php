<script>
function myFunc()
	{
		alert("Please Fill All The Blanks.");
		window.location="index.html";
	}
	
	function noFunc()
	{
		alert("incorrect password");
		window.location="index.html";
	}
	
  </script>
    <?php
    include_once("dbconnect.php");
    $db = new Database();
    $db->connect();

    $tbl_name="user_login";

    $myusername=$_POST['user'];
    $mypassword=$_POST['pass'];

    if($myusername!="" && $mypassword!="")
    {
    $sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
    $res=$db->selectData($sql);
    $count=mysqli_num_rows($res);
    if($count==1)
    {
      $row=mysqli_fetch_row($res);
      session_start();
      $_SESSION['user']=$row[1];

      header("location:home.php");
    }
    else {
	  echo "<script type='text/javascript'>noFunc()</script>";
    
    }
  }
  else
  {
      echo "<script type='text/javascript'>myFunc()</script>";
  }
?>
