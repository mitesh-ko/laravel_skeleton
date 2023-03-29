'use strict';
const toastAnimationDisplay = document.querySelector('.toast-ex');
if(toastAnimationDisplay) {
    let toastAnimation = new bootstrap.Toast(toastAnimationDisplay);
    toastAnimation.show();
}
