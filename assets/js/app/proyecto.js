app.controller("proyecto",function($scope, $http, $timeout){
	$scope.proyectos = [];
	$scope.proyectos_headers = [];
	$scope.formProyecto = {};
	$scope.getProyectos = function(lnk){
		$http.get(lnk).then(
			function(resp){
				if(resp.data.status){
					$scope.proyectos_headers = resp.data.proyectos_headers;
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

	$scope.modificar = function(pr){
		$scope.formProyecto = pr;
	}

	$scope.save = function(lnk, proyecto, lnk2){
		$http.post(lnk, proyecto).then(
			function(resp){
				if(resp.data.status == true){
					$scope.formProyecto = {};
					$scope.getProyectos(lnk2);
					alert("Guardado correctamente");
				}else if(resp.data.status == false){
					alert(resp.data.msj);
				}else{
					alert('Algo no ha salido como se esperaba');
					console.log(resp.data);
				}
			},
			function(resp){
				alert('Error de consulta al servidor');
				console.log(resp.data);
			}
		);
	}

	$scope.get = function(lnk){
		$http.get(lnk).then(
			function(resp){
				if(resp.data.status){
					alert(resp.data.msj);
				}else{
					alert(resp.data.msj);
					console.log(resp.data);
				}
			},
			function(resp){
				alert('Error de consulta al servidor');
				console.log(resp.data);
			}
		);
	}

});
