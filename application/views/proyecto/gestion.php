<section ng-controller="proyecto">
	<nav aria-label="You are here:" role="navigation">
		<ul class="breadcrumbs">
			<li><a href="#">Pryecto</a></li>
			<li><a href="#">Maestros</a></li>
			<li class="disabled">gestion</li>
		</ul>
	</nav>	
	<h4 class="callout">Maestro inf. basica proyectos</h4>

	<div class="grid-x grid-padding-x callout" ng-init="getProyectos('<?= site_url('proyecto/get') ?>')" >
		<h5 class="cell large-12"> formulario de inf. del proyecto </h5>
		<div class="medium-4 large-2 cell">
			<label>
				No. del proyecto: 
				<input type="text" ng-model="formProyecto.nombre_proyecto" ng- placeholder="EJ: Puente rojo - Bogotá">
			</label>
		</div>	

		<div class="medium-4 large-2 cell">
			<label>
				No. Contrato relacionado: 
				<input type="text" ng-model="formProyecto.no_contrato" ng- placeholder="EJ: Puente rojo - Bogotá">
			</label>
		</div>		

		<div class="medium-4 large-2 cell">
			<label>
				Cliente: 
				<input type="text" ng-model="formProyecto.cliente" placeholder="Objeto del proyecto">
			</label>
		</div>
		<div class="medium-4 large-2 cell">
			<label>
				Contratista: 
				<input type="text" ng-model="formProyecto.contratista" placeholder="Objeto del proyecto">
			</label>
		</div>
		
		<div class="medium-4 large-2 cell">
			<label>
				F. inicio: 
				<input id="dateProyectInicio" type="text" ng-model="formProyecto.inicio" placeholder="EJ: 1990-07-07" ng-init="datepicker('#dateProyectInicio')">
			</label>
		</div>
		<div class="medium-4 large-2 cell">
			<label>
				F. Final: 
				<input id="dateProyectFinal" type="text" ng-model="formProyecto.final" placeholder="EJ:  1990-07-24" ng-init="datepicker('#dateProyectFinal')">
			</label>
		</div>
		<div class="medium-4 large-3 cell">
			<label>
				Objeto  del proyecto: 
				<input type="text" ng-model="formProyecto.objeto" placeholder="Objeto del proyecto">
			</label>
		</div>
		<div class="medium-4 large-2 cell">
			<label>
				tipo de proyecto: 
				<select ng-model="formProyecto.tipo">
					<option value="Obras Civiles">Obras Civiles</option>
					<option value="Mantenimiento">Mantenimiento</option>
					<option value="Licitación estatal">Licitación estatal</option>
					<option value="Concesion vial">Concesion vial</option>
					<option value="Oil And Gas">Oil And Gas</option>
					<option value="Explotación energatica">Explotación energatica</option>
				</select>
			</label>
		</div>
		<div class="medium-12 large-12 cell">
			<p></p>
			<button class="hollow button primary" ng-click="save('<?= site_url('proyecto/save')  ?>', formProyecto, '<?= site_url('proyecto/get')  ?>')">Guardar</button> 
			<button class="hollow button alert" ng-click="formProyecto = {}">Cancelar</button>
		</div>
	</div>

	<div style="max-height: 500px; overflow: auto" class="callout font12">
		<table>
			<caption>Listado maestro de inf. basica de proyectos agregados</caption>
			<thead class="bg-gray-blue text-white">
				<tr>
					<th>Nombre del proyecto</th>
					<th>Objeto del proyecto</th>
					<th>No. Contrato</th>
					<th>Cliente</th>
					<th>Contratista</th>
					<th>F. Inicio</th>
					<th>F. Final</th>
					<th>Tipo de proyecto</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="pr in proyectos">
					<td ng-bind="pr.nombre_proyecto"></td>
					<td ng-bind="pr.objeto"></td>
					<td ng-bind="pr.no_contrato"></td>
					<td ng-bind="pr.cliente"></td>
					<td ng-bind="pr.contratista"></td>
					<td ng-bind="pr.inicio"></td>
					<td ng-bind="pr.final"></td>
					<td ng-bind="pr.tipo"></td>
					<td> 
						<button class="button warning" ng-click="modificar(pr)">Modificar</button>
					</td>
					<td> 
						<button class="button alert" ng-click="get('<?= site_url('proyecto/remove') ?>/'+pr.idproyecto); getProyectos('<?= site_url('proyecto/get') ?>')">X</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

</section>