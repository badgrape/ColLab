<html>

<head>
<title>PHP form processing and database interaction</title>
</head>

<body>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	<label>Author: <input type="text" name="author" method="POST" /></label><br />
	<label>Title: <input type="text" name="title" method="POST" /></label><br />
	<label>Year published: <input type="text" name="date" method="POST" /></label><br />
<input type="submit" value="Upload!!" />

<?php

//If form data was submitted, then add it to the database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Database connection
	$db = new mysqli("localhost", "jim", "s3ns3nn0s3n", "books");
	// Convert form data into variables
	$author = $_POST['author'];
	$title = $_POST['title'];
	$date = $_POST['date'];
	// Uploading to database
	$new_book = "insert into favourites (title, author, pub_date) values ('$title', '$author', '$date')";
	
	// If it worked ...
	if ($db->query($new_book)) {
		echo "<p>Book data saved successfully!</p>";
	}
	// If it didn't work ... (error message)
	else {
		echo "<p>Attempt failed. Please try again later, or call tech support :P</p>" ; }
	// Disconnect from databasse
	$db->close();
}

?>

<p>

<?php

// Retrieve date from database and print it

// Connect
$db = new mysqli("localhost", "jim", "s3ns3nn0s3n", "books");
// Retreive data
$books = "select * from favourites";
$result = $db->query($books);
// Convert data into PhP arrays, one array for each table row
while ($row = $result->fetch_assoc()) {
	// Print array contents in readable form
	echo "{$row['author']} is the author of <em>{$row['title']}</em>, published in the year {$row['pub_date']}.<br />";
}
// Finished
$result->close();
// Disconnect
$db->close();

?>

</p>

</body>

</html>
