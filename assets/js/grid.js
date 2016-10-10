/*
 * Javascript for GridvView update and delete buttons (PJAX enabled)
 */

$('document').ready(function () {
    $('.set-default-language-button').on('click', function (e) {
        var updateUrl = $(this).attr('url');
        var pjaxContainer = "#" + $(this).attr('data-pjax');

        $.ajax({
            type: 'post',
            url: updateUrl
        }).done(function (data) {
            $.pjax.reload({container: '#' + $.trim(pjaxContainer)});

        });
    }
    );


    $('.enable-language-button').on('click', function (e) {
        var updateUrl = $(this).attr('url');
        var pjaxContainer = "#" + $(this).attr('data-pjax');

        alert(updateUrl);
        $.ajax({
            type: 'post',
            url: updateUrl
        }).done(function (data) {
            alert(pjaxContainer);
            $.pjax.reload({container: pjaxContainer});
        });
    }
    );

    $('.disable-language-button').on('click', function (e) {
        var updateUrl = $(this).attr('url');
        var pjaxContainer = "#" + $(this).attr('data-pjax');

        alert(updateUrl);
        $.ajax({
            type: 'post',
            url: updateUrl
        }).done(function (data) {
            alert('baby:');

            $.pjax.reload({container: pjaxContainer});
        });
    }
    );


}
);