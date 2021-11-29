<header>
    <h1 id="title">Blog des titans</h1>
    <nav id="nav">
        <a href="http://127.0.0.25/controller/ArticleController.php?action=show" title="Voir les articles"><i class="far fa-newspaper fa-2x"></i></a>
        <?php if (isset($_SESSION['id'])) : ?>
            <a href="http://127.0.0.25/vues/articles/add.php" title="Ajouter un article"><i class="fas fa-plus fa-2x"></i></a>
        <?php endif ?>

        <?php if (!isset($_SESSION['id'])) : ?>
            <a href="http://127.0.0.25/vues/account/signup.php" title="S'inscrire"><i class="fas fa-user-lock fa-2x"></i></a>
        <?php endif ?>

        <?php if (isset($_SESSION['id'])) : ?>
            <a href="http://127.0.0.25/vues/account/logout.php" title="Se déconnecter"><i class="fas fa-sign-out-alt fa-2x"></i></a>
            <span class="pseudo-blue"><?= $_SESSION['pseudo'] ?></span>
        <?php endif ?>
    </nav>

    <nav id="nav-mobile">
        <div class="menu-btn" title="Menu">
            <div class="menu-btn__burger"></div>
        </div>
        <div id="nav-mobile_item">
            <ul>
                <li><a href="http://127.0.0.25/controller/ArticleController.php?action=show"><i class="far fa-newspaper fa-2x"></i></a></li>
                <?php if (isset($_SESSION['id'])) : ?>
                    <li><a href="http://127.0.0.25/vues/articles/add.php" title="Ajouter un article"><i class="fas fa-plus fa-2x"></i></a></li>
                <?php endif ?>

                <?php if (!isset($_SESSION['id'])) : ?>
                    <li><a href="">&nbsp;</a></li>
                    <li><a href="http://127.0.0.25/vues/account/signup.php" title="S'inscrire"><i class="fas fa-user-lock fa-2x"></i></a></li>
                <?php endif ?>
                    <li><a href="">&nbsp;</a></li>
                <?php if (isset($_SESSION['id'])) : ?>
                    <li><a href="http://127.0.0.25/vues/account/logout.php" title="Se déconnecter"><i class="fas fa-sign-out-alt fa-2x"></i></a> &nbsp;&nbsp;  <span class="pseudo-blue"><?= $_SESSION['pseudo'] ?></span></li>
                    
                <?php endif ?>
            </ul>
        </div>
    </nav>
</header>

<script>
    const menuBtn = document.querySelector('.menu-btn');
    const navMobile = document.querySelector('#nav-mobile_item');
    let menuOpen = false;
    menuBtn.addEventListener('click', () => {
        if (!menuOpen) {
            openBurger()
        } else {
            closeBurger()
        }
    })

    function openBurger() {
        menuBtn.classList.add('open');
        navMobile.classList.add('open');
        menuOpen = true;
    }

    function closeBurger() {
        menuBtn.classList.remove('open');
        navMobile.classList.remove('open');
        menuOpen = false;
    }

    document.addEventListener('click', (e) => {
        console.log(e.target.classList);
        if(e.target.classList[0] !== "menu-btn" && e.target.classList[0] !== "open" && e.target.classList[0] !== "menu-btn__burger") {
            closeBurger();
        }
    });
</script>