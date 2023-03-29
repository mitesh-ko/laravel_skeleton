'use strict';
const selectAll = document.querySelector('#selectAll'),
    checkboxList = document.querySelectorAll('[type="checkbox"]');
selectAll.addEventListener('change', t => {
    checkboxList.forEach(e => {
        e.checked = t.target.checked;
    });
});
let permissioCheckbox = $('.permission-checkbox');
if ($('.permission-checkbox:checked').length === permissioCheckbox.length) {
    $("#selectAll").prop('checked', 'true')
}
$('.row-permission-checkbox').each(function(i, obj) {
    if($(this).find('.permission-checkbox:checked').length ===  $(this).find('.permission-checkbox').length) {
        $(this).find('.select-row').prop('checked', 'true')
    }
});

permissioCheckbox.click(function () {
    if ($('.permission-checkbox:checked').length === permissioCheckbox.length) {
        $("#selectAll").prop('checked', true)
    } else {
        $("#selectAll").prop('checked', false)
    }
    let closestGroup = $(this).closest('.row-permission-checkbox');
    if(closestGroup.find('.permission-checkbox:checked').length === closestGroup.find('.permission-checkbox').length) {
        closestGroup.find('.select-row').prop('checked', true)
    } else {
        closestGroup.find('.select-row').prop('checked', false)
    }
})

$(".select-row").click(function () {
    $(this).closest('td').find('[type="checkbox"]').prop('checked', this.checked)
})

const roleCreateUpdate = document.querySelector('#roleCreateUpdate');
if (roleCreateUpdate) {
    const fv = FormValidation.formValidation(roleCreateUpdate, {
        fields: {
            role_name: {
                validators: {
                    notEmpty: {
                        message: 'Please enter role name.'
                    }
                }
            }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: '',
                rowSelector: '.form-input'
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
            autoFocus: new FormValidation.plugins.AutoFocus()
        }
    });
}
