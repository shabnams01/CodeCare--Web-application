'use strict';

var app = angular.module('CodeCareApp', ['ngRoute']);

app.config(function($routeProvider){
  $routeProvider
    .when('/login',{
      templateUrl: 'partials/login.html',
      controller: 'LoginController'
    })
    .when('/home',{
      templateUrl: 'partials/home.html',
      controller: 'HomeController'
    })
    .otherwise({redirectTo:'/login'});
});

app.run(function($rootScope, $location,LoginService){
  var routesPermission = ['/home']; // route that requires login
  $rootScope.$on('$routeChangeStart', function(){
    if( routesPermission.indexOf($location.path()) !=-1 && !LoginService.isLogged())
      $location.path('/login');
  });
});
