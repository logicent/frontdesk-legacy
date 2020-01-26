<?= Form::open(array("class"=>"form-horizontal")); ?>
    <div class="form-group">
        <div class="col-md-12">
            <!-- <label for="form_email_username">Email or Username</label> -->
            <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input name="email" value="" placeholder="Email" id="form_email" class="form-control" type="text" autofocus>
            </div>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <div class="col-md-12">
            <button id="form_submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-unlock"></i>&ensp;Send Request</button>
        </div>
    </div>
<?= Form::close(); ?>
