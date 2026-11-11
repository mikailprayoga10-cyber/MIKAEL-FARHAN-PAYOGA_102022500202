<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Bengkel Maintenance</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f8f9fa; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-card { background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .login-card h2 { color: #0b132b; margin-bottom: 20px; text-align: center; border-bottom: 3px solid #ffc107; padding-bottom: 10px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        .btn-login { width: 100%; padding: 12px; background-color: #0b132b; color: #ffc107; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; font-size: 16px; margin-top: 10px; }
        .btn-login:hover { background-color: #1c2a54; }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>Login Bengkel</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Login Email">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Password">
            </div>
            
            <button type="submit" class="btn-login">MASUK</button>
        </form>
    </div>

</body>
</html>