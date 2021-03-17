//form valid
(function () {
    'use strict'
    let forms = document.querySelectorAll('.needs-validation')
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()

//active menu

const url = window.location.href;
const page = url.substr(url.lastIndexOf('/') + 1);
const path = page ? page : '/';

if (path == '/') {
    $("ul li a[href='/']").addClass('active');
}

$("ul li a[href*=" + path + "]").addClass('active');