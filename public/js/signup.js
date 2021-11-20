var plan_id = 0;
$(document).ready(function(){

        $('.plan-button').on('click', function(){
            plan_id = $(this).attr('data-plan-id');
        });

        $('#login-button').on('click', function(e){

            console.log('submit login');
            $('#login-alert').addClass('d-none');
            
            $.ajax({
                type: "POST",
                url: '/login',
                data: {
                    email : $('#login-form-email').val(),
                    password : $('#login-form-password').val(),
                    _token : $('input[name=_token]').val()
                }
            }).done(function() {
                window.location.href = '/signup/review/' + plan_id;
            })
            .fail(function() {
                $('#login-alert').removeClass('d-none');
            });

            return false;

        });


        $('#register-button').on('click', function(e){ 

            $.ajax({
                type: "POST",
                url: '/register',
                data: {
                    name : $('#register-form-name').val(),
                    email : $('#register-form-email').val(),
                    password : $('#register-form-password').val(),
                    password_confirmation : $('#register-form-password-confirmation').val(),
                    _token : $('input[name=_token]').val()
                }
            }).done(function( data ) {
                console.log(data);
                window.location.href = '/signup/review/' + plan_id;
            })
            .fail(function() {
                $('#register-alert').removeClass('d-none');
            });

            return false;
        });

    });