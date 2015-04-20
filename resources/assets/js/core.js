(function() {

    // make sure u use delegation!
    $(document.body).on('submit', 'form[data-remote]', function(e) {
        var form = $(this);
        var method = form.find('input[name="_method"]').val() || 'POST';
        var url = form.attr('action');

        $.ajax({
            url: url,
            type: method,
            data: form.serialize(),
            success: function()
            {
                var redirect = form.data('remote-success-redirect');
                redirect && (window.location = redirect);

                // refresh the form using pjax
                $.vain.pjax.refresh(function () {
                    var message = form.data('remote-success-message');
                    message && $.vain.notify.success(message);
                });
            },
            error: function()
            {
                // refresh the form using pjax
                $.vain.pjax.refresh(function () {
                    var message = form.data('remote-error-message');
                    message && $.vain.notify.error(message);
                });
            }
        });

        e.preventDefault();
    });

    // make sure u use delegation!
    $(document.body).on('click', 'input[data-confirm], button[data-confirm]', function(e) {
        var input = $(this);
        var form = input.closest('form');

        $.vain.confirm(input.data('confirm'), function (result) {
            if (result)
                form.submit();
        });

        e.preventDefault();
    });

    // may be used to serve automatically expanding textareas
    $(document.body).on('focus', 'textarea[data-expand]', function(e) {

        var textarea = $(this);
        var maxRows = textarea.data('expand-rows-max');
        // min-rows is optional - current rows are taken instead then
        var minRows = textarea.data('expand-rows-min') ? textarea.data('expand-rows-min') : textarea.attr('rows');
        textarea.data('expand-rows-min', minRows);

        textarea.attr('rows', maxRows);

        textarea.on('blur', function(e) {

            var self = $(this);

            if (self.val().length < 1)
                self.attr('rows', textarea.data('expand-rows-min'));
        });

        e.preventDefault();
    });

    /**
     * this actions will be triggered on every ().ready and ().vain.pjax.complete
     */
    var onLoad = function() {

        $('[data-editor]').each(function() {

            // set language if possible
            var lang = $(this).data('editor-lang');
            lang && (CKEDITOR.config.language = lang);

            // replace the editor
            var id = $(this).attr('id') ;
            id && CKEDITOR.replace(id);
        });

        $('[data-auto-active]').each(function() {

            var element = $(this);

            var cls = element.data('auto-active') || 'active';
            element.find(':first-child').first().addClass(cls);
        });

        $('[data-select]').selectpicker();

        $('[data-tags]').each(function() {

            var element = $(this);
            element.tagsinput({
                confirmKeys: [13, 32, 188],                  // 13 = enter, 32 = space, 188 = ,
                maxTags: element.data('tags-max'),
                trimValue: typeof element.data('tags-trim') !== 'undefined',
                allowDuplicates: typeof element.data('tags-allow-duplicates') !== 'undefined',
                maxChars: typeof element.data('tags-max-chars') !== 'undefined' ? element.data('tags-max-chars') : undefined,
                tagClass: typeof element.data('tags-class') !== 'undefined' ? element.data('tags-class') : undefined
            });
        });
    };

    $(function() {
        $(document).on('ready', onLoad);

        $.vain.pjax.options.complete = onLoad;
    });
})();

