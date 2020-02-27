<?= Form::open(array("class"=>"form-horizontal")); ?>

    <div class="form-group">
        <div class="col-md-12">
            <!--<label for="form_email_username">Email or Username</label>-->
            <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input name="email_username" value="" placeholder="Email or Username" id="form_email_username" class="form-control" type="text" autofocus>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-md-12">
            <!--<label for="form_password">Password</label>-->
            <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input name="password" value="" placeholder="Password" id="form_password" class="form-control" type="password">
            </div>
        </div>
    </div>
    <!-- <div class="checkbox">
        <label>
            <input name="remember" type="checkbox" value="Remember Me">Remember Me
        </label>
    </div> -->
    <hr>
    <div class="form-group">
        <div class="col-md-6">
            <button id="form_submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-key"></i>&ensp;Log in</button>
        </div>
        <div class="col-md-6 text-right">
            <a class="" href="<?= Uri::create('login/forgot-password'); ?>">Forgot Password?</a>
        </div>
    </div>
<?= Form::close(); ?>
