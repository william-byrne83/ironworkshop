<!-- Page content -->
<div id="page-content">
	<!-- Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>Contacts</h1>
                </div>
            </div>
            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="/backoffice/contact-us/index">Contacts</a></li>
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
            <h2><?php if(isset($this->stored_data['id'])){echo "Edit"; }else{ echo "Add";}?> Contacts</h2>
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
        <form action="" method="post" class="form-horizontal form-bordered" >
            <div class="form-group">
                <label class="col-md-2 control-label" for="view">View Page</label>
                <div class="col-md-5">
                    <a href = "/contact-us/" title="View Page" class = "btn btn-effect-ripple btn-sm btn-primary" target="_blank"> View Page</a>
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('facebook', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="facebook">Facebook Link <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <input type="text" id="facebook" name="facebook" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['facebook']);} elseif(!empty($this->stored_data['facebook'])){echo $this->stored_data['facebook'];}?>">
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('instagram', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="instagram">Instagram Link <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <input type="text" id="instagram" name="instagram" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['instagram']);} elseif(!empty($this->stored_data['instagram'])){echo $this->stored_data['instagram'];}?>">
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('location', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="location">Location <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <textarea id="location" name="location" rows="7" class="ckeditor" ><?php if ((!empty($this->missing)) || (!empty($this->error))) { echo  html_entity_decode($_POST['location']);}elseif(!empty($this->stored_data['location'])){echo $this->stored_data['location'];}?></textarea>
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('text', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="text">Text</label>
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
                <label class="col-md-2 control-label" for="email">Email </label>
                <div class="col-md-5">
                    <input type="email" id="email" name="email" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['email']);} elseif(!empty($this->stored_data['email'])){echo $this->stored_data['email'];}?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label" for="map">Click Location</label>
                <div class="col-md-5">
                    <div id="map_right" style = "height:400px"></div>
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('lat', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="lat">Latitude <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <input type="text" id="lat" name="lat" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['lat']);} elseif(!empty($this->stored_data['lat'])){echo $this->stored_data['lat'];}?>">
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('lang', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="lang">Longitude <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <input type="text" id="lang" name="lang" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['lang']);} elseif(!empty($this->stored_data['lang'])){echo $this->stored_data['lang'];}?>">
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