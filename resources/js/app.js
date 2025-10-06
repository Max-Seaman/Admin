import './bootstrap';

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("tr[data-href]").forEach(row => {
        row.addEventListener("click", () => {
            window.location.href = row.dataset.href;
        });
    });

    // Prevent row click on delete button
    document.querySelectorAll("tr[data-href] form").forEach(form => {
        form.addEventListener("click", e => e.stopPropagation());
    });
});


// SweetAlert for delete confirmation
document.querySelectorAll('.deleteForm').forEach(form => {
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const name = form.dataset.name;
        Swal.fire({
            title: `Delete ${name}?`,
            text: "This action cannot be undone.",
            color: '#fff',
            icon: "warning",
            iconColor: '#02b19f',
            background: '#016d61',
            showCancelButton: true,
            confirmButtonColor: "#02b19f",
            cancelButtonColor: "#02b19f",
            confirmButtonText: "Confirm"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

//update file input label on file select
document.getElementById('logo').addEventListener('change', function() {
    const fileName = this.files[0]?.name || 'No file chosen';
    document.getElementById('file-name').textContent = fileName;
});