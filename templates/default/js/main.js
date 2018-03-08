$(document).on('click', '.js-delete-article', function (e) {
    if(confirm('Wirklich löschen?') === false){
        e.preventDefault();
    }
});

$(document).on('click', '.js-edit-article', function () {
    var article = $(this).data('articleId');

    $.ajax({
        type: 'POST',
        url: 'index.php?route=editArticle',
        dataType: 'json',
        data: {
            articleId: article
        },
        success: function (response){
            if (response.status === 'success'){
                $('.js-edit-article-container').html(response.view);
            }
        }
    })
});