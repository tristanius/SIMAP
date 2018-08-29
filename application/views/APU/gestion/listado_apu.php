
<button class="hollow button success" ng-click="vmodal('#form_item', 'open');" ng-disabled="!proyecto || !proyecto.idversion""> <i class="fas fa-plus"></i> Items / APU </button>
<button class="hollow button success" ng-click="vmodal('#form_importar_apu', 'open');" ng-disabled="!proyecto || !proyecto.idversion"> <i class="fas fa-cloud-upload-alt"></i> Importar </button>
<button class="hollow button success" ng-disabled="!proyecto"> <i class="fas fa-plus"></i> Exportar </button>




<img src="<?= base_url('assets/img/ajax-loader2.gif') ?>" ng-show="loader">

<table class="table stack font11">
	<thead>
		<tr>
			<th colspan="10"></th>
			<th>Subotal</th>
			<th class="bg-light-orange"><span ng-bind="proyecto.total_directo | currency: '$ ': 2 "></span></th>
			<th colspan="2"></th>
		</tr>
		<tr class="bg-gray-blue text-white">
			<th>No.</th>
			<th>Item</th>
			<th>Descripción</th>
			<th>Unidad</th>
			<th>Grupo</th>
			<th>Tipo</th>
			<th>Clasificación</th>
			<th>Composición</th>			
			<th>Cantidad</th>
			<th>Vr.</th>
			<th>Valor Unitario</th>
			<th>Total_Item</th>
			<th>Mod.</th>
			<th>APU</th>
		</tr>		
		<tr>
			<td> </td>
			<td> 
				<input type="text" class="thin-input filter no-visible" placeholder="filtro de datos" ng-model="filterItems.item">
			</td>
			<td> 
				<input type="text" class="thin-input filter no-visible" placeholder="filtro de datos" ng-model="filterItems.descripcion">
			</td>
			<td> 
				<input type="text" class="thin-input filter no-visible" placeholder="filtro de datos" ng-model="filterItems.unidad">
			</td>
			<td> 
				<input type="text" class="thin-input filter no-visible" placeholder="filtro de datos" ng-model="filterItems.grupo">
			</td>
			<td> 
				<input type="text" class="thin-input filter no-visible" placeholder="filtro de datos" ng-model="filterItems.tipo">
			</td>
			<td> 
				<input type="text" class="thin-input filter no-visible" placeholder="filtro de datos" ng-model="filterItems.clasificacion">
			</td>
			<td> 
				<input type="text" class="thin-input filter no-visible" placeholder="filtro de datos" ng-model="filterItems.composicion">
			</td>
			<td> 
				<input type="text" class="thin-input filter no-visible" placeholder="filtro de datos">
			</td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
			<td> </td>
		</tr>
	</thead>
	<tbody>
		<tr ng-repeat="item in filteredItems = ( lista_items | filter: filterItems ) | startFrom:currentPage*pageSize | limitTo:pageSize track by $index">
			<td ng-bind="$index+1"></td>
			<td ng-bind="item.item"></td>
			<td ng-bind="item.descripcion"></td>
			<td ng-bind="item.unidad"></td>
			<td ng-bind="item.grupo"></td>
			<td ng-bind="item.tipo"></td>
			<td ng-bind="item.clasificacion"></td>
			<td ng-bind="item.composicion"></td>
			<td ng-bind="item.cantidad" ></td>
			<td ng-bind="item.no_version"></td>
			<td ng-bind="item.valor_und | currency: '$ '" ng-init="item.valor_und = item.valor_und?item.valor_und:0"></td>
			<td ng-bind="item.total_directo | currency: '$ '"></td>
			<td> <button class="button hollow tiny warning" ng-click="modItem('#form_item', item);"> <i class="fas fa-pencil-alt" ></i> </button> </td>
			<td> <button class="button hollow tiny primary" ng-click="form_apu( '<?= site_url('apu/get/') ?>/'+item.idapu, '#form_apu' );" > APU </button> </td>
		</tr>
	</tbody>
</table>

<div>
	<button ng-disabled="currentPage == 0" ng-click="currentPage=currentPage-1" class="button tiny">
	  Anterior
	</button>
	{{currentPage+1}}/{{ numberOfPages(filteredItems, pageSize) }}
	<button ng-disabled="currentPage >= filteredItems.length/pageSize - 1" ng-click="currentPage=currentPage+1" class="button tiny">
	  Siguiente
	</button>
	&nbsp;
	Ir a: <input type="number" class="thin-input inline" max="numberOfPages" ng-model="pgNum" ng-change="currentPage = (pgNum-1 > 0)?(pgNum-1):0">
</div>