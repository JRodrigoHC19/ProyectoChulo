import './bootstrap';
import * as bootstrap from 'bootstrap';

import * as Swal from 'sweetalert2';

window.Swal = Swal;

// cuando la página es refrescada -> nos reubica en la misma posición
window.addEventListener('beforeunload', function() {
  sessionStorage.setItem('scrollPosition', window.pageYOffset);
});
window.addEventListener('load', function() {
  var scrollPosition = sessionStorage.getItem('scrollPosition');
  window.scrollTo(0, scrollPosition);
});


// al dezlizar nos muestra una sobrita generada por el cambio de posición
window.addEventListener('scroll', function() {
    var elemento = document.getElementById('dezliz-sombra');
    var scrollPosition = window.scrollY || window.pageYOffset;
    
    if (scrollPosition > 0) {
      elemento.classList.add('shadow-sm');
    } else {
      elemento.classList.remove('shadow-sm');
    }
  });

  

document.getElementById('autoButton').addEventListener('click', function() {
  
  Swal.fire({
    title: '<strong>HTML <u>example</u></strong>',
    icon: 'info',
    html:
      'You can use <b>bold text</b>, ' +
      '<a href="//sweetalert2.github.io">links</a> ' +
      'and other HTML tags',
    showCloseButton: true,
    showCancelButton: true,
    focusConfirm: false,
    confirmButtonText:
      '<i class="fa fa-thumbs-up"></i> Great!',
    confirmButtonAriaLabel: 'Thumbs up, great!',
    cancelButtonText:
      '<i class="fa fa-thumbs-down">Not</i>',
    cancelButtonAriaLabel: 'Thumbs down'
  })


});



const exampleModal = document.getElementById('exampleModal')
if (exampleModal) {
  exampleModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an Ajax request here
    // and then do the updating in a callback.

    // Update the modal's content.
    const modalTitle = exampleModal.querySelector('.modal-title')
    const modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalTitle.textContent = `New message to ${recipient}`
    modalBodyInput.value = recipient
  })
}


