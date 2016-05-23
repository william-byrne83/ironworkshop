<!-- Page content -->
<div id="page-content">
	<!-- Table Styles Header -->
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
                        <li>Trainers</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END Table Styles Header -->
    <!-- Table Styles Block -->
    <div class="block full">
    	<div class="block-title">
            <h2>Manage Trainers</h2>
            <div class="block-options pull-right">
	    		 <div id="esearch" class="dataTables_filter">
		    		<form class="form-wrap" method='get' action='/backoffice/trainers/index'>
                        <div class="input-group pull-right">
					        <input type="text" class="form-control" placeholder="Search" name="keywords" id="search_term" <?php if (isset($_GET["keywords"])) {echo 'value="'.htmlentities($_GET["keywords"]).'"';}?>><span class="search-btn"><button type="submit" class="btn btn-effect-ripple btn-sm"><i class="fa fa-search"></i></button></span>
					    </div>
					</form>
				</div>
    		</div>
    	</div>
		<?php if (!empty($this->flash)) { ?>
			<div class="alert alert-<?php echo $this->flash[1];?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><strong><?php echo ucfirst($this->flash[1]);?></strong></h4>
                <?php echo Html::formatBackofficeSuccess($this->flash[0]); ?>
            </div>
        <?php } ?>
        <!-- Table Styles Content -->
	        <div class="dataTables_wrapper form-inline no-footer">
		        <div class="row">
			        <div class="col-xs-12">
                       <div class="pull-right">
                            <a href="/backoffice/trainers/add" class="btn btn-success"><i class="fa fa-plus"></i> Add Trainer</a>
                        </div>
				    </div>
				</div>
				<?php if(!empty($this->getAllData)) {?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter table-hover no-margin">
                            <thead>
                                <tr>
                                    <th>Sort</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Hero Image</th>
                                    <th style="width: 125px; min-width:125px;" class="text-center"><i class="fa fa-flash"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 1;?>
                                <?php foreach($this->getAllData as $data) {?>
                                    <tr <?php if($data['is_active'] == 0){ echo 'class="danger"'; } ?>>
                                        <td>
                                            <?php if(count($this->getAllData) > 1){?>
                                                <!--if its not the top most item add up arrow-->
                                                <?php if($a != 1){?>
                                                    <a class="btn btn-sm btn-info" href="/backoffice/trainers/sort/up/<?php echo $data['id']; ?>/<?php echo $data['sort']?>" ><i class="fa fa-caret-up"></i></a>
                                                <?php } ?>

                                                <!--if its not the last item add down arrow-->
                                                <?php if ($a != count($this->getAllData)){?>
                                                    <a class="btn btn-sm btn-info" href="/backoffice/trainers/sort/down/<?php echo $data['id']; ?>/<?php echo $data['sort']?>" ><i class="fa fa-caret-down"></i></a>
                                                <?php } ?>
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $data['name']?></td>
                                        <td><?php echo $data['phone']?></td>
                                        <td><?php echo $data['email']?></td>
                                        <td>
                                            <?php if(!empty($data['hero_image'])){?>
                                                <img src="/assets/uploads/store/<?php echo $data['hero_image'][0]['image']?>" alt="<?php echo $data['hero_image'][0]['title']?>" style = "width:64px;">
                                            <?php } ?>
                                        </td>

                                        <td class="text-left">
                                            <a href="/backoffice/trainers/edit/<?php echo $data['id']; ?>/" data-toggle="tooltip" title="Edit Trainer" class="btn btn-effect-ripple btn-sm btn-success"><i class="fa fa-pencil"></i></a>
                                            <a href="/backoffice/trainer-images/index/<?php echo $data['id']; ?>/" data-toggle="tooltip" title="Manage Images" class="btn btn-effect-ripple btn-sm btn-info"><i class="fa fa-picture-o"></i></a>
                                            <a href="/backoffice/trainers/delete/<?php echo $data['id']; ?>/" data-toggle="tooltip" title="Delete Trainer" class="btn btn-effect-ripple btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                    <?php $a++;?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
	            <?php }else{ ?>
		             <div class="row no-result">
			            <div class="col-xs-12">
							<p>There are no trainers to display.</p>
			            </div>
		            </div>
			    <?php } ?>
                <div class="pagination-wrap row">
                    <div class="pull-right">
                        <a href="/backoffice/trainers/add" class="btn btn-success"><i class="fa fa-plus"></i> Add Trainer</a>
                    </div>
                    <?php if(!empty($this->page_links)){ ?>
                        <div class="dataTables_paginate paging_bootstrap">
                            <?php echo $this->page_links; ?>
                        </div>
                    <?php } ?>
                </div>
	        </div>
        <!-- END Table Styles Content -->
    </div>
    <!-- END Table Styles Block -->
</div>
<!-- END Page Content -->