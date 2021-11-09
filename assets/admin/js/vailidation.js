 $(function() {

          // Initialize form validation on the registration form.
          // It has the name attribute "registration"


           jQuery.validator.addMethod("checkUserName", function(value, element) {
            var isSuccess = false;           
                  $.ajax({
                      type: 'POST',
                      url: location.origin+'/btc/public/home/checkUnique',
                      data : {username : value  },
                      async: false, 
                      dataType : 'JSON',            
                      success: function (response) {
                          if (response.usernameCount > 0) {
                             
                              isSuccess  = false;
                          } else {

                              isSuccess  = true;
                          }
                      }
                    });
                   return isSuccess;        
              });

          jQuery.validator.addMethod("UserEmail", function(value, element) {
            var isSuccess = false;           
            $.ajax({
                type: 'POST',
                url:  location.origin+'/btc/public/home/checkUnique',
                data : {email : value },
                async: false, 
                dataType : 'JSON',            
                success: function (response) {

                    if (response.emailCount > 0) {
                       
                        isSuccess  = false;

                    } else {
                     
                        isSuccess  = true;
                    }
                }
              });
            console.log(isSuccess);
             return isSuccess;        
          });


          jQuery.validator.addMethod("greaterThan",
            function (value, element, params) {


                if (!/Invalid|NaN/.test(value)) {

                    return true;
                } else if(isNaN(value) && isNaN($(params).val())
                        || (Number(value) < Number($(params).val()))) {

                  return true;

                } else {

                    return false;
                }

                 
            });

            // jQuery.validator.addMethod("PirceCheck", function(value, element, param) {
            // var isSuccess = false;           
            //         console.log(value);
            //         console.log(value);
            //         console.log(param);

            //        return isSuccess;        
            //   });
         
           $("form[name='registration']").validate({


             // Specify validation rules
             rules: {
                        user_type : "required",
                        age: {
                                 required: true
                             },
                        height: "required",
                        weight: "required",
                        target_weight : {
                           required: true,
                           greaterThan : '#weight',

                        },
                        username : {
                            required: {
                            depends:function(){
                                $(this).val($.trim($(this).val()));
                                return true;
                            }
                          },

                          checkUserName : true
                        },

                        first_name :  {
                            required: {
                            depends:function(){
                                $(this).val($.trim($(this).val()));
                                return true;
                            }
                          }
                        },
                        last_name : {
                            required: {
                            depends:function(){
                                $(this).val($.trim($(this).val()));
                                return true;
                            }
                          }
                        },
                        // activity : "required",
                        email: {
                           
                            required: {
                            depends:function(){
                                $(this).val($.trim($(this).val()));
                                return true;
                            }
                          },
                          email: true,
                          UserEmail : true
                        },
                        password: {
                           
                            required: {
                            depends:function(){
                                $(this).val($.trim($(this).val()));
                                return true;
                            }
                          },
                           minlength: 6
                        },
                                               
                        confirm_password : {
                           minlength : 6,
                           equalTo : "#password"
                        },

                        price : {
                           
                            required: {
                            depends:function(){
                                $(this).val($.trim($(this).val()));
                                return true;
                            }
                          },
                        },

                        product_id : "required",

                        plan_price : {
                           
                            required: {
                            depends:function(){
                                $(this).val($.trim($(this).val()));
                                return true;
                            }
                          },
                        }


                },
             // Specify validation error messages
             messages: {

                user_type : "Please select user type",

               age: {
                  required: "Please enter your age"
                  // age: "You must be at least 18 years old!"

               },

               height: "Please enter your height",
               
               weight: "Please enter your weight",
               
               target_weight: { 
                     required : "Please enter your target weight",
                     greaterThan : 'Target weight must be less than current weight',
                     min : jQuery.validator.format("Please enter a more realistic target weight. We suggest {0} Kg or a bit more!")
               },
               username: {

                    required : "Please enter your username",
                    checkUserName : "This username already exists"   
               },

               first_name: "Please enter your first name",

               last_name: "Please enter your last name",
               // activity: "Please enter your activity",
               email : {
                    required : "Please enter your email address",
                    email : "Please enter a valid email address",
                    UserEmail : "This email address already exists" 
               },
        
               password: {
                 required: "Please provide a password",
                 minlength: "Your password must be at least 6 characters long"
               },

               confirm_password: {
                 minlength: "Your password must be at least 6 characters long",
                 equalTo : "Your password not match"
               },

               price : { 
                    required: "Please enter your challenge price"
                },

               product_id : "Please enter your product type",

               plan_price : { 
                    required: "Please enter your plan price"
                }
              
               
             },
             // Make sure the form is submitted to the destination defined
             // in the "action" attribute of the form when valid
             submitHandler: function(form) {

               
                setTimeout(function() {
                  form.submit();
                 
                }, 2000);   
            
             }
           });


      });