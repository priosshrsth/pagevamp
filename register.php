<?php require_once 'layouts/app.php'; ?>
<?php if(auth()->check()) {
    header("Location: index.php");
    die();
}
?>
<?php require_once 'layouts/header.php'; ?>
<?php
if(isset($_GET['action']) && $_GET['action'] == 'register') {
    $action = 'register';
} else {
    $action = 'login';
}
?>
        <!-- Start Login Register Area -->
        <div class="htc__login__register bg__white ptb--130" style="background: rgba(0, 0, 0, 0) url(images/bg/5.jpg) no-repeat scroll center center / cover ;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <ul class="login__register__menu" role="tablist">
                            <li role="presentation" class="login <?php echo $action=='login'?'active':''?>"><a href="#login" role="tab" data-toggle="tab">Login</a></li>
                            <li role="presentation" class="register <?php echo $action=='register'?'active':''?>"><a href="#register" role="tab" data-toggle="tab">Register</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Start Login Register Content -->
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="htc__login__register__wrap">
                            <!-- Start Single Content -->
                            <div id="login" role="tabpanel" class="single__tabs__panel tab-pane fade  <?php echo $action=='login'?'in active':''?>">
                                <form class="login" method="post">
                                    <?php csrf_field(); ?>
                                    <input type="text" name="username" placeholder="User Name*">
                                    <input type="password" name="password" placeholder="Password*">
                                    <div class="tabs__checkbox">
                                        <input type="checkbox">
                                        <span> Remember me</span>
                                        <span class="forget"><a href="#">Forget Pasword?</a></span>
                                    </div>
                                    <div class="htc__login__btn">
                                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                                    </div>
                                </form>
                                <div class="htc__social__connect">
                                    <h2>Or Login With</h2>
                                    <ul class="htc__soaial__list">
                                        <li><a class="bg--twitter" href="#"><i class="zmdi zmdi-twitter"></i></a></li>

                                        <li><a class="bg--instagram" href="#"><i class="zmdi zmdi-instagram"></i></a></li>

                                        <li><a class="bg--facebook" href="#"><i class="zmdi zmdi-facebook"></i></a></li>

                                        <li><a class="bg--googleplus" href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Single Content -->
                            <!-- Start Single Content -->
                            <div id="register" role="tabpanel" class="single__tabs__panel tab-pane fade  <?php echo $action=='register'?'in active':''?>">
                                <form class="login" method="post">
                                    <?php csrf_field(); ?>
                                    <input type="text" name="name" placeholder="Name*">
                                    <?php error('name'); ?>
                                    <input type="email" name="email" placeholder="Email*">
                                    <?php error('email'); ?>
                                    <input type="text" name="username" placeholder="Username*">
                                    <?php error('username'); ?>
                                    <input type="password" name="password" placeholder="Password*">
                                    <?php error('password'); ?>
                                    <input type="text" name="address" placeholder="Address*">
                                    <?php error('address'); ?>
                                    <input type="text" name="contact" placeholder="Phone Number*">
                                    <?php error('contact'); ?>
                                    <div class="htc__login__btn">
                                        <button type="submit" name="register" class="btn btn-primary">Register</button>
                                    </div>
                                </form>
                                <div class="htc__social__connect">
                                    <h2>Or Login With</h2>
                                    <ul class="htc__soaial__list">
                                        <li><a class="bg--twitter" href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                        <li><a class="bg--instagram" href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                        <li><a class="bg--facebook" href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                        <li><a class="bg--googleplus" href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Single Content -->
                        </div>
                    </div>
                </div>
                <!-- End Login Register Content -->
            </div>
        </div>
        <!-- End Login Register Area -->

<?php require_once 'layouts/footer.php'; ?>