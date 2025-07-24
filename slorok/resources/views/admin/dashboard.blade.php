<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Selamat datang, {{ $user['name'] }}</h1>
    <p>Email: {{ $user['email'] }}</p>

    <a href="/logout">Logout</a>
</body>
</html>
