<?php layout('full-width') ?>
<div class="bg-gray-light" style="padding: 75px; 0">
    <div class="container">
        <div class="row">
            <div class="col-xs-7">
                <h1>Get in touch with us</h1>
                <p>
                    Thank you for stopping by! We are happy to hear from you. Please contact us through the form below and we will get back to you as soon as we can.
                </p>
                <?= form_open('/page/contact-post', 'class="form-pink"') ?>
                    <?= alert() ?>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" rows="4" cols="40" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-blue">Submit</button>
                </form>
            </div>
            <div class="col-xs-4 col-xs-offset-1">
                <h2>We are here</h2>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d317718.69319292053!2d-0.3817765050863085!3d51.528307984912544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C+UK!5e0!3m2!1sen!2sin!4v1466158140869" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                <address>
                    BlueBox Company<br>
                    1234 Road<br>
                    London, SW1 000<br>

                    Tel: 01000 334 556<br>

                    Fax: 01000 334 556<br>

                    Email: info@domainname.com
                </address>
            </div>
        </div>
    </div>
</div>
