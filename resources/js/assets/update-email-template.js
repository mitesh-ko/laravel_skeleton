'use strict';
const updateEmailTemplate = document.querySelector('#updateEmailTemplate');
if (updateEmailTemplate) {
    FormValidation.formValidation(updateEmailTemplate, {
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Please enter template name.'
                    }
                }
            },
            subject: {
                validators: {
                    notEmpty: {
                        message: 'Please enter subject.'
                    }
                }
            },
            'body[][Greeting]': {
                validators: {
                    notEmpty: {
                        message: 'Please enter mail greeting.'
                    }
                }
            },
            'body[][Line]': {
                validators: {
                    notEmpty: {
                        message: 'Please enter message line.'
                    }
                }
            },
            'body[][Action]': {
                validators: {
                    notEmpty: {
                        message: 'Please enter action button text.'
                    }
                }
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: '',
                rowSelector: '.form-input',
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus()
        }
    }).on('core.form.valid', function () {
        let emailTemplate = $("#updateEmailTemplate")
        $(".progress").css('opacity', '100%')
        $.ajax({
            url: emailTemplate.attr('action'),
            type: 'POST',
            data: emailTemplate.serialize(),
            success: function (response) {
                $('#mail-preview').attr("src", $('#mail-preview').attr("src"));
                $(".progress").css('opacity', '0')
            },
            error: function (response) {
                $('#mail-preview').attr("src", $('#mail-preview').attr("src"));
                $(".progress").css('opacity', '0')
            }
        })
    });
}

