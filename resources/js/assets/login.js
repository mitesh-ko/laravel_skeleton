/**
 *  Pages Authentication
 */

'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        const formAuthentication = document.querySelector('#formAuthentication');

        if (formAuthentication) {
            const fv = FormValidation.formValidation(formAuthentication, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter your full name.'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'This field can not be empty.'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter your password.'
                            }
                        }
                    },
                    password_confirmation: {
                        validators: {
                            notEmpty: {
                                message: 'Please confirm password'
                            },
                            identical: {
                                compare: function () {
                                    return formAuthentication.querySelector('[name="password"]').value;
                                },
                                message: 'The password and its confirm are not the same'
                            },
                            stringLength: {
                                min: 6,
                                message: 'Password must be more than 6 characters'
                            }
                        }
                    },
                    terms: {
                        validators: {
                            notEmpty: {
                                message: 'Please agree terms & conditions'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: '',
                        rowSelector: '.mb-3'
                    }),
                    submitButton: new FormValidation.plugins.SubmitButton(),

                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    autoFocus: new FormValidation.plugins.AutoFocus()
                }
            });
        }

        //  Two Steps Verification
        const numeralMask = document.querySelectorAll('.numeral-mask');

        // Verification masking
        if (numeralMask.length) {
            numeralMask.forEach(e => {
                new Cleave(e, {
                    numeral: true
                });
            });
        }
    })();

    $(".twofa-code").keyup(function () {
        let lastNumber = $(this).val();
        if (isNaN(lastNumber)) {
            $(this).val(lastNumber[0]);
        } else {
            $(this).val(lastNumber[lastNumber.length - 1])
        }
        if ($(this).val() === '' && $(this).next().val() === '')
            $(this).prev().trigger('focus')
        else if ($(this).next().val() === '')
            $(this).next().trigger('focus')
    });

    $(".cursor-pointer").click(function () {
        if ($(this).closest('.input-group').find('input').attr('type') === 'password') {
            $(this).html("<i class=\"ti ti-eye-off\"></i>");
            $(this).closest('.input-group').find('input').attr('type', 'text');
        } else {
            $(this).html("<i class=\"ti ti-eye\"></i>");
            $(this).closest('.input-group').find('input').attr('type', 'password');
        }

    })
});
