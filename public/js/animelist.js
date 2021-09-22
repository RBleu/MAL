$(function(){
    let tables = $('table');

    for(var i = 0; i < tables.length; i++)
    {
        let table_id = $(tables[i]).attr('id');
        $('#' + table_id).DataTable({
            'paging': false,
            'info': false,
        });
        $('#' + table_id + '_wrapper').hide();
    }

    $('#tables').show();

    $('#navbar a').on('click', (e) => {
        e.preventDefault();

        let value = $(e.target).attr('value');

        if(!$(e.target).is($('#navbar .selected')))
        {
            $('#navbar .selected').trigger('click');
        }

        $(e.target).toggleClass('selected');

        if($(e.target).is($('#navbar .selected')))
        {
            $('#' + value + '_wrapper').show();
        }
        else
        {
            $('#' + value + '_wrapper').hide();
        }
    });

    $('#navbar a[value="completed"]').trigger('click');
});