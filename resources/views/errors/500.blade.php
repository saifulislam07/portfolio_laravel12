<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Fragment+Mono&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #000000;
            color: #ffffff;
            font-family: 'Fragment Mono', monospace;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
        }
        .error-container {
            text-align: center;
            padding: 2rem;
            border: 1px solid #ffffff;
            max-width: 500px;
            width: 90%;
        }
        .error-code {
            font-family: 'Playfair Display', serif;
            font-size: 120px;
            line-height: 1;
            margin-bottom: 20px;
            letter-spacing: -5px;
        }
        .error-message {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 14px;
            margin-bottom: 30px;
        }
        .btn-back {
            background-color: #ffffff;
            color: #000000;
            text-decoration: none;
            padding: 12px 30px;
            font-size: 12px;
            display: inline-block;
            transition: all 0.3s ease;
            border: 1px solid #ffffff;
        }
        .btn-back:hover {
            background-color: #000000;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">500</div>
        <div class="error-message">Something went wrong on our end. We are working to fix it.</div>
        <a href="/" class="btn-back">RELOAD PAGE</a>
    </div>
</body>
</html>
