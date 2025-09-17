{{-- resources/views/components/spinner.blade.php --}}

<div id="loading-spinner"
     class="d-none position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-25 d-flex align-items-center justify-content-center"
     style="z-index:1050;">
  <div class="text-center">
    <div class="spinner-border text-success" role="status" aria-hidden="true"></div>
    <div class="mt-2 fw-semibold text-success">Cargando...</div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const spinner = document.getElementById("loading-spinner");

  // Spinner en enlaces y botones
  document.querySelectorAll("a.show-spinner, button.show-spinner").forEach(el => {
    el.addEventListener("click", function () {
      if (spinner) spinner.classList.remove("d-none");
    });
  });

  // Spinner al enviar formularios
  document.querySelectorAll("form").forEach(form => {
    form.addEventListener("submit", function () {
      if (spinner) spinner.classList.remove("d-none");
    });
  });

  // Spinner en selects con cambio automático
  document.querySelectorAll("select.show-spinner-onchange").forEach(sel => {
    sel.addEventListener("change", function () {
      if (spinner) spinner.classList.remove("d-none");
      sel.form.submit();
    });
  });
});
</script>