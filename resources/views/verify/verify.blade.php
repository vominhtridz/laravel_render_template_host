<!-- resources/views/emails/verify.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực Email của bạn</title>
    @vite('resources/js/app.js')
@vite('resources/css/app.css')

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            color:  #fff !important;
            background-color: #28a745;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Xác thực địa chỉ Email</h1>
        <p>Cảm ơn bạn đã đăng kí tài khoản tại website chúng tôi. Xui hãy xác nhận địa chỉ email chính chủ bằng cách nhấn vào nhút Xác Thực Email bên dưới:</p>
        <p>Xác nhận email của bạn trong 5 phút, sau thời gian này liên kết sẽ không còn hiệu lực.</p>
        <a href="{{ $linkVerifyEmail }}" class="button">Xác thực Email</a>
        <p>Cảm ơn bạn,<br>Website bán đồ điện tử</p>
    </div>
</body>
</html>
