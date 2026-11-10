
<?php
session_start();
include 'koneksi.php';

$pesan = "";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_prepare($conn,
        "SELECT * FROM users WHERE username = ?"
    );

    mysqli_stmt_bind_param($query, "s", $username);
    mysqli_stmt_execute($query);

    $result = mysqli_stmt_get_result($query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {

        session_regenerate_id(true);

        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama'] = $user['nama'];

        header("Location: admin.php");
        exit;

    } else {
        $pesan = "Username atau password salah!";
    }
}
?>

<h2>Login</h2>

<p><?= htmlspecialchars($pesan) ?></p>

<form method="POST">

    <input type="text" name="username"
        placeholder="Username" required>
    <br><br>

    <input type="password" name="password"
        placeholder="Password" required>
    <br><br>

    <button type="submit" name="login">
        Login
    </button>

</form>

<p>Belum punya akun? <a href="register.php">Daftar</a></p>
