	<table class="table stack font12">
		<thead class="bg-gray-blue text-white">
			<tr>
				<th>Version</th>
				<th>Subtotal</th>
				<th>Administración</th>
				<th>Imprevistos</th>
				<th>Utilidad</th>
				<th class="bg-light-orange">Total </th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td ng-init="filterItems = {}">
					<select style="width: 10ex;" ng-model="filterItems.version_idversion" 
						ng-options="vr.idversion as vr.no_version for vr in proyecto.versiones" 
						ng-if="proyecto.versiones" 
						ng-init="filterItems.version_idversion = proyecto.versiones[0].idversion; selectVersion('<?= site_url('apu/subtotales_proyecto') ?>', filterItems.version_idversion)"
						ng-change="selectVersion('<?= site_url('apu/subtotales_proyecto') ?>', filterItems.version_idversion)">
					</select>
					<button class="button tiny primary" ng-click="addVersion('<?= site_url('version/add') ?>')" ng-disabled="!proyecto"> <i class="fas fa-plus"></i> </button>
				</td>
				<td>$ </td>
				<td>$ </td>
				<td>$ </td>
				<td>$ </td>
				<td>$ </td>
			</tr>
		</tbody>
	</table>