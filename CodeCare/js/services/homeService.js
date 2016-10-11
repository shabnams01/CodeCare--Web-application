app.factory('HomeService', function($http,$location){
  return{
    sendMessage : function(eMsg,scope){
      console.log('enter sendMessage function service');

      if(eMsg){

        var $httpPost = $http.post('data/sendEmergencyMsgAll.php',eMsg);

        $httpPost.then(function(msg)
        {
          if(msg.data)
          {
            console.log('function returned');
            //set the status for the view
            scope.status= msg.data;
          }
        });
      }
      $location.path('/home');
    },
    getMessage : function(scope){
      console.log('enter getMessage function service');
      var $httpPost = $http.post('data/getResponseMsg.php');

      $httpPost.then(function(msg)
      {
        if(msg.data)
        {
          console.log('function returned');
          //set the status for the view
          scope.messageList= msg.data;
        }
      });

      $location.path('/home');
    }
  }
});
