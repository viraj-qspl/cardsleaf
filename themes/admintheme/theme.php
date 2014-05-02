<?php
$func_name = $this->router->fetch_method();
if($func_name == 'login')
{
	include("login_header.php");
}
else
{
	include("header.php");
	include("top_menu.php");
}

echo $content;

if($func_name == 'login')
{
	include("login_footer.php");
}
else
{
	include("footer.php");
}
?>

