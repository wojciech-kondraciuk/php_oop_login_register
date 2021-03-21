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

//opne modal
const queryString = window.location.search.replace(/[0-9?=]/g, '');

if (queryString == "edit" || queryString == "add") {
    $('#exampleModal').modal('show');
}

//search form
let inputSearch = document.querySelector('#search');

function searchTask() {
    let filter = inputSearch.value.toUpperCase();
    let item = document.querySelectorAll('.item');
    for (let i = 0; i < item.length; i++) {
        let results = item[i];
        if (results) {
            let txtValue = results.textContent || results.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                item[i].style.display = 'table-row';
            } else {
                item[i].style.display = 'none';
            }
        }
    }
}


inputSearch.addEventListener('input', searchTask);

