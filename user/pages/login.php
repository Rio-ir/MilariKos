<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Milarikos</title>
    <link rel="stylesheet" href="/User/assets/css/styles.css">
    <style>
        /* Body Styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #D7C38C;
    color: white;
}

/* Container Styling */
form {
    background: rgba(255, 255, 255, 0.9); /* Warna putih dengan transparansi */
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: 100%;
    max-width: 400px;
}

form h1 {
    color: black;
}
/* Form Elements */
form label {
    display: block;
    margin-bottom: 5px;
    font-size: 14px;
    color: #333;
}

form input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
}

form button {
    width: 100%;
    padding: 10px;
    background-color: #D7C38C;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color:rgb(187, 170, 122);
}

/* Link to Register */
form p {
    margin-top: 10px;
    font-size: 14px;
    color: #555;
}

form p a {
    color: #D7C38C;
    text-decoration: none;
    font-weight: bold;
}

form p a:hover {
    text-decoration: underline;
}

.form-container label {
    text-align: left;
}

    </style>
</head>
<body>
    <form class="form-container" action="/Milarikos-5/user/api/login.php" method="POST">
        <h1>Login</h1>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Masukkan username" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan password" required>

        <button type="submit">Masuk</button>
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </form>
</body>
</html>
