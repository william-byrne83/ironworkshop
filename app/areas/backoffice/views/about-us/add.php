<!-- Page content -->
<div id="page-content">
	<!-- Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="header-section">
                    <h1>About Us</h1>
                </div>
            </div>
            <div class="col-sm-6 hidden-xs">
                <div class="header-section">
                    <ul class="breadcrumb breadcrumb-top">
                        <li><a href="/backoffice/about-us/index">About Us</a></li>
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
            <h2><?php if(isset($this->stored_data['id'])){echo "Edit"; }else{ echo "Add";}?> About Us</h2>
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
        <form action="" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-md-2 control-label" for="view">View Page</label>
                <div class="col-md-5">
                    <a href = "/about-us/" title="View Page" class = "btn btn-effect-ripple btn-sm btn-primary" target="_blank"> View Page</a>
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('text', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="headline">Text <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <textarea id="text" name="text" rows="7" class="ckeditor" ><?php if ((!empty($this->missing)) || (!empty($this->error))) { echo  html_entity_decode($_POST['text']);}elseif(!empty($this->stored_data['text'])){echo $this->stored_data['text'];}?></textarea>
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('pricing', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="headline">Pricing <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <textarea id="pricing" name="pricing" rows="7" class="ckeditor" ><?php if ((!empty($this->missing)) || (!empty($this->error))) { echo  html_entity_decode($_POST['pricing']);}elseif(!empty($this->stored_data['pricing'])){echo $this->stored_data['pricing'];}?></textarea>
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('monday', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="monday">Monday Opening Times <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <input type="text" id="monday" name="monday" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['monday']);} elseif(!empty($this->stored_data['monday'])){echo $this->stored_data['monday'];}?>">
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('tuesday', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="tuesday">Tuesday Opening Times <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <input type="text" id="tuesday" name="tuesday" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['tuesday']);} elseif(!empty($this->stored_data['tuesday'])){echo $this->stored_data['tuesday'];}?>">
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('wednesday', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="wednesday">Wednesday Opening Times <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <input type="text" id="wednesday" name="wednesday" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['wednesday']);} elseif(!empty($this->stored_data['wednesday'])){echo $this->stored_data['wednesday'];}?>">
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('thursday', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="thursday">Thursday Opening Times <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <input type="text" id="thursday" name="thursday" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['thursday']);} elseif(!empty($this->stored_data['thursday'])){echo $this->stored_data['thursday'];}?>">
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('friday', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="friday">Friday Opening Times <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <input type="text" id="friday" name="friday" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['friday']);} elseif(!empty($this->stored_data['friday'])){echo $this->stored_data['friday'];}?>">
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('saturday', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="saturday">Saturday Opening Times <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <input type="text" id="saturday" name="saturday" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['saturday']);} elseif(!empty($this->stored_data['saturday'])){echo $this->stored_data['saturday'];}?>">
                </div>
            </div>

            <div class="form-group <?php if ((!empty($this->error)) && array_key_exists('sunday', $this->error)) { echo 'has-error'; }?>">
                <label class="col-md-2 control-label" for="sunday">Sunday Opening Times <span class="text-danger">*</span></label>
                <div class="col-md-5">
                    <input type="text" id="sunday" name="sunday" class="form-control" value="<?php if (!empty($this->error)) { echo Formatting::utf8_htmlentities($_POST['sunday']);} elseif(!empty($this->stored_data['sunday'])){echo $this->stored_data['sunday'];}?>">
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