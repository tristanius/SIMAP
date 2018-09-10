<section ng-controller="material">
	<nav aria-label="You are here:" role="navigation">
		<ul class="breadcrumbs">
			<li><a href="#">Material</a></li>
			<li><a href="#">Importar</a></li>
			<li class="disabled">form</li>
		</ul>
	</nav>
	<fieldset class="fieldset">
		<legend> <h5>Importar Items de Material:</h5> </legend>
		<button class="button primary"  ng-click="open('#form_importar_material')">Importar</button>
	</fieldset>
	
	<fieldset class="fieldset">
		<legend>Vista de Material por proyecto</legend>

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
				<button class="button warning" ng-click="listado('<?= site_url('material/listado_material') ?>/'+idproyecto)" ng-disabled="!idproyecto">Consultar materiales del proyecto</button>
			</div>			
		</div>		

		<table class="table stack hover font12" >
			<caption>
				<h5>Listado de Material del proyecto</h5>
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
					<th> <input style="max-width: 20ex;" type="text" placeholder="filtro de busqueda" ng-model="filterItemsMaterial.nombre_proyecto"></th>
					<th> <input style="max-width: 20ex;" type="text" placeholder="filtro de busqueda" ng-model="filterItemsMaterial.codigo"></th>
					<th> <input style="max-width: 20ex;" type="text" placeholder="filtro de busqueda" ng-model="filterItemsMaterial.descripcion_material"></th>
					<th> <input style="max-width: 20ex;" type="text" placeholder="filtro de busqueda" ng-model="filterItemsMaterial.unidad"></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="mat in listado_material | filter: filterItemsMaterial" ng-class="(!mat.costo_unidad || mat.costo_unidad == 0)?'bg-light-red':''">
					<td ng-bind="mat.idmaterial"></td>
					<td ng-bind="mat.nombre_proyecto"></td>
					<td ng-bind="mat.codigo"></td>
					<td ng-bind="mat.descripcion_material"></td>
					<td ng-bind="mat.unidad"></td>
					<td ng-bind="mat.costo_unidad | currency"></td>
					<td> 
						<button class="button alert tiny" ng-click="delete('<?= site_url('material/remove') ?>/'+mat.idmaterial, '<?= site_url('material/listado_material') ?>/'+idproyecto )">X
						</button> 
					</td>
				</tr>

			</tbody>
		</table>
	</fieldset>

	<?php $this->load->view('material/form_importar'); ?>

	<!-- <div class="vmodal">
		<div class="vmodal-content">
			test
			<button class="close-button" data-close aria-label="Close reveal" type="button">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	</div>-->
</section>