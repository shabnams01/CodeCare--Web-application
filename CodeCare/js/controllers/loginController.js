app.controller('LoginController',function($scope, LoginService){

  $scope.msgtxt = '';
  $scope.login = function(user) {
      console.log('enter function');
      LoginService.login(user,$scope); // call to the login service
  };
});
