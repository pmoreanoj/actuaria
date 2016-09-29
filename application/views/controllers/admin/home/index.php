<div>
    <h3>Bienvenido <?php echo $name?></h3>
</div>

<div class="row mt">
      <div class="col-md-4 col-sm-4 mb">
        <div class="white-panel pn">
            <div class="white-header">
                <h5>Campa&ntilde;as</h5>
            </div>

            <div class="row">
                <a href="<?php echo URL::site('admin/campaigns/index')?>">
                    <h2> <?php echo $campaigns?></h2>
                </a>
            </div>
        </div><! --/grey-panel -->
    </div><!-- /col-md-4-->

    <div class="col-md-4 col-sm-4 mb">
        <div class="white-panel pn">
            <div class="white-header">
                <h5>Campa&ntilde;as</h5>
            </div>

            <div class="row">
                <a href="<?php echo URL::site('admin/campaigns/index')?>">
                    <div id="campaign_chart" style="text-align: center">
                     <h2><?php echo $campaigns?></h2>
                    </div>
                </a>
            </div>
        </div><! --/grey-panel -->
    </div><!-- /col-md-4-->
    
     <div class="col-md-4 col-sm-4 mb">
        <div class="white-panel pn">
            <div class="white-header">
                <h5>Usuarios</h5>
            </div>

            <div class="row">
                <a href="<?php echo URL::site('admin/users/index')?>">
                    <h2> <?php echo $users?></h2>
                </a>
            </div>
        </div><! --/grey-panel -->
    </div><!-- /col-md-4-->
</div><!-- /col-md-4 -->