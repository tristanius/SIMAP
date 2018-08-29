app.controller("gestion_apu",function($scope, $http, $timeout){
	$scope.loader = false;

	$scope.proyectos = [];
	$scope.proyecto = undefined;

	$scope.vers = {};
	$scope.vr = {};

	$scope.material = [];
	$scope.personal = [];
	$scope.equipo = [];

	$scope.formItem = {};
	$scope.myapu = {};

	$scope.lista_items = [];


	$scope.currentPage = 0;
	$scope.pageSize = 10;
	$scope.filteredItems = [];

	$scope.open = function(tag){
		$(tag).foundation('open');
	}

	// Petición POST Generica
	$scope.peticion = function(lnk, data, func){
		$scope.loader = true;
		$http.post(lnk, data).then(
			function(resp){
				func(resp);
				$scope.loader = false;
			},
			function(resp){
				alert("Error de peticion al servidor, Si persiste el error comunicalo al dpto TIC.");
				console.log(resp.data);
				$scope.loader = false;
			}
		);
	}

	$scope.modItem = function(tag, it){		
		$scope.formItem = it;
		$scope.$parent.vmodal(tag, 'open');
	}

	$scope.getProyectos = function(lnk){
		$scope.loader = true;
		$http.get(lnk).then(
			function(resp){
				if(resp.data.status){
					$scope.proyectos_headers = resp.data.proyectos_headers;
					$scope.proyectos = resp.data.proyectos;
				}else{
					alert('Algo ha salido mal')
					console.log(resp.data)
				}
				$scope.loader = false;
			},
			function(resp){
				alert('Error de consulta de servidor');
				console.log(resp.data);
				$scope.loader = false;
			}
		);
	}

	$scope.seleccionarProyecto = function(pr){
		// consulta mejorada mejorado
		var lnk = $scope.site_url+'/proyecto/get/'+pr.idproyecto; // para obtener la información detallada del proyecto
		var lnkConsulta = $scope.site_url+'/apu/listadoby/'; // consultar el listado de APU del proyecto seleccionado
		$scope.peticion(lnk, {}, function(resp){
			if(resp.data.status){
				$scope.proyecto = resp.data.proyecto;						
				$scope.proyecto.lista_grupo_apu = $scope.$parent.isJSON( pr.lista_grupo_apu );
				$scope.proyecto.lista_clasificacion_apu = $scope.$parent.isJSON( pr.lista_clasificacion_apu );
				$scope.getListado( pr.idproyecto, lnkConsulta );
			}else{
				alert('No se ha podido realizar correctamente la asignación del proyecto.');
			}
		} );
	}


	$scope.getListado = function(idproyecto, lnk){
		$scope.loader = true;
		console.log(lnk)
		$http.get(lnk+idproyecto).then(
			function(resp){
				console.log(resp.data);
				if(resp.data.status == true){
					$scope.lista_items = resp.data.listado;
					$scope.materiales = resp.data.materiales;
					$scope.equipos = resp.data.equipos;
					$scope.personal = resp.data.personal;
				}else{
					alert('algo no ha salido como esperabamos.');
					console.log(resp.data);
				}
				$scope.loader = false;
			},
			function(resp){				
				alert('Error de consulta al servidor');
				console.log(resp.data);
				$scope.loader = false;
			}
		);
	}
	
	/* ---- proyecto ---- */	
	$scope.addGrupo = function(item, proyecto, lista, lnk){		
		var it = angular.copy(item);
		if(!proyecto[lista]){
			proyecto[lista] = [];
		}
		var valid = true;
		angular.forEach(proyecto[lista], function(v,k){
			if(v == it)
				valid = false;
		});
		if (valid) {
			$scope.loader = true;
			proyecto[lista].push(it);
			$scope.save_grupo(lnk, proyecto);
		}
		item ={};
	}

	$scope.delGrupo = function(item, proyecto, lista, lnk){
		if(confirm('Esta seguro de eliminar esta agrupación? esto no afectara items ya agregados')){
			var ind = proyecto[lista].indexOf(item);
			proyecto[lista].splice(ind,1);
			$scope.save_grupo(lnk, proyecto);
		}
	}

	$scope.save_grupo = function(lnk, proyecto){
		$scope.loader = true;
		$http.post(lnk, proyecto).then(
			function(resp){
				if(resp.data.status == true){
					proyecto = resp.data.proyecto;
				}else if(resp.data.status == false){
					alert(resp.data.msj);
				}
				$scope.loader = false;
			},
			function(resp){
				alert('Error de consulta al servidor');
				console.log(resp.data);
				$scope.loader = false;
			}
		);
	}

	// -------------------------------------------------------
	// Versiones de APU

	$scope.addVersion = function(lnk){
		$scope.peticion(lnk, $scope.proyecto, function(resp){
			console.log(resp.data)
			if(resp.data.status){
				$scope.proyecto.versiones = resp.data.versiones;
				$scope.getListado($scope.proyecto.idproyecto, $scope.site_url+'/apu/listadoby/');
			}else{
				alert('algo ha fallado');
				console.log(resp.data)
			}
		});
	}

	$scope.delVersion = function(lnk, vr){
		// enviar peticion
		// si es exitosa eliminar del listado de versiones
	}

	$scope.selectVersion = function(lnk, idversion){
		$scope.proyecto.idversion = idversion;
		$scope.peticion(lnk, 
			{ idproyecto: $scope.proyecto.idproyecto, idversion: $scope.proyecto.idversion }, 
			function(resp){
				if(resp.data.status){
					console.log(resp.data.sql);
					$timeout(function(){
						$scope.proyecto.subtotales = resp.data.subtotales;
						$scope.proyecto.subtotales_grupo = resp.data.subtotales_grupo;
						$scope.proyecto.cantidades_tipo = resp.data.cantidades_tipo;
					})
				}else{
					console.log(resp.data)
					alert("No ha sido cargado ningún subtotal")
				}
			}
		);
	}

	/* -------- formulario de Item APU------*/
	// guardar Item para APU
	$scope.save_item = function(lnk, vtag){
		$scope.loader = false;
		if( !confirm("¿Estas seguro de guardar este registro?") ){
			return;
		}
		if(! $scope.$parent.existBy( $scope.lista_items, 'item', $scope.formItem.item )){
			$scope.save(lnk, $scope.formItem, function(resp){
				$scope.formItem = {};
				$scope.vmodal(vtag, 'close');
				$scope.getListado($scope.proyecto.idproyecto, $scope.site_url+'/apu/listadoby/');
				$scope.selectVersion($scope.site_url+'/apu/subtotales_proyecto', $scope.proyecto.idversion);
			});
		}else{
			alert('Item ya existente');
			$scope.loader = true;
		}
	}

	/* -------- formulario de APU detallado ------*/
	$scope.form_apu = function(lnk, vtag){
		$http.get(lnk).then(
			function(resp){
				$scope.myapu = resp.data.apu;
				$scope.myapu.valor_und = 0;
				$scope.calcular_subtotales();
			},
			function(resp){
				console.log(resp.data)
			}
		);
		$scope.vmodal(vtag);
	}

	$scope.addRecursos = function(propiedad, lista, tag){
		if(!$scope.myapu[propiedad]){
			$scope.myapu[propiedad] = [];
		}
		angular.forEach(lista, function(v, k){
			if(v.seleccion == true){
				var f = v;
				$scope.myapu[propiedad].push(f);
				v.seleccion = false;
			}
		});
		$scope.vmodal(tag, 'close');
	}

	// Guardar analisis detallado
	$scope.save_apu = function(lnk, vtag ){
		$scope.loader = false;
		if( !confirm("¿Estas seguro de guardar este analisis de precios unitarios?") ){
			return;
		}
		$scope.save(lnk, $scope.myapu, function(resp){
			$scope.myapu = {};
			$scope.vmodal(vtag, 'close');
			$scope.getListado($scope.proyecto.idproyecto, $scope.site_url+'/apu/listadoby/');
			$scope.selectVersion($scope.site_url+'/apu/subtotales_proyecto', $scope.proyecto.idversion);
		});
	}
	// Guardar APU
	$scope.save = function(lnk, myitem, func){
		$http.post(lnk, {item: myitem, idproyecto: $scope.proyecto.idproyecto} ).then(
			function(resp){
				if(resp.data.status){
					func(resp);
				}else{
					var msj = resp.data.msj? resp.data.msj: '';
					alert('No se ha podido realizar la accion. '+msj );
					console.log(resp.data);
				}
				console.log(resp.data);
			},
			function(resp){
				alert('Error de consulta al servidor');
				console.log(resp.data);
				$scope.loader = false;
			}
		);
	}
	// -------------Calculo de subtotales---------------

	// Caculo de subtotal por item
	$scope.calc_subtotal = function(item, calculo){
		var t = item.costo_unidad / (item.cantidad * item.rendimiento);	
		item.subtotal = parseFloat(t).toFixed(2);
	}
	
	$scope.calcular_subtotales = function(){
		$scope.calcular_personal();
		$scope.calcular_equipos();
		$scope.calcular_material();	
	}
	// subtotales generales
	$scope.calcular_personal = function(){
		$scope.myapu.subtotal_personal = 0;
		var suma = 0;
		angular.forEach($scope.myapu.personal, function(v, k){
			suma += v.subtotal*1;
		});
		$scope.myapu.subtotal_personal = suma*1;
		$scope.myapu.valor_und = $scope.myapu.subtotal_personal  + $scope.myapu.subtotal_equipos + $scope.myapu.subtotal_material;
	}

	$scope.calcular_equipos = function(){
		var suma = 0;
		$scope.myapu.subtotal_equipos = 0;
		angular.forEach($scope.myapu.equipos, function(v, k){
			suma += v.subtotal*1;
		});
		$scope.myapu.subtotal_equipos = suma*1;
		$scope.myapu.valor_und = $scope.myapu.subtotal_personal  + $scope.myapu.subtotal_equipos + $scope.myapu.subtotal_material;
	}

	$scope.calcular_material = function(){
		var suma = 0;
		$scope.myapu.subtotal_material = 0;
		angular.forEach($scope.myapu.materiales, function(v, k){
			suma += v.subtotal*1;
		});
		$scope.myapu.subtotal_material = suma*1;
		$scope.myapu.valor_und = $scope.myapu.subtotal_personal  + $scope.myapu.subtotal_equipos + $scope.myapu.subtotal_material;
	}
});

