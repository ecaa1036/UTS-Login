
<?php
include 'koneksi.php';

$pesan = "";

if (isset($_POST['register'])) {

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Password di-hash
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = mysqli_prepare($conn,
        "INSERT INTO users
        (nama, alamat, tanggal_lahir, jenis_kelamin,
        email, username, password)
        VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $query,
        "sssssss",
        $nama,
        $alamat,
        $tanggal_lahir,
        $jenis_kelamin,
        $email,
        $username,
        $hash
    );

    if (mysqli_stmt_execute($query)) {
        $pesan = "Registrasi berhasil! Silakan login.";
    } else {
        $pesan = "Registrasi gagal! Email atau username mungkin sudah digunakan.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
</head>
<body>

<h2>Form Registrasi</h2>

<p><?= htmlspecialchars($pesan) ?></p>

<form method="POST">

    <label>Nama Lengkap</label><br>
    <input type="text" name="nama" required>
    <br><br>

    <label>Alamat</label><br>
    <textarea name="alamat" required></textarea>
    <br><br>

    <label>Tanggal Lahir</label><br>
    <input type="date" name="tanggal_lahir" required>
    <br><br>

    <label>Jenis Kelamin</label><br>
    <select name="jenis_kelamin" required>
        <option value="">-- Pilih --</option>
        <option value="Laki-laki">Laki-laki</option>
        <option value="Perempuan">Perempuan</option>
    </select>
    <br><br>

    <label>Email</label><br>
    <input type="email" name="email" required>
    <br><br>

    <label>Username</label><br>
    <input type="text" name="username" required>
    <br><br>

    <label>Password</label><br>
    <input type="password" name="password"
        minlength="8" required>
    <br><br>

    <button type="submit" name="register">
        Daftar
    </button>

</form>

<p>Sudah punya akun? <a href="login.php">Login</a></p>

</body>
</html>
