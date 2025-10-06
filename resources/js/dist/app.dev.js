"use strict";

require("./bootstrap");

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll("tr[data-href]").forEach(function (row) {
    row.addEventListener("click", function () {
      window.location.href = row.dataset.href;
    });
  }); // Prevent row click on delete button

  document.querySelectorAll("tr[data-href] form").forEach(function (form) {
    form.addEventListener("click", function (e) {
      return e.stopPropagation();
    });
  });
}); // SweetAlert for delete confirmation

document.querySelectorAll('.deleteForm').forEach(function (form) {
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var name = form.dataset.name;
    Swal.fire({
      title: "Delete ".concat(name, "?"),
      text: "This action cannot be undone.",
      color: '#fff',
      icon: "warning",
      iconColor: '#02b19f',
      background: '#016d61',
      showCancelButton: true,
      confirmButtonColor: "#02b19f",
      cancelButtonColor: "#02b19f",
      confirmButtonText: "Confirm"
    }).then(function (result) {
      if (result.isConfirmed) {
        form.submit();
      }
    });
  });
}); //update file input label on file select
//# sourceMappingURL=app.dev.js.map
