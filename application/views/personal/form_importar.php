<div class="reveal large" id="form_importar_personal" data-reveal ng-controller="import_personal">
	  <h4>Importar cargos de personal</h4>
	  
	  <button class="close-button" data-close aria-label="Close reveal" type="button">
	    <span aria-hidden="true">&times;</span>
	  </button>

	  <fieldset class="fieldset">
	  	<legend>Seleccion de archivo</legend>

	  	<div class="grid-x"  ng-init="getProyectos('<?= site_url('proyecto/get') ?>')">
	  		<div class="cell medium-4">
				<label>
					Proyecto: 
					<select ng-model="idproyecto" ng-options="pr.idproyecto as pr.nombre_proyecto for pr in proyectos"> 
						<option value="">Selecciona un proyecto</option>
					</select>
				</label>
			</div>
	  	</div>

	  	
		<div class="grid-container full">
			<div class="grid-x grid-padding-x callout secondary">
		  		<div class="medium-5 cell">
		  			<label for="import_personal">
		  				Selecciona aquí el archivo:
						<input type="file" id="import_personal" name="import_personal" ng-init="resetInputFile('#import_personal')" style="display: inline-block;" ng-disabled="!idproyecto">
					</label>
		  		</div>

		  		<div class="medium-6 cell">
		  			<button class="button primary" 
		  				ng-click="subirArchivo('#import_personal', '#pg_import_personal', '<?= site_url('personal/import_file') ?>')"
		  				ng-disabled="!idproyecto">
		  				Importar desde archivo
		  			</button> 
		  		</div>

				<progress id="pg_import_personal" value="0" max="100" style="width:100%"></progress>	
		  	</div>
		</div>
	  	

	  </fieldset>

	  <fieldset class="fieldset">
	  	<legend>Resultados</legend>
	  	<table class="table stack hover font12">
			<caption>
				<h5>Resultados de cargos de personal</h5>
			</caption>
			<thead>
				<tr>
					<th>Resultado</th>
					<th>Codigo</th>
					<th>Cargo</th>
					<th>Nivel</th>
					<th>Tipo cargo</th>
					<th>Unidad</th>
					<th>Costo Und.</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="res in resultados">
					<td ng-bind="res['resultado']"></td>
					<td ng-bind="res[0]"></td>
					<td ng-bind="res[1]"></td>
					<td ng-bind="res[2]"></td>
					<td ng-bind="res[3]"></td>
					<td ng-bind="res[4]"></td>
					<td ng-bind="res[5] | currency"></td>
				</tr>
			</tbody>
		</table>
	  </fieldset>

	  <p>
	  	<button class="button alert"  data-close aria-label="Close reveal" type="button">Cerrar</button>
	  </p>
</div>