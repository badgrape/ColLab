<?php
echo "<?xml version='1.0' encoding='UTF-8'?>\n";
?>
<!DOCTYPE
	html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<?php

if (isset($_GET['page'])) {$url = $_GET['page'];}
else {$url = 'home';}

$db = new mysqli("localhost", "jim", "s3ns3nn0s3n", "badgrape");

$html = $db->prepare("select * from pages where alias = ?");
$html->bind_param("s", $url);
$html->execute();
$html->bind_result($alias, $navigation, $keywords, $title, $content);
$html->fetch();

?>

<head>
<link rel="icon" type="image/png"  href="/badgrape_icon.png" />
<link rel="stylesheet" type="text/css" href="badgrape.css">
<title><?php echo $title; ?></title>
<meta name="keywords" content="<?php echo $keywords; ?>">
</head>

<body> 
<div id="visible">

<div id="header">

<a href="/">
<img src="/badgrape_600.jpg" />
</a>

<div id="nav">

<?php

$nav = array(
	// url, class, text
	array("web-design", null, "Web design"),
	array("knits", "contrast", "Knits"),
	array("illustrations", "contrast", "Illustrations"),
	array("bio", null, "Bio"),
	array("contact", null, "Contact")
);

$count = count($nav);
$link = 0;

?>

<ul>

<?php
// write navigation menu
foreach ($nav as $value) {
	$link += 1;
	echo "<li><a href='$value[0]'";
	if (isset($value[1])) {
		echo " class='$value[1]'";
	}
	echo ">$value[2]</a></li>\n";
	if ($link % 2 == 0 && $link !== $count) {
		echo "</ul>\n<ul>\n";
	}
}

?>

</ul>

</div>
</div>

<div id="main">
<?php

if ($url == $alias) {

//	$str = $content;
//	$table = get_html_translation_table(HTML_SPECIALCHARS);
//	$revTrans = array_flip($table);
//	$content = strtr($str, $revTrans);
	echo $content;
	
/*	echo '<pre>';
	foreach ($row as $output) {
		echo "$output\n";
	}
	echo '</pre>'; */

}

else {
	echo "<p id='pagenotfound'>Page not found. Silly monkey.</p>";
}
?>

</div>
</div>

</body>

<?php
$html->close();
$db->close();
?>

</html>
