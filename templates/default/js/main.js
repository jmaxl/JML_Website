$(document).on('click', '.js-delete-article', function (e) {
    if (confirm('Wirklich löschen?') === false) {
        e.preventDefault();
    }
});

$(document).on('click', '.js-delete-picture', function () {
    if (confirm('Wirklich löschen?') === true) {
        var $clickedElement = $(this),
            picture = $clickedElement.data('pictureId');

        $.ajax({
            type: 'POST',
            url: 'index.php?route=deletePicture',
            dataType: 'json',
            data: {
                pictureId: picture
            },
            success: function (response) {
                if (response.status === 'success') {
                    $clickedElement.closest('.js-delete-picture-container').remove();
                }
            }
        })
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
        success: function (response) {
            if (response.status === 'success') {
                $('.js-edit-article-container').html(response.view);
            }
        }
    })
});

$(document).on('click', '.js-create-author', function () {
    $('.js-create-author-container').removeClass('hidden');
});

$(document).on('change', '.js-create-author-form .js-user-id', function () {
    var $this = $(this);

    if ($this.val() !== '') {
        $('.js-create-author-form .js-firstname').val('');
        $('.js-create-author-form .js-name').val('');
    }
});

$(document).on('focusout', '.js-create-author-form .js-firstname, .js-create-author-form .js-name', function () {
    var $this = $(this);

    if ($this.val() !== '') {
        $('.js-create-author-form .js-user-id').val('');
    }
});

$(document).on('click', '.js-create-author-form .js-create-author', function (e) {
    e.preventDefault();
    var $authorForm = $('.js-create-author-form'),
        userId = $authorForm.find('.js-user-id').val(),
        firstname = $authorForm.find('.js-firstname').val(),
        name = $authorForm.find('.js-name').val();

    if ((userId === '' && firstname !== '' && name !== '') || (userId !== '' && firstname === '' && name === '')) {
        $.ajax({
            type: 'POST',
            url: 'index.php?route=createAuthor',
            dataType: 'json',
            data: {
                userId: userId,
                firstname: firstname,
                name: name
            },
            success: function (response) {
                if (response.status === 'success') {
                    $('.js-select-author').prepend('<option value="' + response.author.authorId.id +'">' + response.author.firstname.name + ' ' + response.author.name.name + '</option>');
                    $('.js-create-author-form .js-firstname').val('');
                    $('.js-create-author-form .js-name').val('');
                    $('.js-create-author-form .js-user-id').val('');
                    $('.js-create-author-container').addClass('hidden');

                }
            }
        });
    } else {
        $authorForm.find('.js-error').html('Autor ist unvollständig');
    }
});