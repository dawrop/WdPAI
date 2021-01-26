<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="https://kit.fontawesome.com/0e33b4f811.js" crossorigin="anonymous"></script>
    <title>Xbook</title>
</head>

<body>
    <div class="base-container">
        <?php require 'navigation.php';?>
        
        <main>
            <header>
                <div class="logo-homepage">
                    <img src="public/img/logo.svg">
                </div>
            </header>
            <section class="profile-content">
                <section class="profile-img">
                    <img src="public/img/profile-images/<?= $user->getProfileImage() ?>">

                    <form action="logout" method="post">
                        <button>Logout</button>
                    </form>
                </section>
                <section class="profile-info">
                    <form class="changePass" action="changePassword" method="post">

                        <a>Change password</a>

                        <div class="messages">
                            <?php if(isset($messages)) {
                                foreach ($messages as $message) {
                                    echo $message;
                                }
                            }
                            ?>
                        </div>

                        <input name="oldPassword" type="password" placeholder="Old password">
                        <input name="newPassword" type="password" placeholder="New password">
                        <input name="repeatNewPassword" type="password" placeholder="Repeat new password">
                        <button type="submit">Submit</button>

                    </form>
                </section>
            </section>
        </main>
    </div>
</body>