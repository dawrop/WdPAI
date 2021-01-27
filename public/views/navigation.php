<div class="nav">
    <div id="myLinks">
        <a href="profile">
            <i class="fas fa-user-circle"></i>
        </a>

        <a onclick="showSearchBar()">
            <i class="fas fa-search"></i>
        </a>

        <a href="homepage">
            <i class="fas fa-home"></i>
        </a>

        <a href="trending">
            <i class="fas fa-chart-line"></i>
        </a>

        <a href="favourites">
            <i class="far fa-star"></i>
        </a>
        <?php
        if ($user->getPermission() == 1):
            ?>
            <a href="addBook">
                <i class="fas fa-plus"></i>
            </a>
        <?php endif; ?>
    </div>
        <div id="logo-nav">
            <img src="public/img/logo.svg">
        </div>
</div>
