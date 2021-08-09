<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Email</title>
</head>
<body>
	<p>{{ $name }}</p>
	<p>{{ $email }}</p>
	<?php $id = base64_encode($id); ?>
	<a href="http://127.0.0.1:8000/gantiPassword/{{ $id }}">Reset Password</a>
</body>
</html>