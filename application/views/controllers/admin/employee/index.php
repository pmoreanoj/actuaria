<div>
    <h3><?php echo $campaign->name . ' - ' . $campaign->company->name ?></h3>
</div>

<div class="row mt">
    <div class="col-md-4 col-sm-4 mb">
        <div class="white-panel pn">
            <div class="white-header">
                <h5>Empleados</h5>
            </div>

            <div class="row">
                <a href="<?php echo URL::site('admin/employee/campaignview') . '?id=' . $campaign->id ?>">
                    <h2><?php echo count($campaign->employees->find_all()) ?></h2>
                </a>
            </div>
        </div><! --/grey-panel -->
    </div><!-- /col-md-4-->

    <div class="col-md-4 col-sm-4 mb">
        <div class="white-panel pn">
            <div class="white-header">
                <h5>Subir empleados</h5>
            </div>

            <div class="row">
                <a href="<?php echo URL::site('admin/employee/campaign') . '?campaign=' . $campaign->id ?>">
                    <h2 class="fa fa-upload"></h2>
                </a>
            </div>
        </div><! --/grey-panel -->
    </div><!-- /col-md-4-->

    <div class="col-md-4 col-sm-4 mb">
        <div class="white-panel pn">
            <div class="white-header">
                <h5>Relaciones</h5>
            </div>

            <div class="row">
                <a href="<?php echo URL::site('admin/Assignations') . '?id=' . $campaign->id ?>">
                    <h2 class="fa fa-users"></h2>
                </a>
            </div>
        </div><! --/grey-panel -->
    </div><!-- /col-md-4-->
</div>

<div class="row mt">
    <div class="col-md-4 col-sm-4 mb">
        <div class="white-panel pn">
            <div class="white-header">
                <h5>Usuarios</h5>
            </div>

            <div class="row">
                <a href="<?php echo URL::site('admin/users/campaign') . '?campaign=' . $campaign->id ?>">
                    <h2 class="fa fa-users"></h2>
                </a>
            </div>
        </div><! --/grey-panel -->
    </div><!-- /col-md-4-->
</div>
