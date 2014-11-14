var Validation = function(){
    
    var validateLogin = function(){
        
        $('#userInfoLogin').validate({
            rules:{
                "auth[username]":{
                    required:true,
                },
                "auth[password]":{
                    required:true,
                },
            },
            messages:{
                "auth[username]":{
                    required:"Please, input the username.",
                },
                "auth[password]":{
                    required:"Please, input the password.",
                },
            },
            errorPlacement: function (error, element) {
	                error.insertAfter(element);
	            },
            submitHandler: function (form) {
	                form.submit();
	            }
        });
    }
    var validateRegister = function(){
        
        $('#userInfoReg').validate({
            rules:{
                "registerForm[username]":{
                    required:true,
                },
                "registerForm[email]":{
                    required:true,
                    email:true
                },
                "registerForm[date]":{
                    required:true,
                },
                "registerForm[password]":{
                    required:true,
                },
                "registerForm[retypepassword]":{
                    required:true,
                    equalTo:'input[name="registerForm[password]"]'
                },
            },
            messages:{
               "registerForm[username]":{
                    required:"Please, input the username.",
                },
                "registerForm[email]":{
                    required:"Please, input the email.",
                    email:"Email is not correct..."
                },
                "registerForm[date]":{
                    required:"Please, choose the date of your birth.",
                },
                "registerForm[password]":{
                    required:"Please, input the password",
                },
                "registerForm[retypepassword]":{
                    required:"Please, repeat the password.",
                    equalTo: "Please, input the same password."
                },
            },
            errorPlacement: function (error, element) {
	                error.insertAfter(element);
	            },
            submitHandler: function (form) {
	                form.submit();
	            }
        });
        
    };
        
        
    
    return {
      init:function(){
          validateLogin();
          validateRegister();
      }
    };
}();
