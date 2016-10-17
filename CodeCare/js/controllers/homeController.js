app.controller(
  'HomeController',
  ['$scope','LoginService', 'HomeService',function($scope, LoginService, HomeService)
  {
    $scope.today = new Date();

    $scope.txt='Welcome to CODE-CARE';
    $scope.logout=function(){
      LoginService.logout();
    };

    $scope.status='';
    $scope.sendMessage=function(eMsg){
      console.log('insde home controller send Message');
      HomeService.sendMessage(eMsg,$scope);
    };

    $scope.getMessage=function(eMsg){
      console.log('insde home controller get Message');
      HomeService.getMessage(eMsg,$scope);
    };
  }
]);
