var app = angular.module("app", []);

app.controller("main",function($scope, $http, $timeout){
	$scope.site_url = undefined;

	$scope.datepicker = function(tag){
		$(tag).datepicker({
				autoPick: true,
				format: 'yyyy-mm-dd'
		});
	}

	$scope.init_modal = function(tag){
		var el = $(tag+'.vmodal');
		 el.on("click",function(ev){
	        if(ev.target == this) el.toggleClass('no-display');
	    });
	}

	$scope.vmodal = function( tag, caso){
		$(tag).toggleClass('no-display');
	}

	$scope.init_tabs = function(tag){
		var el = $(tag);
		Foundation.tabs(el);
	}

	/* utilities */ 

	$scope.toLower = function(str){
		return str.toLowerCase();
	}

	$scope.existBy = function(list, field, search){
		angular.forEach(list, function(v,k){
			if(v[field] && v[field] == search){
				return true;
			}
			if(!v[field]){
				console.log('campo no existe')
			}
		});
		return false;
	}

	$scope.isJSON = function(str){
		try {
	        return JSON.parse(str);
	    } catch (e) {
	        return {};
	    }
	}

	$scope.parseNumb = function(num){
		if(isNaN(num)){
			return 0;
		}
		return parseFloat(num);
	}
	
	$scope.numberOfPages=function(lista, pageSize){
	    return Math.ceil(lista.length/pageSize);
	 }
});

//let's make a startFrom filter
app.filter('startFrom', function() {
  return function(input, start) {
    start = +start; //parse to int
    return input.slice(start);
  }
});

