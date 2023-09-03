<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="<?php asset("css", "register.css?v=" . rand(1, 500)) ?>">
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mx-auto">
                <form class="form" id="frm_registro" action="<?= url("/register/insert") ?>" method="POST">
                    <p class="title">Register</p>
                    <div class="flex">
                        <label>
                            <input required="" placeholder="" type="text" id="firstname" class="input" name="firstaname">
                            <span>Firstname</span>
                        </label>

                        <label>
                            <input required="" placeholder="" type="text" id="lastname" class="input" name="lastname">
                            <span>Lastname</span>
                        </label>
                    </div>

                    <label>
                        <input required="" placeholder="" type="email" id="email" class="input" name="email">
                        <span>Email</span>
                    </label>

                    <label>
                        <input required="" placeholder="" type="password" id="password" class="input" name="password">
                        <span>Password</span>
                    </label>
                    <label>
                        <input required="" placeholder="" type="password" id="confirmPassword" class="input" name="confirmPassword">
                        <span>Confirm password</span>
                    </label>
                    <button class="submit" id="btn_registro" type="submit">Registrarse</button>
                    <p class="signin">Already have an acount ? <a href="login">Log In</a> </p>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="<?php asset("js", "register.js?v=" . rand(1, 500)) ?>"></script>

</html>