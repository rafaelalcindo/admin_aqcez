app = angular.module('app',[]);

app.controller('listaPedidoController', function($scope, $http){
	$scope.listaPedidos = [];

	$http.get('cad_pedido/controller.php?tipo=lista_pedido').then(function(data){
		$scope.listaPedidos = data;
	});

});