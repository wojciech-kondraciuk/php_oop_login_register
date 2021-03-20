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


const queryString = window.location.search.replace(/[0-9?=]/g, '');

if (queryString == "edit" || queryString == "add") {
    $('#exampleModal').modal('show');
}
