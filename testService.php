<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>WEB SERVICE TEST</title>
</head>
<body>
	<form action="" method="post">
	<table border=0>
		<tr>
			<td> Target </td> <td>:</td>
			<td><input type="text" name="url" value="<?php echo isset($_POST['url'])?$_POST['url']:'http://phpdemo2.quagnitia.com/cardsleaf/webservices/webservices/'?>" size="150">
			</td>
			</tr>
		<tr>
		<td> Params</td>
		<td>:</td>
		<td>
		<input type="text" name="params" value="<?php echo isset($_POST['params'])?$_POST['params']:''?>" size="150">
		</td>
		</tr>
		<tr>
		<td> <input type="submit" name="submit" value="submit">
		</td><td> &nbsp;</td>
		<td><input type="reset" name="reset" value="reset" onclick="window.location=''"></td>
		</tr>
	</table>
	</form>
	<hr/>
</body>
</html>
<?php
if(isset($_POST['submit'])){		
	$paramArr = array();
	if(strlen($_POST['params'])>0){
	$tempParamArr = explode(',',$_POST['params']);
		
		foreach ($tempParamArr as $param){
			$temp = explode(':',$param);	
			$newTempParam = $temp[0].':'.$temp[1];
			$paramArr[] =  $newTempParam;
		}
		print 'parameters : <pre>';
		print_r($paramArr);
		print '</pre><hr/>';
	}
	else print 'No parameters passed.<hr/>';
	

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL,$_POST['url']);
curl_setopt($ch,CURLOPT_HTTPHEADER,$paramArr);
$data = curl_exec($ch);
echo "<div  style='word-wrap: break-word; width: 100%;'>{$data}</div>";
$info = curl_getinfo($ch);
echo"<hr/>";
echo "<div  style='word-wrap: break-word; width: 100%;'>".base64_decode($data)."</div>";
echo"<hr/>";
echo "Script took total ".$info['total_time']." Seconds";

}
        
?>