<table class="table stack font12">
	<thead class="bg-gray-blue text-white">
		<tr>
			<th>No. Proyecto</th>
			<th>Objeto del proyecto</th>
			<th>Cliente</th>
			<th>Estado</th>
			<th>Agrupaciones</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td> 
				<span ng-bind="proyecto.nombre_proyecto"></span>  &nbsp;&nbsp;
				<button class="hollow button primary tiny" ng-click="vmodal('#seleccion-proyecto', 'open');"> <i class="fas fa-search"></i> </button> 
			</td>
			<td> <span ng-bind="proyecto.objeto"></span> </td>
			<td> <span ng-bind="proyecto.cliente"></span> </td>
			<td> <span ng-bind="proyecto.estado"></span>  <button class="button hollow tiny success"> <i class="fas fa-check-circle"></i> </button></td>
			<td>
				<button class="button hollow primary tiny" ng-click="vmodal('#form_grupos')" ng-disabled="!proyecto">
					<i class="fas fa-list"></i>
				</button>
			</td>
		</tr>
	</tbody>
</table>