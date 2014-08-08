angular.module('Mashtag.controllers', [])
	.controller("index", function($scope, mashtagAPIservice) {
		$scope.tag;
		$scope.results = [];

		mashtagAPIservice.getResults().success(function(response) {
			$scope.results = response.results;
		});
	});