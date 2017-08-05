<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>QR code</title>
</head>
<body>
	<form method="post">
		Name: <input type="text" name="name" required/>
		Who is this: <input type="text" name="whoisthis" required/>
		
		<input type="submit" name="" value= "Gerar" />
		
		<input type="hidden" name= "gerou" value="S" />


	</form>


	<?php
//set it to writable location, a place for _SESSION generated PNG files
	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp/user'.DIRECTORY_SEPARATOR;

	 //html PNG location prefix
	$PNG_WEB_DIR = 'temp/user.png';

	if (isset ($_POST['gerou'])){
		require ("lib/phpqrcode/qrlib.php");

  //ofcourse we need rights to create temp dir
		if (!file_exists($PNG_TEMP_DIR))
			mkdir($PNG_TEMP_DIR);

		$filename = $PNG_TEMP_DIR.'temp/user.png';

		$name = $_POST['name'];
		$whoisthis = $_POST['whoisthis'];

		$cv = 'Name: ' .$name . 'Who is this: ' .$whoisthis . "\n";
					

	function image(){
		echo '<img src="temp/user.png"/>'; 
	}
		QRcode::png($cv, "temp/user.png", QR_ECLEVEL_L);
	image();
}




/*
$address = "admin@gmail.com"; // кому 
	$sub = "QR code - проверка при получения"; // тема
	$mail = 'info@com';							// от кого

  $list = "http://c3.1.allcool.in.ua/temp/user.png";
	$mes = " \n
	Ф.И.О: $name \n
	QR code: $list";


	$send = mail($address,$sub,$mes,"Content-type:text/plain; charset = UTF-8\r\nFrom:$mail");	
	if ($send == 'true') 
		{echo "Ваше сообщение отправлено";}
	else {echo "Ошибка, сообщение не отправлено";}
	*/
	?>

		<form method="post">
		
		<input type="submit" name="Send" value= "Отправить" />
		
		<input type="hidden" name= "gerou2" value="S" />

	</form>

<?php	
//include "lib/libmail.php";

if (isset ($_POST['gerou2'])){
		require ("lib/libmail.php");
		
$m=new Mail();		
$m->From( "Дмитрий;info@com" );
$m->To( "admin@gmail.com" ); 
$m->Subject( "Анкета" );
                               
$m->Body( 'Первая картинка <br> <img src="http://..">, 
					<br>QR code <img src="http://c3.1.allcool.in.ua/temp/user.png">,
					<br> и так далее', "html");//вложение в письмо. Почемуто не фурычет
$m->Priority(4);
$m->Attach( "temp/user.png", "QR code.jpeg", "");//Прикрепление к письму. 1-укзивает сам файл. 2-имя файла.
$m->Send();
echo "Письмо отправлено, вот исходный текст письма:<br><pre>";
}
?>
</body>
</html>