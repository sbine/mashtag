angular.module('Mashtag.services', [])
	.factory('mashtagAPIservice', function($http) {
		var mashtagAPI = {};

		mashtagAPI.getResults = function() {
			return $http({
				url: '/get_results'
			});
		};

		return mashtagAPI;
	});