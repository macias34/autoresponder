<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .content {
            padding: 20px;
        }

        .content h1 {
            font-size: 24px;
            color: #333333;
        }

        .content p {
            font-size: 16px;
            color: #666666;
            line-height: 1.5;
        }

        .footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #999999;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 4px;
        }

        @media (max-width: 600px) {
            .container {
                border-radius: 0;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Customer Support Response</h1>
    </div>
    <div class="content">
        <h1>Dear {{ $email->personal }},</h1>
        <p>Thank you for reaching out to us with your question. We appreciate your interest in our services and are here
            to assist you.</p>
        <p><strong>Your Question:</strong> {{ $email->text }}</p>
        <p><strong>Our Response:</strong> We have reviewed your inquiry and are happy to provide you with the following
            information:</p>
        <p>{{ $email->response }}</p>
        <p>If you need any further assistance or have additional questions, please do not hesitate to contact us. We are
            here to help you 24/7.</p>
        <a href="#" class="button">Contact Support</a>
    </div>
    <div class="footer">
        &copy; 2024 Our Service. All rights reserved.
    </div>
</div>
</body>
</html>
