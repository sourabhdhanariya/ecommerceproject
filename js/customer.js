document.querySelectorAll('.view-btn').forEach(button => {
    button.addEventListener('click', event => {
        const categoryId = button.getAttribute('data-category-id');
        const categoryName = button.getAttribute('data-category-name');
        const customeremail = button.getAttribute('data-customer-email');
        const customermobile = button.getAttribute('data-customer-mobile');
        const customerbilling = button.getAttribute('data-customer-billing');
        const categoryshiping = button.getAttribute('data-customer-shipping');

        // Set the Category ID and make it visible
        const categoryIdPlaceholder = document.getElementById('category-id-placeholder');
        categoryIdPlaceholder.textContent = categoryId;
        categoryIdPlaceholder.style.display = 'inline'; // Make it visible

        document.getElementById('categoryname').textContent = categoryName;
        document.getElementById('customer_email').textContent = customeremail;
        document.getElementById('category_mobile').textContent = customermobile;
        document.getElementById('customer_billing').textContent = customerbilling;
        document.getElementById('customer_shiping').textContent = categoryshiping;

    });
});

$('#exampleModal').on('show.bs.modal', event => {
    var button = $(event.relatedTarget);
    var modal = $(this);
    
});

const checkboxes = document.querySelectorAll('.status-toggle');
checkboxes.forEach(checkbox => {
checkbox.addEventListener('change', function() {
    const form = this.closest('form');
    const categoryId = form.querySelector('input[name="id"]').value;
    const newStatus = this.checked ? 'Active' : 'Deactivate';

    form.querySelector('input[name="active"]').value = newStatus;
    setTimeout(() => {
        const status = newStatus === 'Active' ? 1 : 0;
        
        if (status === 1) {
            toastr.success('Status updated to Active', 'Status:');
        } else {
            toastr.error('Status updated to Deactivate', 'Status:');
        }
    }, 1000); 
});
});

