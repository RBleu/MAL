$(function(){
    $('.show-pass').on('change', (e) => {
        let password = '';

        if($(e.target).attr('name') == 'show-pass')
        {
            password = $('input[name="password"]');
        }
        else
        {
            password = $('input[name="confirm-password"]');
        }


        if($(e.target).is(':checked'))
        {
            password.attr('type', 'text');
        }
        else
        {
            password.attr('type', 'password');
        }
    });

    $('.btn').on('click', () => {
        let username = $('input[name="username"]').val();
        let password = $('input[name="password"]').val();
        let confirmPassword = $('input[name="confirm-password"]').val();

        if(username.match(/^[\w]{4,20}$/g) != null && password.match(/^.{8,50}$/g) != null)
        {
            if(confirmPassword === undefined)
            {
                $('.log').trigger('submit');
            }
            else
            {
                if(password == confirmPassword)
                {
                    $('.log').trigger('submit');
                }
            }
        }
    });

    $('.field').on('keyup', (e) => {
        if(e.keyCode == 13)
        {
            $('.btn').trigger('click');
        }
    });

    $('input[name="confirm-password"]').on('keyup', (e) => {

    });
});