'use strict';
const selectAll = document.querySelector('#selectAll'),
    checkboxList = document.querySelectorAll('[type="checkbox"]');
selectAll.addEventListener('change', t => {
    console.log('this')
    checkboxList.forEach(e => {
        e.checked = t.target.checked;
    });
});

// $(".select-row").click(function () {
//     $(this).closest('td').find('[type="checkbox"]').forEach(e => {
//         console.log('checked')
//         e.checked = t.target.checked;
//     });
// })
