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
		<th><input type="text" name="registernum" value="<?php echo $_POST['number']; ?>">
	</tr>
	<tr>
		<th bgcolor=b0c4de>ご選択日時</th>
		<th><input type="text" name="date" value="" placeholder="日時">
	</tr>
	<tr>
		<th bgcolor=b0c4de>お名前</th>
		<th><input type="text" name="name" value="" placeholder="お名前">
	</tr>
	<tr>
		<th bgcolor=b0c4de>電話番号(半角)</th>
		<th><input type="text" name="phone_number" value="" placeholder="電話番号">
	</tr>
	<tr>
		<th bgcolor=b0c4de>メールアドレス(半角)</th>
		<th><input type="text" name="mail" value="" placeholder="メールアドレス">
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