// -------------------------------------------------------------------------------------------
// importar APU

app.controller("importar_apu",function($scope, $http, $timeout){
	$scope.peticion = undefined;
	$scope.resultados = [];

	$scope.loader = false;

	$scope.resetInputFile = function(tag){
		$(tag).val(null);
	}

	$scope.subirArchivo = function(tag, progress, lnk){
		// asignamos el input del archivo
		let inputFile = $(tag);	
		// creamos la peticion
		$scope.peticion = new XMLHttpRequest();
		// Evento para progreso de carga
		$scope.loader = true;
		$scope.peticion.upload.addEventListener('progress', (event)=>{
			let porcentaje = Math.round((event.loaded / event.total) * 100);
			var prog = $(progress).val(porcentaje);
		});
		// Evento de finalizado de carga
		$scope.peticion.onload = function() {
			console.log($scope.peticion.responseText);
			if($scope.peticion.status == 200){
				let resp = $scope.$parent.isJSON($scope.peticion.responseText);
			    if(resp.status==true){
			    	alert('Archivo cargado correctamente')
			    	$timeout(function(){
			    		$scope.resultados = resp.resultados;
			    	});
			    	$(tag).val(null);
			    }else{
			    	alert(resp.msj);
			    	$(tag).val(null);
			    }
			}else{
				$(tag).val(null);
				alert("Error de consulta al servidor");
				console.log("Status: " + $scope.peticion.status + " occurred uploading your file. ["+$scope.peticion.responseText+"] ");		
			}
			$scope.loader = false;
		};
		// preparamos el envio
		$scope.peticion.open('POST', lnk, true);
		// preparamos la informacion del formulario a enviar
		let fd = new FormData();
		// agregamos los archivos
		fd.append('file', inputFile[0].files[0] );
		fd.append('idversion', $scope.$parent.proyecto.idversion );
		fd.append('idproyecto', $scope.$parent.proyecto.idproyecto );
		// Enviamos la información
		$scope.peticion.send( fd );
	}
});
