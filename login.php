<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
$auth = new Auth();

if ($auth->isLoggedIn()) {
    header("Location: profile.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $auth->login($_POST['email'], $_POST['password']);
        header("Location: profile.php");
        exit;
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
require_once 'templates/header.php';
defined('ABS_PATH' or exit('No direct script access allowed')); ?></nav>
        <section class="">
    <div class="content-wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="header-short">
                        <h2 class="header-short__text">Sign In</h2>
                        <div class="header-short__line"></div>
                        <div class="header-short__line"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrap bg-light">
        <div class="content-wrap content-wrap--top">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-xs-12">
                        <form method="post" id="auth-form" role="form">
                            <div class="row">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="login" class="sr-only"></label>
                                        <input id="login" type="text" class="form-control required" placeholder="E-mail" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="sr-only"></label>
                                        <input id="password" type="password" class="form-control required" placeholder="Password" name="password">
                                    </div>
                                    <?php if (isset($error)): ?>
                                        <div style="color: red"><?php echo htmlspecialchars($error) ?></div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                    <!--    <a href="login/password-recovery.html">Forgot Password?</a>
                                    </div>-->
                                </div>

                                <div class=" col-sm-offset-3 col-sm-6">
                                    <div class="form-group">
                                        <button type="submit" value="" class="btn-yellow contact-form__btn">submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once 'templates/footer.php';