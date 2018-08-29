app.controller("material",function($scope, $http, $timeout){	
	$scope.proyectos = [];
	$scope.listado_material = [];
	$scope.idproyecto = undefined;

	$scope.open = function(tag){
		$(tag).foundation('open');
	}

	$scope.listado = function(lnk){
		$http.post(lnk, {}).then(
			function(resp){
				if(resp.data.status){
					console.log(resp.data)
					$scope.listado_material = resp.data.listado;
				}else{
					console.log(resp.data)
				}
			},
			function(resp){
				console.log(resp.data)
			}
		);
	}

	$scope.getProyectos = function(lnk){
		$http.get(lnk).then(
			function(resp){
				if(resp.data.status){
					$scope.proyectos = resp.data.proyectos;
				}else{
					alert('Algo ha salido mal')
					console.log(resp.data)
				}
			},
			function(resp){
				alert('Error de consulta de servidor');
				console.log(resp.data);
			}
		);
	}
	$scope.delete = function(lnk, lnkConsulta){
		$scope.peticion(lnk, {}, function(resp){
			if(resp.data.status){
				$scope.listado(lnkConsulta);
			}else{
				alert("No se ha podido borrar el elemento");
			}
		});
	}

	$scope.peticion = function(lnk, data, func){
		$http.post(lnk, data).then(
			function(resp){
				func(resp);
			},
			function(resp){
				alert("Error de peticion al servidor, Si persiste el error comunicalo al dpto TIC.");
				console.log(resp.data);
			}
		);
	}
});

app.controller("import_material",function($scope, $http, $timeout){
	$scope.peticion = undefined;
	$scope.resultados = [];

	$scope.resetInputFile = function(tag){
		$(tag).val(null);
	}

	$scope.subirArchivo = function(tag, progress, lnk){
		// asignamos el input del archivo
		let inputFile = $(tag);	
		// creamos la peticion
		$scope.peticion = new XMLHttpRequest();
		// Evento para progreso de carga
		$scope.peticion.upload.addEventListener('progress', (event)=>{
			let porcentaje = Math.round((event.loaded / event.total) * 100);
			var prog = $(progress).val(porcentaje);
		});
		// Evento de finalizado de carga
		$scope.peticion.onload = function() {
			if($scope.peticion.status == 200){
				let resp = JSON.parse($scope.peticion.responseText);
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
		};
		// preparamos el envio
		$scope.peticion.open('POST', lnk, true);
		// preparamos la informacion del formulario a enviar
		let fd = new FormData();
		// agregamos los archivos
		fd.append('file', inputFile[0].files[0] );
		fd.append('idproyecto', $scope.idproyecto );
		// Enviamos la información
		$scope.peticion.send( fd );
	}

	$scope.getProyectos = function(lnk){
		$http.get(lnk).then(
			function(resp){
				if(resp.data.status){
					$scope.proyectos = resp.data.proyectos;
				}else{
					alert('Algo ha salido mal')
					console.log(resp.data)
				}
			},
			function(resp){
				alert('Error de consulta de servidor');
				console.log(resp.data);
			}
		);
	}

});