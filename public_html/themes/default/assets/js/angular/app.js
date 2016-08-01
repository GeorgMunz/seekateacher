if (typeof angular != 'undefined') {
  var profileApp = angular.module('profileApp', ['profileControllers', 'ngRoute']);

  // profileApp.config(['$routeProvider',
  //   function($routeProvider) {
  //     $routeProvider.
  //       when('/teacher/profile', {
  //         controller: 'PublicProfileCtrl'
  //       });
  //   }
  // ]);
}
