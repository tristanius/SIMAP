<section ng-controller="equipo">
	<nav aria-label="You are here:" role="navigation">
		<ul class="breadcrumbs">
			<li><a href="#">Equipos</a></li>
			<li><a href="#">Importar</a></li>
			<li class="disabled">form</li>
		</ul>
	</nav>
	<fieldset class="fieldset">
		<legend> <h5>Importar Items de Equipo:</h5> </legend>
		<button class="button primary"  ng-click="open('#form_importar_equipo')">Importar</button>
	</fieldset>
	
	<fieldset class="fieldset">
		<legend>Vista de Equipos por proyecto</legend>

		<div ng-init="getProyectos('<?= site_url('proyecto/get') ?>')" class="grid-x">
			<div class="cell medium-4">
				<label>
					Proyecto: 
					<select ng-model="idproyecto" ng-options="pr.idproyecto as pr.nombre_proyecto for pr in proyectos"> 
						<option value="">Selecciona un proyecto</option>
					</select>
				</label>
			</div>
			<div class="cell medium-12">
				<button class="button warning" ng-click="listado('<?= site_url('equipo/listado_equipos') ?>/'+idproyecto)" ng-disabled="!idproyecto">Consultar equipos del proyecto</button>
			</div>			
		</div>		

		<table class="table stack font12" >
			<caption>
				<h5>Listado de Equipos del proyecto</h5>
			</caption>
			<thead>
				<tr class="bg-gray-blue">
					<th>ID</th>
					<th>Proyecto</th>
					<th>Codigo</th>
					<th>Descripción</th>
					<th>Unidad</th>
					<th>Costo Und.</th>
					<th>Delete</th>
				</tr>
				<tr>
					<th></th>
					<th> <input style="max-width: 20ex;" type="text" placeholder="filtro de busqueda" ng-model="filterItemsEquipos.nombre_proyecto"></th>
					<th> <input style="max-width: 20ex;" type="text" placeholder="filtro de busqueda" ng-model="filterItemsEquipos.codigo"></th>
					<th> <input style="max-width: 20ex;" type="text" placeholder="filtro de busqueda" ng-model="filterItemsEquipos.descripcion_equipo"></th>
					<th> <input style="max-width: 20ex;" type="text" placeholder="filtro de busqueda" ng-model="filterItemsEquipos.unidad"></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="eq in listado_equipos | filter: filterItemsEquipos" ng-class="(!eq.costo_unidad || eq.costo_unidad == 0)?'bg-light-red':''">
					<td ng-bind="eq.idequipo"></td>
					<td ng-bind="eq.nombre_proyecto"></td>
					<td ng-bind="eq.codigo"></td>
					<td ng-bind="eq.descripcion_equipo"></td>
					<td ng-bind="eq.unidad"></td>
					<td ng-bind="eq.costo_unidad | currency"></td>
					<td> 
						<button class="button alert tiny" ng-click="delete('<?= site_url('equipo/remove') ?>/'+eq.idequipo, '<?= site_url('equipo/listado_equipos') ?>/'+idproyecto )">X
						</button> 
					</td>
				</tr>

			</tbody>
		</table>
	</fieldset>

	<?php $this->load->view('equipo/form_importar'); ?>

	<!-- <div class="vmodal">
		<div class="vmodal-content">
			test
			<button class="close-button" data-close aria-label="Close reveal" type="button">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	</div>-->
</section>