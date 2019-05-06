<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Contact</h2>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container bootstrap snippets">
        <div class="row text-center">
            <div class="col-sm-4">
                <div class="contact-detail-box">
                    <i class="fa fa-th fa-3x text-colored"></i>
                    <h4>Get In Touch</h4>
                    <abbr title="Phone">P:</abbr> (123) 456-7890<br>
                    E: <a href="mailto:alenavereshaka16@gemail.com" class="text-muted">email@email.com</a>
                </div>
            </div><!-- end col -->

            <div class="col-sm-4">
                <div class="contact-detail-box">
                    <i class="fa fa-map-marker fa-3x text-colored"></i>
                    <h4>Our Location</h4>

                    <address>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                    </address>
                </div>
            </div><!-- end col -->

            <div class="col-sm-4">
                <div class="contact-detail-box">
                    <i class="fa fa-book fa-3x text-colored"></i>
                    <h4>24x7 Support</h4>

                    <p>Industry's standard dummy text.</p>
                    <h4 class="text-muted">1234 567 890</h4>
                </div>
            </div><!-- end col -->

        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-sm-6">
                <div class="contact-map">
                    <iframe src="https://www.google.com/maps/embed/v1/place?q=New+York+University&amp;key=AIzaSyBSFRN6WWGYwmFi498qXXsD2UwkbmD74v4" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="width: 100%; height: 360px;"></iframe>
                </div>
            </div><!-- end col -->

            <!-- Contact form -->
            <div class="col-sm-6">
                <form action="../site/send-contact-email" method="get" class="form-main">
                    <div class="form-group">
                        <label for="name2">Name</label>
                        <input class="form-control" name="name" type="text" placeholder="Name" required>
                        <div class="error" id="err-name" style="display: none;">Please enter name</div>
                    </div> <!-- /Form-name -->

                    <div class="form-group">
                        <label for="email2">Email</label>
                        <input class="form-control" name="email" type="email" placeholder="E-mail" required">
                        <div class="error" id="err-emailvld" style="display: none;">E-mail is not a valid format</div>
                    </div> <!-- /Form-email -->

                    <div class="form-group">
                        <label for="message2">Message</label>
                        <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>

                        <div class="error" id="err-message" style="display: none;">Please enter message</div>
                    </div> <!-- /col -->

                    <div class="row">
                        <div class="col-xs-12">
                            <div id="ajaxsuccess" class="text-success">E-mail was successfully sent.</div>
                            <div class="error" id="err-form" style="display: none;">There was a problem validating the form please check!</div>
                            <div class="error" id="err-timedout">The connection to the server timed out!</div>
                            <div class="error" id="err-state"></div>
                            <button type="submit" class="btn btn-primary btn-shadow btn-rounded w-md" id="send">Submit</button>
                        </div> <!-- /col -->
                    </div> <!-- /row -->

                </form> <!-- /form -->
            </div> <!-- end col -->

        </div> <!-- end row -->
    </div>