


function updateBackgroundColor() {
    const select = document.getElementById('statusSelect');
    const selectedOption = select.options[select.selectedIndex];
  
    // Reset previous styles
    select.style.backgroundColor = '';
    select.style.color = '';
  
    // Update background color and text color based on the selected option's value
    if (selectedOption.value === '0') {
      select.style.backgroundColor = 'red';
      select.style.color = 'white';
    } else if (selectedOption.value === '1') {
      select.style.backgroundColor = 'green';
      select.style.color = 'white';
    } else if (selectedOption.value === '2') {
      select.style.backgroundColor = 'yellow';
      select.style.color = 'black';
    }
  }


  
  
  const selectElement = document.getElementById('statusSelect');
  selectElement.addEventListener('change', updateBackgroundColor);
  
  updateBackgroundColor();
  
const statusLabels = {
  '0': 'Pending',
  '1': 'Completed',
  '2': 'Cancelled'
};

document.querySelectorAll('.view-btn').forEach(button => {
  button.addEventListener('click', event => {
      const categoryId = button.getAttribute('data-product-id');
      const productName = button.getAttribute('data-product-name');
      const productPrice = button.getAttribute('data-price');
      const customerName = button.getAttribute('data-customerName');
      const customerOrderDate = button.getAttribute('data-customer-order');
      const customerquantity = button.getAttribute('data-quantity');
      const customerBiilingAddress = button.getAttribute('data-biilingAddress');
      const ShipingAddress = button.getAttribute('data-shipingAddress');
      const categoryCustomer = button.getAttribute('data-category');
      const image = button.getAttribute('data-image');
      const status = button.getAttribute('data-status');
      const orderid = button.getAttribute('data-order');
   
      
      const categoryIdPlaceholder = document.getElementById('category-id-placeholder');
      categoryIdPlaceholder.textContent = categoryId;
      categoryIdPlaceholder.style.display = 'inline'; 

      document.getElementById('productname').textContent = productName;
      document.getElementById('productprice').textContent = productPrice;
      document.getElementById('customername').textContent = customerName;
      document.getElementById('customerorderdate').textContent = customerOrderDate;
      document.getElementById('customerquantity').textContent = customerquantity;
      document.getElementById('customerbiilingaddress').textContent = customerBiilingAddress;
      document.getElementById('shipingaddress').textContent = ShipingAddress;
      document.getElementById('category').textContent = categoryCustomer;
      document.getElementById('status').textContent = statusLabels[status] || 'Unknown';
      document.getElementById('uid').textContent = orderid;
   

      
      document.getElementById('image').src = image;
  });
});

$('#exampleModal').on('show.bs.modal', event => {
    var button = $(event.relatedTarget);
    var modal = $(this);
    
});
