$('.infile-label').on('click', function () {
    $(this).nextAll().eq(1).show();
    $($(this).nextAll().eq(1)).on('change', function () {
        var filename = $(this).val();
        if (filename.substring(3, 11) == 'fakepath') {
            if (filename.length > 30) {
                filename = filename.substring(12, 30) + '...';
            } else {
                filename = filename.substring(12, 30);
            }
        }
        $(this).prev().html(filename);
    });
});