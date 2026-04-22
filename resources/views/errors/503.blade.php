<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>503 - Under Maintenance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Fragment+Mono&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            color: #000000;
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
            padding: 3rem;
            border: 2px solid #000000;
            max-width: 600px;
            width: 90%;
        }
        .error-code {
            font-family: 'Playfair Display', serif;
            font-size: 80px;
            line-height: 1;
            margin-bottom: 20px;
        }
        .error-message {
            text-transform: uppercase;
            letter-spacing: 3px;
            font-size: 16px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .description {
            font-size: 12px;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .loading-bar {
            height: 2px;
            background-color: #eeeeee;
            width: 100%;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }
        .loading-bar::after {
            content: '';
            position: absolute;
            left: -50%;
            height: 100%;
            width: 50%;
            background-color: #000000;
            animation: loading 2s infinite linear;
        }
        @keyframes loading {
            0% { left: -50%; }
            100% { left: 100%; }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">503</div>
        <div class="error-message">Maintenance Mode</div>
        <div class="loading-bar"></div>
        <div class="description">We are currently performing scheduled maintenance to improve your experience. Please check back shortly.</div>
        <div class="small fw-bold">MD SAIFUL ISLAM | PORTFOLIO</div>
    </div>
</body>
</html>
