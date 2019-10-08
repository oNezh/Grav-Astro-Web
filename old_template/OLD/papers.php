<!DOCTYPE HTML>
<html>
<head>
<title>Grav Astro Group Meeting: Discussion Papers</title>
<style type='text/css'>
body,table,th,td
{
  font-family: verdana, arial, helvetica, sans-serif;
  font-size: 10pt;
}
</style>
</head>
<body>
<h3>Grav Astro Group Meeting: Discussion Papers</h3>
<?php

$mlines  = array();
if ($handle = opendir('papers'))
{
  while (false !== ($file = readdir($handle)))
  {
    if (preg_match("/^(.+)\.txt$/", $file, $m))
    {
      $name = $m[1];
      $lines = file("papers/{$file}");
      foreach($lines as $line)
      {
        $line = trim($line);
        $fields = explode('|', $line);
        for($i = count($fields); $i < 4; $i++)
          array_push($fields, '');
        $name = str_replace('_', ' ', $name);
        $line = "{$fields[0]}|{$name}|{$fields[3]}|{$fields[1]}|{$fields[2]}";
        array_push($mlines, $line);
//        echo "$line<br>\n";
      }
    }
  }
  closedir($handle);

  echo "<table border='1' cellpadding='5' cellspacing='0'>\n";
  rsort($mlines);
  foreach($mlines as $line)
  {
    $fields = explode('|', $line);
    $bgcolor = $fields[2] ? '#66ff66' : '#fff8dc';
    echo "<tr bgcolor='{$bgcolor}'><td>{$fields[0]}</td><td>{$fields[1]}</td><td><a href='{$fields[4]}'>{$fields[3]}</a></td></tr>\n";
  }
  echo "</table>\n";
}

?>
</body>
</html>

