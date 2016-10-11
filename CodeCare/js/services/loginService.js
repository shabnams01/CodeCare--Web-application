
app.factory('LoginService', function($http,$location,SessionService){
  return{
    login : function(user,scope){
      console.log('enter function service');

      //To check if the username and password is not null
      if(user){
        var $httpPost = $http.post('data/userLogin.php',user);

        $httpPost.then(function(msg)
        {
          var uid=msg.data;
          if(uid=="success")
          {
            console.log('Sucessful Login');
            //set the user details in a session
            SessionService.set('user',uid);
            $location.path('/home');
          }
          else{
            scope.msgtxt = 'Error:'+msg.data
            console.log('Error:'+msg.data);
            $location.path('/login');
          }
        });
      }
    },
    logout : function(){
      console.log('enter logout function service');
      SessionService.destroy('user');
      $location.path('/login');
    },
    isLogged : function(){
      if(SessionService.get('user')){
        return true;
      }
    }
  }
});
