/**
 * Account Settings - Account
 */

'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        const formAccSettings = document.querySelector('#formAccountSettings'),
            deactivateAcc = document.querySelector('#formAccountDeactivation'),
            deactivateButton = deactivateAcc?.querySelector('.deactivate-account'),
            changePassword = document.querySelector('#formChangePassword');

        // Form validation for Add new record
        if (formAccSettings) {
            const fv = FormValidation.formValidation(formAccSettings, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter first name'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: '',
                        rowSelector: '.col-md-6'
                    }),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    autoFocus: new FormValidation.plugins.AutoFocus()
                }
            });
        }

        if(changePassword) {
            const fv = FormValidation.formValidation(changePassword, {
                fields: {
                    old_password: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter your current password.'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Enter a new password.'
                            }
                        }
                    },
                    password_confirmation: {
                        validators: {
                            notEmpty: {
                                message: 'Repeat new password same here.'
                            },
                            identical: {
                                compare: function () {
                                    return changePassword.querySelector('[name="password_confirmation"]').value;
                                },
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    autoFocus: new FormValidation.plugins.AutoFocus(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: '',
                        rowSelector: '.mb-3'
                    })
                }
            });
        }

        if (deactivateAcc) {
            const fv = FormValidation.formValidation(deactivateAcc, {
                fields: {
                    accountActivation: {
                        validators: {
                            notEmpty: {
                                message: 'Please confirm you want to delete account'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter Password'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: '',
                        rowSelector: '.col-md-6'
                    }),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    fieldStatus: new FormValidation.plugins.FieldStatus({
                        onStatusChanged: function (areFieldsValid) {
                            areFieldsValid
                                ? // Enable the submit button
                                  // so user has a chance to submit the form again
                                deactivateButton.removeAttribute('disabled')
                                : // Disable the submit button
                                deactivateButton.setAttribute('disabled', 'disabled');
                        }
                    }),
                    // Submit the form when all fields are valid
                    // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                    autoFocus: new FormValidation.plugins.AutoFocus()
                }
            });
        }

        // Deactivate account alert
        const accountDeactivation = document.querySelector('#accountActivation');

        // Alert With Functional Confirm Button
        if (deactivateButton) {
            deactivateButton.onclick = function () {
                if (accountDeactivation.checked === true) {
                    Swal.fire({
                        text: 'Are you sure you would like to deactivate your account?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        customClass: {
                            confirmButton: 'btn btn-primary me-2',
                            cancelButton: 'btn btn-label-secondary'
                        },
                        buttonsStyling: false
                    }).then(function (result) {
                        if (result.value) {
                            $("#formAccountDeactivation").submit()
                        }
                    });
                }
            };
        }

        // Update/reset user image of account page
        let accountUserImage = document.getElementById('uploadedAvatar');
        const fileInput = document.querySelector('.account-file-input'),
            resetFileInput = document.querySelector('.account-image-reset');

        if (accountUserImage) {
            const resetImage = accountUserImage.src;
            fileInput.onchange = () => {
                if (fileInput.files[0]) {
                    accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
                }
            };
            resetFileInput.onclick = () => {
                fileInput.value = '';
                accountUserImage.src = resetImage;
            };
        }
    })();
});
