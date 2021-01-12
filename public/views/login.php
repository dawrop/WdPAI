<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>LOGIN PAGE</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <div class="login-container">
            <form class="login-content" action='login' method='POST'>
                <div class="messages">
                    <?php if(isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="login" type="text" placeholder="Login">
                <input name="password" type="password" placeholder="Password">
                <div class="form-btn">
                    <form action='login' method='POST'>
                        <button type="submit">SIGN IN</button>
                    </form>
                    <form action='signup' method='POST'>
                        <button>SIGN UP</button>
                    </form>
                    
                </div>
            </form>
        </div>
    </div>
</body>