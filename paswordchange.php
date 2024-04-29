<?php
	session_start();
	include("dbconnection.php");
	if(isset($_POST['Submit']))
		{
			$oldpass=md5($_POST['opwd']);
			$useremail=$_SESSION['login'];
			$newpassword=md5($_POST['npwd']);
			$sql=mysqli_query($con,"SELECT password FROM userinfo where password='$oldpass' && email='$useremail'");
			$num=mysqli_fetch_array($sql);
			if($num>0)
				{
					$con=mysqli_query($con,"update userinfo set password=' $newpassword' where email='$useremail'");
					$_SESSION['msg1']="Password Changed Successfully !!";
				}
			else
				{
					$_SESSION['msg1']="Old Password not match !!";
				}
		}
?>