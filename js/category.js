
    document.querySelectorAll('.view-btn').forEach(button => {
        button.addEventListener('click', event => {
            const categoryId = button.getAttribute('data-category-id');
            const categoryName = button.getAttribute('data-category-name');
            const categoryDescription = button.getAttribute('data-category-description');
            const categoryImagePath = button.getAttribute('data-category-path');
            const categoryParent = button.getAttribute('data-category-parent');

            // Set the Category ID and make it visible
            const categoryIdPlaceholder = document.getElementById('category-id-placeholder');
            categoryIdPlaceholder.textContent = categoryId;
            categoryIdPlaceholder.style.display = 'inline'; // Make it visible

            document.getElementById('categoryname').textContent = categoryName;
            document.getElementById('category-description').textContent = categoryDescription;
            document.getElementById('category-image').src = categoryImagePath;
            document.getElementById('category-parent').textContent = categoryParent;
        });
    });
    // Add event listener to toggle status
    const statusButtons = document.querySelectorAll('.status-toggle');
    statusButtons.forEach(button => {
        button.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-categoryid');
            let currentStatus = this.getAttribute('data-status');

            // Toggle the status
            const newStatus = (currentStatus === 'Active') ? 'Inactive' : 'Active';

            // Update the button text and data-status attribute
            this.setAttribute('data-status', newStatus);
            this.innerHTML = newStatus;
            
            // Toggle the button color based on status
            this.classList.toggle('active-button', newStatus === 'Active');
            this.classList.toggle('inactive-button', newStatus === 'Inactive');

            // Update the hidden input value
            const activeInput = this.closest('form').querySelector('input[name="active"]');
            activeInput.value = newStatus;

            // Submit the form
            this.closest('form').submit();
        });
    });
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
