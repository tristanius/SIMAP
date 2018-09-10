<section ng-controller="personal">
	<nav aria-label="You are here:" role="navigation">
		<ul class="breadcrumbs">
			<li><a href="#">Personal</a></li>
			<li><a href="#">Importar</a></li>
			<li class="disabled">form</li>
		</ul>
	</nav>

	<fieldset class="fieldset">
		<legend> <h5>Importar Cargos de Personal:</h5> </legend>
		<button class="button primary"  ng-click="open('#form_importar_personal')">Importar</button>
	</fieldset>
	
	<fieldset class="fieldset">
		<legend>Vista de Cargos por proyecto</legend>

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
				<button class="button warning" ng-click="listado('<?= site_url('personal/listado_cargos') ?>/'+idproyecto)" ng-disabled="!idproyecto">Consultar Cargos del proyecto</button>
			</div>			
		</div>		

		<table class="table stack hover font12" >
			<caption>
				<h5>Listado de cargos de personal</h5>
			</caption>
			<thead>
				<tr class="bg-gray-blue">
					<th>ID</th>
					<th>Proyecto</th>
					<th>Codigo</th>
					<th>Cargo</th>
					<th>Nivel</th>
					<th>Tipo cargo</th>
					<th>Unidad</th>
					<th>Costo Und.</th>
					<td>Delete</td>
				</tr>
				<tr>
					<th></th>
					<th> <input style="max-width: 20ex;" type="text" placeholder="filtro de busqueda" ng-model="filterCargosPer.nombre_proyecto"></th>
					<th> <input style="max-width: 20ex;" type="text" placeholder="filtro de busqueda" ng-model="filterCargosPer.codigo"></th>
					<th> <input style="max-width: 20ex;" type="text" placeholder="filtro de busqueda" ng-model="filterCargosPer.cargo"></th>
					<th> <input style="max-width: 20ex;" type="text" placeholder="filtro de busqueda" ng-model="filterCargosPer.nivel_salarial"></th>
					<th> <input style="max-width: 20ex;" type="text" placeholder="filtro de busqueda" ng-model="filterCargosPer.tipo_cargo"></th>
					<th> <input style="max-width: 20ex;" type="text" placeholder="filtro de busqueda" ng-model="filterCargosPer.unidad"></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="per in listado_personal | filter: filterCargosPer" ng-class="(!per.costo_unidad || per.costo_unidad == 0)?'bg-light-red':''">
					<td ng-bind="per.idpersonal"></td>
					<td ng-bind="per.nombre_proyecto"></td>
					<td ng-bind="per.codigo"></td>
					<td ng-bind="per.cargo"></td>
					<td ng-bind="per.nivel_salarial"></td>
					<td ng-bind="per.tipo_cargo"></td>
					<td ng-bind="per.unidad"></td>
					<td ng-bind="per.costo_unidad | currency"></td>
					<td> 
						<button type="button" class="button alert tiny" 
							ng-click="delete('<?= site_url('personal/remove') ?>/'+per.idpersonal, '<?= site_url('personal/listado_cargos') ?>/'+idproyecto);" 
							ng-disabled="!idproyecto">
							X
						</button>	 
					</td> 
				</tr>

			</tbody>
		</table>
	</fieldset>

	<?php $this->load->view('personal/form_importar'); ?>

	<!-- <div class="vmodal">
		<div class="vmodal-content">
			test
			<button class="close-button" data-close aria-label="Close reveal" type="button">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	</div>-->
</section>