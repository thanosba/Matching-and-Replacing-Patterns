<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>Make URL</title>
</head>
<body>
<?php
ini_set ('display_errors', 1);
error_reporting (E_ALL & ~E_NOTICE);

if ( isset ($_POST['submit'])) { // Has the form been submitted?

	// Trim off extraneous spaces, just in case.
	$url = trim ($_POST['url']);
	
	// Establish the patterns.
	$pattern1 = '^((http|https|ftp)://){1}([[:alnum:]-])+(\.)([[:alnum:]-]){2,3}([[:alnum:]/+=%&_.~?-]*)$';
	$pattern2 = '^([[:alnum:]-])+(\.)([[:alnum:]-]){2,3}([[:alnum:]/+=%&_.~?-]*)$';
	
	// Test the submitted value against the patterns.
	if (eregi ($pattern1, $url)) { // Check for an existing http/https/ftp.
	
		$url = eregi_replace ($pattern1, '<a href="\\0">\\0</a>', $url);
		print "<p>Here is the URL: $url<br />The code is now: " . htmlentities ($url) . '</p>';	
		
	} elseif (eregi ($pattern2, $url)) { // No http/https/ftp, add http://.
	
		$url = eregi_replace ($pattern2, '<a href="http://\\0">\\0</a>', $url);
		print "<p>Here is the URL: $url<br />The code is now: " . htmlentities ($url) . '</p>';	
		
	} else { // Invalid URL.
		print'<p>Please enter a valid URL.</p>';
	}
		
} // End of main conditional.
// Display the HTML form.
?>
<form action="convert_url.php" method="post">
<p>URL: <input type="text" name="url" size="30" /></p>
<input type="submit" name="submit" value="Convert" />
</form>
</body>
</html>
