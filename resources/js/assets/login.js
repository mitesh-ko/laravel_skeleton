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
});
