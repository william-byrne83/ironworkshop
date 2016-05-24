<!-- Page content -->
<div id="page-content">
	<!-- Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Trainers</h1>
                </div>
            </div>
            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="/backoffice/trainers/index">Trainers</a></li>
                        <li><?php if(isset($this->stored_data['id'])){echo "Edit"; }else{ echo "Add";}?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END Header -->
    <!-- General Elements Block -->
    <div class="block">
        <!-- General Elements Title -->
        <div class="block-title">
            <h2><?php if(isset($this->stored_data['id'])){echo "Edit"; }else{ echo "Add";}?> Trainers</h2>
        </div>
        <!-- END General Elements Title -->
        <?php if (!empty($this->error)) { ?>
		<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><strong>Error</strong></h4>
            <?php
			    echo Html::formatBackofficeSuccess($this->error);
			?>
        </div>
        <?php } ?>
        <!-- General Elements Content -->
        <form action="" method="post" class="form-horizontal form-bordered">

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('name', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="name">Name <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <input type="text" id="name" name="name" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['name']);} elseif(!empty($this->stored_data['name'])){echo $this->stored_data['name'];}?>">
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('text', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="headline">Text <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <textarea id="text" name="text" rows="7" class="ckeditor" ><?php if ((!empty($this->missing)) || (!empty($this->error))) { echo  html_entity_decode($_POST['text']);}elseif(!empty($this->stored_data['text'])){echo $this->stored_data['text'];}?></textarea>
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('phone', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="phone">Phone </label>
                <div class="col-md-5">
                    <input type="text" id="phone" name="phone" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['phone']);} elseif(!empty($this->stored_data['phone'])){echo $this->stored_data['phone'];}?>">
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('email', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="phone">Email </label>
                <div class="col-md-5">
                    <input type="text" id="email" name="email" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['email']);} elseif(!empty($this->stored_data['email'])){echo $this->stored_data['email'];}?>">
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('website', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="website">Website </label>
                <div class="col-md-5">
                    <input type="text" id="website" name="website" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['website']);} elseif(!empty($this->stored_data['website'])){echo $this->stored_data['website'];}?>">
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('facebook', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="facebook">Facebook Link</label>
                <div class="col-md-5">
                    <input type="text" id="facebook" name="facebook" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['facebook']);} elseif(!empty($this->stored_data['facebook'])){echo $this->stored_data['facebook'];}?>">
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('twitter', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="twitter">Twitter Link</label>
                <div class="col-md-5">
                    <input type="text" id="twitter" name="twitter" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['twitter']);} elseif(!empty($this->stored_data['twitter'])){echo $this->stored_data['twitter'];}?>">
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('google', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="google">Google Plus Link</label>
                <div class="col-md-5">
                    <input type="text" id="google" name="google" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['google']);} elseif(!empty($this->stored_data['google'])){echo $this->stored_data['google'];}?>">
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('instagram', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="instagram">Instagram Link</label>
                <div class="col-md-5">
                    <input type="text" id="instagram" name="instagram" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['instagram']);} elseif(!empty($this->stored_data['instagram'])){echo $this->stored_data['instagram'];}?>">
                </div>
            </div>

            <div class="form-group">
				<label class="col-md-2 control-label" for="is_active">Is Active</label>
                    <input type="hidden" name="is_active" value="0">
					<div class="col-md-5">
						<div class="checkbox">
							<label for="is_active" class="switch switch-primary"><input type="checkbox" name="is_active" id="is_active" value="1" <?php if((!empty($_POST['is_active']) && $_POST['is_active'] != 0)  || (!empty($this->stored_data['is_active']) && $this->stored_data['is_active'] != 0) || (!isset($this->stored_data['id']))) {echo 'checked="checked"';}?>><span></span></label>
						</div>
				</div>
			</div>

            <div class="form-group form-actions">
                <div class="col-md-5 col-md-offset-2">
                    <input type="submit" name="save" class="btn btn-effect-ripple btn-primary loader" value="Save">
                    <input type="submit" name="cancel" class="btn btn-effect-ripple btn-danger loader" value="Cancel">
                </div>
            </div>
        </form>
        <!-- END General Elements Content -->
    </div>
    <!-- END General Elements Block -->
</div>
<!-- END Page Content -->