<?php
include "lib/koneksi.php";

// Inisialisasi variabel untuk menyimpan pesan error
$error = '';
$success = '';

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $sql = "SELECT * FROM tb_users WHERE username = :username AND email = :email";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result) {
        $error = 'Username atau email sudah terdaftar.';
    } else {
        // Simpan data pengguna ke database
        $sww = "INSERT * INTO tb_users WHERE username = :username AND email = :email";
        $stmt = $pdo->prepare($sww);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->execute()) {
            $success = 'Registrasi berhasil! Silakan login.';
        } else {
            $error = 'Terjadi kesalahan saat registrasi.';
        }
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Sign Up</title>
</head>

<body>
    <?php if ($error): ?>
    <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
    <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>
    <div class="container" style="width: 400px; margin-top: 75px;">
        <div class="row">

            <center>
                <h2>Form Sign Up</h2>
            </center>
            <form method="POST">
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control" />
                    <label class="form-label" for="usernam">Email address</label>
                </div>
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="email" name="email" class="form-control" />
                    <label class="form-label" for="email">Email address</label>
                </div>

                <!-- Password input -->

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                            <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                    </div>


                    <!-- Submit button -->
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-primary btn-block mb-4">Sign
                        Up</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</body>

</html>