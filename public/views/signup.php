<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script type="text/javascript" src="./public/js/script.js" defer></script>
    <title>SIGN UP PAGE</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <div class="login-container">
            <form class="login-content" action="signup", method="post">
                <div class="messages">
                    <?php
                        if (isset($messages)) {
                            foreach ($messages as $message) {
                                echo $message;
                            }
                        }
                    ?>
                </div>
                <input name="login" type="text" placeholder="login">
                <input name="password" type="password" placeholder="password">
                <input name="repeatPassword" type="password" placeholder="repeat password">
                <input name="email" type="text" placeholder="email@email.com">
                <button type="submit">SIGN UP</button>
                <p>
                    Already have an account? <a href="login">Login here</a>
                </p>
            </form>
        </div>
    </div>
</body>