$(function(){
    $('#checkbox').on('change', (e) => {
        if($(e.target).is(':checked'))
        {
            $('input[name="password"]').attr('type', 'text');
        }
        else
        {
            $('input[name="password"]').attr('type', 'password');
        }
    });

    $('.btn').on('click', () => {
        let username = $('input[name="username"]').val();
        let password = $('input[name="password"]').val();

        if(username.match(/^[\w]{4,20}$/g) != null && password.match(/^.{8,50}$/g) != null)
        {
            $('.log').trigger('submit');
        }
    });

    $('.field').on('keyup', (e) => {
        if(e.keyCode == 13)
        {
            $('.btn').trigger('click');
        }
    });
});