var stepperForm

document.addEventListener('DOMContentLoaded', function() {

    var stepperFormEl = document.querySelector('#stepperForm')
    stepperForm = new Stepper(stepperFormEl, {
        animation: true
    })

    var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'))
    var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'))
    var form = stepperFormEl.querySelector('.bs-stepper-content form')

    btnNextList.forEach(function(btn) {
        btn.addEventListener('click', function() {
            stepperForm.next()
        })
    })

    stepperFormEl.addEventListener('show.bs-stepper', function(event) {
        form.classList.remove('was-validated')
        var nextStep = event.detail.indexStep
        var currentStep = nextStep

        if (currentStep > 0) {
            currentStep--
        }

        var stepperPan = stepperPanList[currentStep]
            //aca hacer las validaciones
        if ((stepperPan.getAttribute('id') === 'test-form-1' && !boleta.value.length) ||
            (stepperPan.getAttribute('id') === 'test-form-2' && !calleNumero.value.length)) {
            event.preventDefault()
            form.classList.add('was-validated')
        }
    })
})

function validarTodo() {
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                    console.log('si')
                } else {
                    console.log('lleno')
                }
                form.classList.add('was-validated')
            }, false)
        })
}