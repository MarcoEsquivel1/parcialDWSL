    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <title>Document</title>
        <script src="https://www.google.com/recaptcha/api.js?render=6LdW_2kiAAAAAG_Ohb4wXcwutys5j7bRxdQaR_Ga"></script>
        <?php
            session_start();
            require_once("./controllers/usersController.php");
            $obj = new UsersController();

            if (isset($_SESSION['session']) && $_SESSION['session'] == true) {
                header('location:./views/index.php');
            }
            if (isset($_POST) && isset($_POST['ok'])) {
                $secretKey = "6LdW_2kiAAAAABRaFj4FC-U_trMaT7dpxEBWGR1f";
                $token = $_POST['g-token'];
                $ip = $_SERVER['REMOTE_ADDR'];
                $url="https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$token."&remoteip=".$ip;
                $request = file_get_contents($url);
                $response = json_decode($request);
                /* var_dump($response);
                return $response; */
                if ($response->success) {
                    $email = $_POST['correo'];
                    $password = $_POST['password'];
                    
                    $auth = $obj->auth($email, $password);
                    
                    if ($auth != 0) {
                        $_SESSION['session'] = true;
                        $_SESSION['id_user'] = $auth['id_user'];
                        $_SESSION['nombre'] = $auth['nombre'];
                        $_SESSION['id_rol'] = $auth['id_rol'];
                        $_SESSION['response'] = $response->score;
                        header('location:./views/index.php');
                    } else {
                        $error = true;
                    }
                } else {
                    $captchaError = true;
                }
            }
        ?>
    </head>

    <body class="vh-100 d-flex align-items-center justify-content-center">
        <div class="container w-50 shadow-lg p-3 mb-5 bg-body rounded position-relative">
            <h1 class="text-center m-5 display-5">Login</h1>
            <form id="form-login" method="POST" action="" class="was-validated">
                <input type="hidden" name="g-token" id="g-token">
                <div class="form-floating m-5">
                    <input type="email" class="form-control" name="correo" id="correo" placeholder="#" required>
                    <label for="correo">Correo electronico</label>
                </div>
                <div class="form-floating m-5">
                    <input type="text" class="form-control" name="password" id="password" placeholder="#" required>
                    <label for="password">Contraseña</label>
                    <?php 
                        if (isset($error)) {
                            echo "<p class='text-danger mt-3'>Error al autenticar</p>";
                        } 
                        if (isset($captchaError)) {
                            echo "<p class='text-danger mt-3'>Error de capthcha!</p>";
                        }
                    ?>
                </div>
                <div class="g-recaptch" data-sitekey="6LdW_2kiAAAAAG_Ohb4wXcwutys5j7bRxdQaR_Ga"></div>
                <button type="submit" name="ok" class="btn btn-dark py-3 px-5 position-absolute top-100 start-50 translate-middle">Ingresar</button>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
        <script>
            grecaptcha.ready(function() {
                grecaptcha.execute('6LdW_2kiAAAAAG_Ohb4wXcwutys5j7bRxdQaR_Ga', {
                    action: 'submit'
                }).then(function(token) {
                    document.getElementById('g-token').value = token;
                });
            });
        </script>
    </body>

    </html>