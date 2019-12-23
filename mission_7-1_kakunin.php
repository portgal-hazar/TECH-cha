<!DOCTYPE html>
<html lang = "ja">
	<head>
		<meta charset = "UTF-8">
	<title>予約確認画面</title>
	</head>
	<body>
	<center><h1>予約確認</h1>
	<form method="POST" action = "mission_7-1_kakunin.php">
	<table border="1">
	<tr>
		<th bgcolor=b0c4de>予約番号</th>
		<th><input type="text" name="registernumber" value="<?php echo $_POST['number']; ?>">
	</tr>
	<tr>
		<th bgcolor=b0c4de>ご選択日時</th>
		<th><input type="text" name="date" value="" placeholder="日時">
	</tr>
	<tr>
		<th bgcolor=b0c4de>お名前</th>
		<th><input type="text" name="name" value="<?php echo $name; ?>" placeholder="お名前">
	</tr>
	<tr>
		<th bgcolor=b0c4de>電話番号(半角)</th>
		<th><input type="text" name="phone_number" value="" placeholder="電話番号">
	</tr>
	<tr>
		<th bgcolor=b0c4de>メールアドレス(半角)</th>
		<th><input type="text" name="mail" value="<?php echo $email; ?>" placeholder="メールアドレス">
	</tr>
	<tr>
		<th bgcolor=b0c4de>性別</th>
		<th><select seibetu="seibetu" id="seibetu">
			<option value="what">--- 選択してください ---</option>
			<option value="男性">男性</option>
			<option value="女性">女性</option>
			<option value="その他">その他</option>
		</select>
	</tr>
	</table>
		
<br><br><input type="submit" name="yoyaku" value="予約する"></center>
	</form>
</body>
</html>
<?php 

session_start();

$name="";
$mail="";

$dsn = 'mysql:dbname=データベース名;host=localhost';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

//sessionでログイン情報獲得
$userid = $_SESSION["nicname"];
$sql = "SELECT*FROM defreg2 WHERE nicname=:nicname"; 
	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(":nicname", $userid, PDO::PARAM_STR);
	$results=$stmt->fetchall();
foreach($results as $row){
	$name=$row["nicname"];
	$email=$row["newmail"];
}

if(empty($_POST["yoyaku"])){
	echo "空欄を埋めてください!!";
}else{
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		$id=$_POST["registernumber"];
		$sql="SELECT * FROM mission7 WHERE id=:id";
		$send=$pdo->prepare($sql);
		$send->bindParam(":id", $id, PDO::PARAM_INT);
		$newmail=$send->fetchall();
	foreach($newmail as $host){
		$host_name=$host["nicname"];
		$host_mail=$host["newmail"];
	}
		
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'setting.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->isSMTP();  
    $mail->SMTPAuth = true;
    $mail->Host = MAIL_HOST;  
    $mail->Username = MAIL_USERNAME;  
    $mail->Password = MAIL_PASSWORD;  
    $mail->SMTPSecure = MAIL_ENCRPT;  
    $mail->Port = SMTP_PORT; 

    // メール内容設定
    $mail->CharSet = "UTF-8";
    $mail->Encoding = "base64";
    $mail->setFrom(MAIL_FROM,MAIL_FROM_NAME);
    $mail->addAddress('$_POST["mail"]', '$_POST["name"]'); 
    $mail->addAddress("$host_mail","$host_mail");
    $mail->Subject = MAIL_SUBJECT; 
    $mail->isHTML(true);    
    $body = "以下の内容で予約しました！確認してください。"."<br>" $_POST["registernumber"]." ". $_POST["name"]." ". $_POST["date"]." ". $_POST["phone_number"].;

    $mail->Body  = $body; // メール本文
    // メール送信の実行
    if(!$mail->send()) {
    	echo 'メッセージは送られませんでした！';
    	echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
    	echo 'メールをおくりました。確認してください!!';
    }

}
?>
