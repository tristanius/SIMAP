<section id="form_grupos" class="vmodal no-display" ng-init="init_modal('#form_grupos')">
	<div class="vmodal-content clearfix">
		<h5>Agrupaciones del proyecto</h5>
		<img src="<?= base_url('assets/img/ajax-loader.gif') ?>" width="20" height="20" ng-show="loader">

		<div class="grid-x grid-padding-x grid-margin-x font12">
			
			<fieldset class="cell medium-6 fieldset" ng-init="mygrupo = {}">
				<legend>Grupos de APUs &nbsp; &nbsp; <button class="hollow button success"> <small>Importar</small> </button> </legend>
				
				<div>
					<label>Nombre de grupo</label>
					<input type="text" ng-model="mygrupo.nombre_grupo" placeholder="ingresa una agrupación de items">
					<button class="button success" ng-click="addGrupo(mygrupo, proyecto, 'lista_grupo_apu', '<?= site_url('proyecto/save') ?>'); mygrupo = {}">Add.</button>
				</div>

				<table>
					<caption>Grupos de item / APU</caption>
					<thead>
						<tr>
							<th>No.</th>
							<th>Nombre de grupo</th>
							<th>Borrar</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="g in proyecto.lista_grupo_apu track by $index">
							<td ng-bind="$index+1"></td>
							<td ng-bind="g.nombre_grupo"></td>
							<td><button class="button alert tiny" ng-click="delGrupo( g, proyecto, 'lista_grupo_apu', '<?= site_url('proyecto/save') ?>' )"> x</button></td>				
						</tr>
					</tbody>
				</table>

			</fieldset>

			<fieldset class="cell medium-6 fieldset" ng-init="myclasificacion = {}">
				<legend>clasificaciones de APUs  &nbsp;&nbsp; <button class="hollow button success"> <small>Importar</small> </button> </legend>
				
				<div>
					<label>Nombre de clasificacion</label>
					<input type="text" ng-model="myclasificacion.nombre_clasificacion" placeholder="ingresa una clasificación de items">
					<button class="button success" ng-click="addGrupo(myclasificacion, proyecto, 'lista_clasificacion_apu', '<?= site_url('proyecto/save') ?>');">Add.</button>
				</div>

				<table>

					<thead>
						<caption>Clasificaciones</caption>
						<tr>
							<th>No.</th>
							<th>Nombre de Clasificación</th>
							<th>Borrar</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="cl in proyecto.lista_clasificacion_apu track by $index">
							<td ng-bind="$index+1"></td>
							<td ng-bind="cl.nombre_clasificacion" ></td>
							<td><button class="button alert tiny" ng-click="delGrupo( cl, proyecto, 'lista_clasificacion_apu', '<?= site_url('proyecto/save') ?>' ); myclasificacion = {}"> x</button></td>
						</tr>
					</tbody>
				</table>

			</fieldset>

		</div>

		<div class="float-right">
			<button class="hollow button alert" ng-click="vmodal('#form_grupos', 'close');myclasificacion={}; mygrupo={};" > 
				<i class="fas fa-times-circle"></i> Volver
			</button>
		</div>
	</div>
</section>