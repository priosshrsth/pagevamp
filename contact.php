<?php require_once 'AppCode/_App.php'; ?>
<?php require_once 'layouts/header.php'; ?>
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/2.jpg) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center">
                                <h2 class="bradcaump-title">Contact US</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Home</a>
                                  <span class="brd-separetor">/</span>
                                  <span class="breadcrumb-item active">Contact US</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--120 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="htc__contact__container">
                            <div class="htc__contact__address">
                                <h2 class="contact__title">contact info</h2>
                                <div class="contact__address__inner">
                                    <!-- Start Single Adress -->
                                    <div class="single__contact__address">
                                        <div class="contact__icon">
                                            <span class="ti-location-pin"></span>
                                        </div>
                                        <div class="contact__details">
                                            <p>Location : <br> 77, seventh avenue, Brat road USA.</p>
                                        </div>
                                    </div>
                                    <!-- End Single Adress -->
                                </div>
                                <div class="contact__address__inner">
                                    <!-- Start Single Adress -->
                                    <div class="single__contact__address">
                                        <div class="contact__icon">
                                            <span class="ti-mobile"></span>
                                        </div>
                                        <div class="contact__details">
                                            <p> Phone : <br><a href="#">+012 345 678 102 </a></p>
                                        </div>
                                    </div>
                                    <!-- End Single Adress -->
                                    <!-- Start Single Adress -->
                                    <div class="single__contact__address">
                                        <div class="contact__icon">
                                            <span class="ti-email"></span>
                                        </div>
                                        <div class="contact__details">
                                            <p> Mail :<br><a href="#">info@example.com</a></p>
                                        </div>
                                    </div>
                                    <!-- End Single Adress -->
                                </div>
                            </div>
                            <div class="contact-form-wrap">
                                <div class="contact-title">
                                    <h2 class="contact__title">Get In Touch</h2>
                                </div>
                                <form data-toggle="validator" role="form">
                                    <div class="form-group has-feedback">
                                        <label for="inputName" class="control-label">Name</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon-glyphicon-user">Name</i></span>
                                            <input type="text" class="form-control" id="inputName" minlength="10" maxlength="40" placeholder="Your Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inputEmail" class="control-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="email" class="form-control" id="inputEmail" placeholder="Email" data-error="Bruh, that email address is invalid" required>
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="inputAddress" class="control-label">Adresss</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">City</span>
                                            <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Your Address" required>
                                        </div>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="message" class="control-lab"></label>
                                        <textarea data-text="true" class="form-control" required minlength="6" maxlength="250" name="message"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                        </div> 
                        <div class="form-output">
                            <p class="form-messege"></p>
                        </div>
                        </div>
                    </div>
<!--                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 smt-30 xmt-30">-->
<!--                        <div class="map-contacts">-->
<!--                            <div id="googleMap"></div>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
            </div>
        </section>
        <!-- End Contact Area -->
<?php require_once 'layouts/footer.php'; ?>