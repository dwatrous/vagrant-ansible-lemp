<?php

// database credentials (defined in group_vars/all)
$dbname = "dbtest";
$dbuser = "dbuser";
$dbpass = "secret";
$dbhost = "192.168.52.4";

// query templates
$create_table = "CREATE TABLE IF NOT EXISTS `wall` (
   `id` int(11) unsigned NOT NULL auto_increment,
   `title` varchar(255) NOT NULL default '',
   `content` text NOT NULL default '',
   PRIMARY KEY  (`id`)
   ) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
$select_wall = 'SELECT * FROM wall';

// Connect to and select database
$link = mysql_connect($dbhost, $dbuser, $dbpass)
    or die('Could not connect: ' . mysql_error());
echo "Connected successfully\n<br />\n";
mysql_select_db($dbname) or die('Could not select database');

// create table
$result = mysql_query($create_table) or die('Create Table failed: ' . mysql_error());

// handle new wall posts
if (isset($_POST["title"])) {
    $result = mysql_query("insert into wall (title, content) values ('".$_POST["title"]."', '".$_POST["content"]."')") or die('Create Table failed: ' . mysql_error());
}

// Performing SQL query
$result = mysql_query($select_wall) or die('Query failed: ' . mysql_error());

// Printing results in HTML
echo "<table>\n";
while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Free resultset
mysql_free_result($result);

// Closing connection
mysql_close($link);
?>

<form method="post">
Title: <input type="text" name="title"><br />
Message: <textarea name="content"></textarea><br />
<input type="submit" value="Post to wall">
</form>
