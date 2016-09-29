<div class="content-panel">
	<div class="row">
            <div class="col-md-10">
		<h4>Empresas</h4></div>
	    <div class="col-md-1"><a href="<?php echo URL::site('admin/company/create')?>" >
	        <button type="button" class="btn btn-success">Crear Empresa</button>
	        </a>
		</div>
	</div>
    <hr></hr> 
	  <?php if (isset($companies)): ?>
	<div>
	    <table id="table_list" class="tablesorter table table-striped table-advance table-hover">
	        <thead>
	        	<tr>
		            <th>
		                Nombre
		            </th>
		            <th>
		                Email
		            </th>
		            <th>
		                Opciones
		            </th>
	        	</tr>
	        </thead>
	            <?php foreach ($companies as $company): ?>
	        <tr>
	            <td>
	                <?php echo $company->name?>
	            </td>
	            <td>
	                <?php echo $company->email?>
	            </td>
	            <td>
	                <button id="<?php echo $company->id?>" class="edit_company btn btn-primary" alt="Editar">Editar</button>
	                <button data-companyid="<?php echo $company->id?>" data-toggle="modal" data-target="#myModal" data-company="<?php echo $company->name?>" class=" btn btn-danger" alt="Borrar">Eliminar</button>
	            </td>
	            
	        </tr>

	            <?php endforeach; ?>

	        <?php endif; ?>

	    </table>
	    <div style="display: none;" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Aviso</h4>
              </div>
              <div class="modal-body">
                Desea eliminar a <span id="company-name"></span>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button data-dismiss="modal" type="button" class="btn btn-primary">OK</button>
              </div>
            </div>
          </div>
        </div>
	</div>
</div>
<script>
$(function() {
    /*
        $('#myModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
      var modal = $(this);
      modal.find('.modal-footer a').attr('href',button.data('link'));
    });
    */
});
</script>
