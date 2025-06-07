<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác minh thành công</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
        }
        .container h1 {
            font-size: 24px;
            color: #4CAF50;
        }
        .container p {
            font-size: 16px;
            color: #333;
            margin: 10px 0;
        }
        .container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
        }
        .container a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Xác minh thành công!</h1>
        <p>Tài khoản của bạn đã được xác minh thành công. Bạn có thể quay lại và đăng nhập.</p>
        <a href="{{ route('login') }}">Quay về trang đăng nhập</a>
    </div>
</body>
</html>