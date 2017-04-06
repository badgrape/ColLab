<?php

$alias = $argv[2];
	
$db = new mysqli("localhost", "jim", "s3ns3nn0s3n", "badgrape");

// insert new row
if ($argv[1] == 'insert') {

	$navigation = $argv[3];
	$keywords = $argv[4];
	$title = $argv[5];
	$filename = $argv[6];
	
	$file_handle = fopen($filename, "a+");
	$content = fread($file_handle, filesize($filename));
	fclose($file_handle);
//	$content = addslashes(htmlspecialchars($file));

	echo "\n$alias\n$navigation\n$keywords\n$title\n$filename\n$content\n";
	
	$insert = $db->prepare("insert into pages (alias, navigation, keywords, title, content) values (?, ?, ?, ?, ?)");
	$insert->bind_param("sssss", $alias, $navigation, $keywords, $title, $content);
		
	if (!$insert->execute()) {
		echo "\nInsert failed: (" . $stmt->errno . ") " . $stmt->error . "\n\n";
	}
	else {
		echo "\nData saved successfully!\n\n";
	}

	$insert->close();

}

// update row
elseif ($argv[1] == 'update') {

	$column = $argv[3];
	$value = $argv[4];
	
	if ($column == 'content') {
		$file_handle = fopen($value, "a+");
		$content = fread($file_handle, filesize($value));
		fclose($file_handle);
		$value = $content;
	}
	
	echo "\n$value\n";
	
	$update = $db->prepare("update pages set $column = ? where alias = ?");
	$update->bind_param("ss", $value, $alias);

	if (!$update->execute()) {
		echo "\nUpdate failed: (" . $stmt->errno . ") " . $stmt->error . "\n\n";
	}
	else {
		echo "\nData updated successfully!\n\n";
	}

	$update->close();

}

// dump row
elseif ($argv[1] == 'dump') {

	$html = $db->prepare("select * from pages where alias = ?");
	$html->bind_param("s", $alias);
	$html->execute();
	$html->bind_result($alias, $navigation, $keywords, $title, $content);
	$html->fetch();
	echo "\n$alias\n$navigation\n$keywords\n$title\n$content\n";
	$html->close();
	
	$filename = $alias . '.html';
	$file_handle = fopen($filename, "w+");
	if (fwrite($file_handle, $content)) {
		echo "\n$filename written successfully!!\n\n";
	}
	fclose($file_handle);

}

$db->close();

?>
