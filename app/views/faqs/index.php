<!-- === START PATH === -->
<div class="path-section">
    <div class="bg-cover">
        <div class="container">
            <h3>FaQs</h3>
        </div>
    </div>
</div>
<!-- === END PATH === -->

<div class="shop-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-group" id="accordion">
                    <?php foreach($this->getAllData as $key => $data){?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo ($key+1)?>">
                                        <?php echo $data['question']?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-<?php echo ($key+1)?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <?php echo $data['answer']?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

