<html>

<head>
<title>HTML dbase experiments</title>
</head>

<body>
<form enctype="multipart/form-data"
action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="10240"> File name: <input name="toProcess" type="file" />
<input type="submit" value="Upload" />
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if (is_uploaded_file($_FILES['toProcess']['tmp_name'])) {

		echo 'File uploaded!!';

		$filename = $_FILES['toProcess']['tmp_name'];
		$file_handle = fopen($filename, "a+");
		$file = fread($file_handle, filesize($filename));
		fclose($file_handle);
		
		$db = new mysqli("localhost", "jim", "s3ns3nn0s3n", "experiments");
		
		$html = $file;
		
		$output = htmlspecialchars($html);
		
		$ins_code = "insert into html (code) values ('$output')";
			
		if ($db->query($ins_code)) {
			echo "<p>HTML data saved successfully!</p>";
		}
		else {
			echo "<p>Attempt failed. Please try again later, or call tech support :P</p>";
		}
	}
	else {echo 'Upload failed :P';}

}
?>

<p><a href="db_file_download.php">Download file again</a></p>
</body>

</html>
