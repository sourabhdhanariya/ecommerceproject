 
document.addEventListener("DOMContentLoaded", function () {
    var deleteLinks = document.querySelectorAll('.delete-link');
    
    deleteLinks.forEach(function (deleteLink) {
        deleteLink.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent the default link behavior

            // Get the product ID from the "data-id" attribute
            var id = deleteLink.getAttribute('data-id');

            // Show a SweetAlert confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then(function (result) {
                if (result.isConfirmed) {
                    // The user clicked "Yes, delete it!"
                    // Redirect to the delete endpoint or perform the delete operation
                    window.location.href = 'product_variant.php?id=' + id;
                }
            });
        });
    });
});