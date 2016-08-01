if (typeof angular != 'undefined') {

  var profileControllers = angular.module('profileControllers', []);

  profileControllers.controller('PublicProfileCtrl', ['$scope', '$http',
    function($scope, $http) {
      $http.get('/api/public-profile').success(function(data){
        console.log(data);
        $scope.publicProfile = data;
      });

      this.save = function() {
        console.log($scope.publicProfile);
        $.post('/api/public-profile', $scope.publicProfile).success(function(data){
          console.log(data);
        });
      }
    }
  ]);
  
}
