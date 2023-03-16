let emailTemplate = $("#formAccountSettings");
if(emailTemplate) {
    emailTemplate.submit(function () {
        $(".progress").css('opacity', '100%')
        $.ajax({
            url: emailTemplate.attr('action'),
            type: 'POST',
            data: emailTemplate.serialize(),
            success: function (response) {
                $('#mail-preview').attr("src", $('#mail-preview').attr("src"));
                $(".progress").css('opacity', '0')
            }
        })
    })
}

