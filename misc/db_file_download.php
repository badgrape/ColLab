<?php
$db = new mysqli("localhost", "jim", "s3ns3nn0s3n", "experiments");

$html = "select * from html";
$result = $db->query($html);
while ($row = $result->fetch_assoc()) {
	$string[] = $row['code'];
}
$result->close();

$db->close();

$str = $string[0];

$table = get_html_translation_table(HTML_SPECIALCHARS);
$revTrans = array_flip($table);
$file_contents = strtr($str, $revTrans);
$filename = tempnam('/tmp', "edit");
$file_handle = fopen($filename, "w+");
fwrite($file_handle, $file_contents);
fclose($file_handle);
header('Content-type: text/html');
header('Content-Disposition: attachment; filename="edit.html"');
readfile($filename);
unlink($filename);
?>
