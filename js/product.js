//  category filter
document.addEventListener("DOMContentLoaded", function() {
  const categoryFilter = document.getElementById("categoryFilter");

  categoryFilter.addEventListener("change", function() {
      const selectedCategoryId = categoryFilter.value;

      window.location.href = 'product.php?category_id=' + selectedCategoryId;
  });
});


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
                    window.location.href = 'product.php?id=' + id;
                }
            });
        });
    });
});
// Add event listener to toggle status for buttons
const statusButtons = document.querySelectorAll('.status-toggle');
statusButtons.forEach(button => {
    button.addEventListener('click', function() {
        const categoryId = this.getAttribute('data-categoryid');
        let currentStatus = this.getAttribute('data-status');

        // Toggle the status
        const newStatus = (currentStatus === 'Active') ? 'Deactive' : 'Active';

        // Update the button text and data-status attribute
        this.setAttribute('data-status', newStatus);
        this.innerHTML = newStatus;

        // Update the hidden input value
        const activeInput = this.closest('form').querySelector('input[name="active"]');
        activeInput.value = newStatus;

        // Manually submit the form
        this.closest('form').submit();
    });
});


// Add event listener to toggle status for checkboxes
const checkboxes = document.querySelectorAll('.form-check-input');
checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        // Toggle the status
        const currentStatus = this.checked ? 'Active' : 'Deactive';

        // Update the hidden input value
        const activeInput = this.closest('form').querySelector('input[name="active"]');
        activeInput.value = currentStatus;

        // Manually submit the form
        this.closest('form').submit();
    });
});

  (function ($) {
    $(function () {
      $('.slider').slick({
        dots: true,
        arrows: false, // Set arrows to false to remove the navigation buttons
        customPaging: function (slick, index) {
          var slide = slick.$slides.eq(index);
          var slideContent = slide.html(); // Get the HTML content of the slide

          // Create a custom indicator using the slide's content
          var customIndicator = '<div class="custom-slide-indicator">' + slideContent + '</div>';

          return customIndicator;
        }
      });
    });
  })(jQuery);

      function changeStatusColor(element) {
  if (element.classList.contains('text-primary')) {
    element.classList.remove('text-primary');
    element.classList.add('text-danger');
    element.textContent = 'Deactivated';
  } else {
    element.classList.remove('text-danger');
    element.classList.add('text-primary');
    element.textContent = 'Activated';
  }
}
