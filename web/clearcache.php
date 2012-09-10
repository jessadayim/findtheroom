<?php
echo "start clear<br>";
if($_GET)
    if($_GET['type']=='dev')
    {
        $output = shell_exec('php ../app/console cache:clear');
    }
    else
    {
        $output = shell_exec('php ../app/console cache:clear --env=prod --no-debug');
    }
else
{
    $output = shell_exec('php ../app/console cache:clear --env=prod --no-debug');
}
echo "<pre>$output</pre>";

?>