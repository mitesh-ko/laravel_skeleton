document.addEventListener("DOMContentLoaded",function(s){(function(){const e=document.querySelector("#formAuthentication");e&&FormValidation.formValidation(e,{fields:{name:{validators:{notEmpty:{message:"Please enter your full name."}}},email:{validators:{notEmpty:{message:"This field can not be empty."}}},password:{validators:{notEmpty:{message:"Please enter your password."}}},password_confirmation:{validators:{notEmpty:{message:"Please confirm password"},identical:{compare:function(){return e.querySelector('[name="password"]').value},message:"The password and its confirm are not the same"},stringLength:{min:6,message:"Password must be more than 6 characters"}}},terms:{validators:{notEmpty:{message:"Please agree terms & conditions"}}}},plugins:{trigger:new FormValidation.plugins.Trigger,bootstrap5:new FormValidation.plugins.Bootstrap5({eleValidClass:"",rowSelector:".mb-3"}),submitButton:new FormValidation.plugins.SubmitButton,defaultSubmit:new FormValidation.plugins.DefaultSubmit,autoFocus:new FormValidation.plugins.AutoFocus}});const t=document.querySelectorAll(".numeral-mask");t.length&&t.forEach(a=>{new Cleave(a,{numeral:!0})})})(),$(".twofa-code").keyup(function(){let e=$(this).val();isNaN(e)?$(this).val(e[0]):$(this).val(e[e.length-1]),$(this).val()===""&&$(this).next().val()===""?$(this).prev().trigger("focus"):$(this).next().val()===""&&$(this).next().trigger("focus")})});
