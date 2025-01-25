<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İki Faktörlü Kimlik Doğrulama</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: linear-gradient(90deg, #ff9a9e, #fad0c4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .email-content {
            padding: 20px;
            text-align: center;
        }
        .email-content p {
            font-size: 16px;
            color: #333333;
            margin-bottom: 20px;
        }
        .code-box {
            display: inline-block;
            background-color: #e0f7fa;
            color: #00796b;
            font-size: 20px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 8px;
            border: 2px dashed #00796b;
            margin-top: 20px;
        }
        .email-footer {
            padding: 15px;
            text-align: center;
            font-size: 14px;
            background-color: #f8f9fa;
            color: #555555;
            border-top: 1px solid #eeeeee;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h1>Merhaba</h1>
    </div>
    <div class="email-content">
        <p>İki faktörlü kimlik doğrulama kodunuz:</p>
        <div class="code-box">{{ $code }}</div>
        <p>Eğer bu giriş işlemini siz gerçekleştirmediyseniz, lütfen hesabınızı korumak için şifrenizi hemen değiştirin.</p>
    </div>
    <div class="email-footer">
        <p><a href="{{ config('app.url') }}">{{ config('filament-2fa.email_app_name', 'Hadi Öde') }}</a></p>
    </div>
</div>
</body>
</html>
