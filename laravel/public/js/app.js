function adsCtrl($scope, $http){
	$http.get("http://localhost/Piscine_MVC_Free_Ads/freeads/laravel/public/ads").success(function(ads){
		$scope.ads = ads;
	});

	$scope.remaining = function(){
		var count = 0;
	}

}