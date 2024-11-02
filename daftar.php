<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <center>
        <h3  style="margin-top: 75px;">Sign In Here</h3>
    </center>
    <div class="container" style="width: 400px; margin-top: 50px;">
        <div class="row">
            <form>
                <!-- input username -->
                <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Username</label>
                    <input type="username" name="username" id="form2Example1" class="form-control" />
                </div>
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Email address</label>
                    <input type="email"  name="email" id="form2Example1" class="form-control" />
                </div>
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
               <center> <button type="submit" data-mdb-button-init data-mdb-ripple-init
                    class="btn btn-primary btn-block mb-4" style="width:100px; margin-top: 15px;">Sign in</button> </center>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Not a member? <a href="daftar.php">Register</a></p>
                    <p>or sign up with:</p>
                    <button type="button" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                    </button>

                    <button type="button" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-google"></i>
                    </button>

                    <button type="button" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-twitter"></i>
                    </button>

                    <button type="button" data-mdb-button-init data-mdb-ripple-init
                        class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-github"></i>
                    </button>
                </div>
                </form>
        </div>
    </div>
<?php
    include 'lib/koneksi.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $email = $_POST['email'];
    
        $stmt = $pdo->prepare("INSERT INTO tb_users (username, email) VALUES ('$username', '$email')");
        $stmt->execute([$username, $email]); // Perbaiki dari excute ke execute
    
        header("Location: read_users.php");
        exit(); // Tambahkan exit setelah header untuk memastikan script berhenti
    }
    ?>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>