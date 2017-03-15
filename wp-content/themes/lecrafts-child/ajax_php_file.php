<?php
session_start();
date_default_timezone_set("UTC");
if(isset($_FILES["file1"]["type"]) && isset($_POST['medium1']) && isset($_POST['width1']) && isset($_POST['height1']) && isset($_POST['depth1']) && isset($_POST['year1']))
{
	
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["file1"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["file1"]["type"] == "image/png") || ($_FILES["file1"]["type"] == "image/jpg") || ($_FILES["file1"]["type"] == "image/jpeg")
	) && ($_FILES["file1"]["size"] < 1024000)//Approx. 100kb files can be uploaded.
	&& in_array($file_extension, $validextensions)) {
		if ($_FILES["file1"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file1"]["error"] . "<br/><br/>";
		}
		else
		{
			if (file_exists("upload/" . $_FILES["file1"]["name"])) {
				echo $_FILES["file1"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
			}
			else
			{
				$sourcePath = $_FILES['file1']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = '/home/artsplus/public_html/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file1']['name'];
                $_SESSION['artwork1'] = '/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file1']['name'];
				$_SESSION['width1']  = $_POST['width1'];
				$_SESSION['height1'] = $_POST['height1'];
				$_SESSION['depth1']  = $_POST['depth1'];
				$_SESSION['year1']   = $_POST['year1'];
				$_SESSION['medium1'] = $_POST['medium1'];
				$_SESSION['artname1']    =$_FILES['file1']['name'];
				$_SESSION['type1']    = $_FILES['file1']['type'];
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				echo "success";
			}
		}
	}
	else
	{
		echo "Invalid";
	}
}
if(isset($_FILES["file2"]["type"]) && isset($_POST['medium2']) && isset($_POST['width2']) && isset($_POST['height2']) && isset($_POST['depth2']) && isset($_POST['year2']))
{
	
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["file2"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["file2"]["type"] == "image/png") || ($_FILES["file2"]["type"] == "image/jpg") || ($_FILES["file2"]["type"] == "image/jpeg")
	) && ($_FILES["file2"]["size"] < 1024000)) {
		if ($_FILES["file2"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file2"]["error"] . "<br/><br/>";
		}
		else
		{
			if (file_exists("upload/" . $_FILES["file2"]["name"])) {
				echo $_FILES["file2"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
			}
			else
			{
				$sourcePath = $_FILES['file2']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = '/home/artsplus/public_html/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file2']['name'];
                $_SESSION['artwork2'] = '/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file2']['name'];
				$_SESSION['width2']  = $_POST['width2'];
				$_SESSION['height2'] = $_POST['height2'];
				$_SESSION['depth2']  = $_POST['depth2'];
				$_SESSION['year2']   = $_POST['year2'];
				$_SESSION['medium2'] = $_POST['medium2'];
				$_SESSION['artname2']    =$_FILES['file2']['name'];
				$_SESSION['type2']    = $_FILES['file2']['type'];
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				echo "success";
			}
		}
	}
	else
	{
		echo "Invalid";
	}
}
if(isset($_FILES["file3"]["type"]) && isset($_POST['medium3']) && isset($_POST['width3']) && isset($_POST['height3']) && isset($_POST['depth3']) && isset($_POST['year3']))
{
	
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["file3"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["file3"]["type"] == "image/png") || ($_FILES["file3"]["type"] == "image/jpg") || ($_FILES["file3"]["type"] == "image/jpeg")
	) && ($_FILES["file3"]["size"] < 1024000)) {
		if ($_FILES["file3"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file3"]["error"] . "<br/><br/>";
		}
		else
		{
			if (file_exists("upload/" . $_FILES["file3"]["name"])) {
				echo $_FILES["file3"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
			}
			else
			{
				$sourcePath = $_FILES['file3']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = '/home/artsplus/public_html/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file3']['name'];
                $_SESSION['artwork3'] = '/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file3']['name'];
				$_SESSION['width3']  = $_POST['width3'];
				$_SESSION['height3'] = $_POST['height3'];
				$_SESSION['depth3']  = $_POST['depth3'];
				$_SESSION['year3']   = $_POST['year3'];
				$_SESSION['medium3'] = $_POST['medium3'];
				$_SESSION['artname3']    =$_FILES['file3']['name'];
				$_SESSION['type3']    = $_FILES['file3']['type'];
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				echo "success";
			}
		}
	}
	else
	{
		echo "Invalid";
	}
}
if(isset($_FILES["file4"]["type"]) && isset($_POST['medium4']) && isset($_POST['width4']) && isset($_POST['height4']) && isset($_POST['depth4']) && isset($_POST['year4']))
{
	
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["file4"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["file4"]["type"] == "image/png") || ($_FILES["file4"]["type"] == "image/jpg") || ($_FILES["file4"]["type"] == "image/jpeg")
	) && ($_FILES["file4"]["size"] < 1024000)) {
		if ($_FILES["file4"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file4"]["error"] . "<br/><br/>";
		}
		else
		{
			if (file_exists("upload/" . $_FILES["file4"]["name"])) {
				echo $_FILES["file4"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
			}
			else
			{
				$sourcePath = $_FILES['file4']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = '/home/artsplus/public_html/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file4']['name'];
                $_SESSION['artwork4'] = '/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file4']['name'];
				$_SESSION['width4']  = $_POST['width4'];
				$_SESSION['height4'] = $_POST['height4'];
				$_SESSION['depth4']  = $_POST['depth4'];
				$_SESSION['year4']   = $_POST['year4'];
				$_SESSION['medium4'] = $_POST['medium4'];
				$_SESSION['artname4']    =$_FILES['file4']['name'];
				$_SESSION['type4']    = $_FILES['file4']['type'];
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				echo "success";
			}
		}
	}
	else
	{
		echo "Invalid";
	}
}
if(isset($_FILES["file5"]["type"]) && isset($_POST['medium5']) && isset($_POST['width5']) && isset($_POST['height5']) && isset($_POST['depth5']) && isset($_POST['year5']))
{
	
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["file5"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["file5"]["type"] == "image/png") || ($_FILES["file5"]["type"] == "image/jpg") || ($_FILES["file5"]["type"] == "image/jpeg")
	) && ($_FILES["file5"]["size"] < 1024000)) {
		if ($_FILES["file5"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file5"]["error"] . "<br/><br/>";
		}
		else
		{
			if (file_exists("upload/" . $_FILES["file5"]["name"])) {
				echo $_FILES["file5"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
			}
			else
			{
				$sourcePath = $_FILES['file5']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = '/home/artsplus/public_html/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file5']['name'];
                $_SESSION['artwork5'] = '/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file5']['name'];
				$_SESSION['width5']  = $_POST['width5'];
				$_SESSION['height5'] = $_POST['height5'];
				$_SESSION['depth5']  = $_POST['depth5'];
				$_SESSION['year5']   = $_POST['year5'];
				$_SESSION['medium5'] = $_POST['medium5'];
				$_SESSION['artname5']    =$_FILES['file5']['name'];
				$_SESSION['type5']    = $_FILES['file5']['type'];
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				echo "success";
			}
		}
	}
	else
	{
		echo "Invalid";
	}
}
if(isset($_FILES["file6"]["type"]) && isset($_POST['medium6']) && isset($_POST['width6']) && isset($_POST['height6']) && isset($_POST['depth6']) && isset($_POST['year6']))
{
	
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["file6"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["file6"]["type"] == "image/png") || ($_FILES["file6"]["type"] == "image/jpg") || ($_FILES["file6"]["type"] == "image/jpeg")
	) && ($_FILES["file6"]["size"] < 1024000)) {
		if ($_FILES["file6"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file6"]["error"] . "<br/><br/>";
		}
		else
		{
			if (file_exists("upload/" . $_FILES["file6"]["name"])) {
				echo $_FILES["file6"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
			}
			else
			{
				$sourcePath = $_FILES['file6']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = '/home/artsplus/public_html/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file6']['name'];
                $_SESSION['artwork6'] = '/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file6']['name'];
				$_SESSION['width6']  = $_POST['width6'];
				$_SESSION['height6'] = $_POST['height6'];
				$_SESSION['depth6']  = $_POST['depth6'];
				$_SESSION['year6']   = $_POST['year6'];
				$_SESSION['medium6'] = $_POST['medium6'];
				$_SESSION['artname6']    =$_FILES['file6']['name'];
				$_SESSION['type6']    = $_FILES['file6']['type'];
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				echo "success";
			}
		}
	}
	else
	{
		echo "Invalid";
	}
}
if(isset($_FILES["file7"]["type"]) && isset($_POST['medium7']) && isset($_POST['width7']) && isset($_POST['height7']) && isset($_POST['depth7']) && isset($_POST['year7']))
{
	
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["file7"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["file7"]["type"] == "image/png") || ($_FILES["file7"]["type"] == "image/jpg") || ($_FILES["file7"]["type"] == "image/jpeg")
	) && ($_FILES["file7"]["size"] < 1024000)) {
		if ($_FILES["file7"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file7"]["error"] . "<br/><br/>";
		}
		else
		{
			if (file_exists("upload/" . $_FILES["file7"]["name"])) {
				echo $_FILES["file7"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
			}
			else
			{
				$sourcePath = $_FILES['file7']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = '/home/artsplus/public_html/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file7']['name'];
                $_SESSION['artwork7'] = '/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file7']['name'];
				$_SESSION['width7']  = $_POST['width7'];
				$_SESSION['height7'] = $_POST['height7'];
				$_SESSION['depth7']  = $_POST['depth7'];
				$_SESSION['year7']   = $_POST['year7'];
				$_SESSION['medium7'] = $_POST['medium7'];
				$_SESSION['artname7']    =$_FILES['file7']['name'];
				$_SESSION['type7']    = $_FILES['file7']['type'];
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				echo "success";
			}
		}
	}
	else
	{
		echo "Invalid";
	}
}
if(isset($_FILES["file8"]["type"]) && isset($_POST['medium8']) && isset($_POST['width8']) && isset($_POST['height8']) && isset($_POST['depth8']) && isset($_POST['year8']))
{
	
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["file8"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["file8"]["type"] == "image/png") || ($_FILES["file8"]["type"] == "image/jpg") || ($_FILES["file8"]["type"] == "image/jpeg")
	) && ($_FILES["file8"]["size"] < 1024000)) {
		if ($_FILES["file8"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file8"]["error"] . "<br/><br/>";
		}
		else
		{
			if (file_exists("upload/" . $_FILES["file8"]["name"])) {
				echo $_FILES["file8"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
			}
			else
			{
				$sourcePath = $_FILES['file8']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = '/home/artsplus/public_html/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file8']['name'];
                $_SESSION['artwork8'] = '/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file8']['name'];
				$_SESSION['width8']  = $_POST['width8'];
				$_SESSION['height8'] = $_POST['height8'];
				$_SESSION['depth8']  = $_POST['depth8'];
				$_SESSION['year8']   = $_POST['year8'];
				$_SESSION['medium8'] = $_POST['medium8'];
				$_SESSION['artname8']    =$_FILES['file8']['name'];
				$_SESSION['type8']    = $_FILES['file8']['type'];
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				echo "success";
			}
		}
	}
	else
	{
		echo "Invalid";
	}
}
if(isset($_FILES["file9"]["type"]) && isset($_POST['medium9']) && isset($_POST['width9']) && isset($_POST['height9']) && isset($_POST['depth9']) && isset($_POST['year9']))
{
	
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["file9"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["file9"]["type"] == "image/png") || ($_FILES["file9"]["type"] == "image/jpg") || ($_FILES["file9"]["type"] == "image/jpeg")
	) && ($_FILES["file9"]["size"] < 1024000)) {
		if ($_FILES["file9"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file9"]["error"] . "<br/><br/>";
		}
		else
		{
			if (file_exists("upload/" . $_FILES["file9"]["name"])) {
				echo $_FILES["file9"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
			}
			else
			{
				$sourcePath = $_FILES['file9']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = '/home/artsplus/public_html/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file9']['name'];
				$_SESSION['width9']  = $_POST['width9'];
				$_SESSION['height9'] = $_POST['height9'];
				$_SESSION['depth9']  = $_POST['depth9'];
				$_SESSION['year9']   = $_POST['year9'];
				$_SESSION['medium9'] = $_POST['medium9'];
				$_SESSION['artname9']    =$_FILES['file9']['name'];
				$_SESSION['type9']    = $_FILES['file9']['type'];
                $_SESSION['artwork9'] = '/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file9']['name'];
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				echo "success";
			}
		}
	}
	else
	{
		echo "Invalid";
	}
}
if(isset($_FILES["file10"]["type"]) && isset($_POST['medium10']) && isset($_POST['width10']) && isset($_POST['height10']) && isset($_POST['depth10']) && isset($_POST['year10']))
{
	
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["file10"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["file10"]["type"] == "image/png") || ($_FILES["file10"]["type"] == "image/jpg") || ($_FILES["file10"]["type"] == "image/jpeg")
	) && ($_FILES["file10"]["size"] < 1024000)) {
		if ($_FILES["file10"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["file10"]["error"] . "<br/><br/>";
		}
		else
		{
			if (file_exists("upload/" . $_FILES["file10"]["name"])) {
				echo "already exists.";
			}
			else
			{
				$sourcePath = $_FILES['file10']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = '/home/artsplus/public_html/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file10']['name'];
                $_SESSION['artwork10'] = '/wp-content' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . $_FILES['file10']['name'];
				$_SESSION['width10']  = $_POST['width10'];
				$_SESSION['height10'] = $_POST['height10'];
				$_SESSION['depth10']  = $_POST['depth10'];
				$_SESSION['year10']   = $_POST['year10'];
				$_SESSION['medium10'] = $_POST['medium10'];
				$_SESSION['artname10']    =$_FILES['file10']['name'];
				$_SESSION['type10']    = $_FILES['file10']['type'];
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				echo "success";
			}
		}
	}
	else
	{
		echo "Invalid";
	}
}
?>