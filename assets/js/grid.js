/*
 * Javascript for GridvView update and delete buttons (PJAX enabled)
 */

$('document').ready(function () {

    $('.set-default-language-button').on('click', function (e) {
        var updateUrl = $(this).attr('url');
        var pjaxContainer = "#" + $(this).attr('data-pjax');
        alert(updateUrl + "::" + pjaxContainer)
        $.ajax({
            type: 'post',
            url: updateUrl
        }).done(function (data) {
            $.pjax.reload({container: '#language-grid'});
        });
    }
    );

    $('.disable-language-button').on('click', function (e) {
        var deleteeUrl = $(this).attr('url');
        var pjaxContainer = "#" + $(this).attr('data-pjax');
        alert(deleteUrl + "::" + pjaxContainer)
        $.ajax({
            type: 'post',
            url: deleteUrl
        }).done(function (data) {
            $.pjax.reload({container: '#language-grid'});
        });
    }
    );
}
);