<?php
echo "start clear<br>";
$output = shell_exec('php ../app/console cache:clear');
echo "<pre>$output</pre>";

?>