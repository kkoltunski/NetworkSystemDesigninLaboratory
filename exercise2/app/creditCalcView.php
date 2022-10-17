<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Credit Calculator</title>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>

<?php include _ROOT_PATH.'\app\security\check.php'; ?>

<div style="width:90%; margin: 2em auto;">
	<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Logout</a>
</div>
<div style="width:90%; margin: 2em auto;">

<form action="<?php print(_APP_URL);?>/app/creditCalc.php" method="post">
	<label for="id_x">Amount: </label>
	<input id="id_x" type="text" name="x" value="<?php isset($x)?print($x):''; ?>" /><br />
	<label for="id_y">Years count: </label>
	<input id="id_y" type="text" name="y" value="<?php isset($y)?print($y):''; ?>" /><br />
	<label for="id_z">Interest rate: </label>
	<input id="id_z" type="text" name="z" value="<?php isset($z)?print($z):''; ?>" /><br />
	<input type="submit" value="Check" />
</form>

<?php
if (isset($messages)) 
{
	if (count ( $messages ) > 0) 
	{
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $messages as $key => $msg ) 
		{
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
<?php echo 'Monthly: '.$result; ?>
</div>
<?php } ?>

</div>

</body>
</html>