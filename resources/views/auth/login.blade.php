<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Access | Admin Door</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #000000;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            font-family: 'Fragment Mono', monospace;
        }
        .login-card {
            background-color: #ffffff;
            width: 100%;
            max-width: 400px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
            border: 10px solid #111;
        }
        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-logo h2 {
            letter-spacing: -2px;
            font-weight: 900;
            text-transform: uppercase;
        }
        .form-control {
            border: 1px solid #eee;
            border-radius: 0;
            padding: 12px;
            font-size: 0.9rem;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #000;
        }
        .btn-black {
            background-color: #000;
            color: #fff;
            border-radius: 0;
            padding: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            width: 100%;
            transition: all 0.3s;
        }
        .btn-black:hover {
            background-color: #333;
            color: #fff;
        }
        .error-list {
            list-style: none;
            padding: 0;
            color: #dc3545;
            font-size: 0.85rem;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-logo">
            <h2 class="mb-0">ADMIN</h2>
            <p class="text-muted small mb-0">SECURE DOORWAY</p>
        </div>

        @if ($errors->any())
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle me-1"></i> {{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label text-uppercase small fw-bold">Identification</label>
                <input type="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mb-4">
                <label class="form-label text-uppercase small fw-bold">Secret Key</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label small" for="remember">Stay active</label>
                </div>
            </div>

            <button type="submit" class="btn btn-black">AUTHENTICATE</button>
            
            <div class="text-center mt-4">
                <a href="/" class="text-muted small text-decoration-none">← Return Home</a>
            </div>
        </form>
    </div>
</body>
</html>
