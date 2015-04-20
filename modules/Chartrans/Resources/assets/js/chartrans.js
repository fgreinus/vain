(function() {
    $(document.body).on('click', 'input[data-destination-account]', function(e) {

        $('input#destination_realm').val($(this).data('realmid'));
    });

    $(document.body).on('click', 'button[data-server-type]', function(e) {

        var type = $(this).data('server-type');

        $(this).addClass('active').siblings().removeClass('active');

        $('.chartrans-disable-overlay').show();
        $('[data-server-type="' + type + '"]').find('.chartrans-disable-overlay').hide();


        $('input#source_server_type').val(type == 'official');
        e.preventDefault();
    });
})();