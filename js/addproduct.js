
        (function ($) {
            $(document).ready(function () {
                var slickSlider = $('.slider').slick({
                    dots: true,
                    arrows: false,
                    customPaging: function (slick, index) {
                        var slideContent = slick.$slides.eq(index).html();
                        var customIndicator = '<div class="carousel-image m-auto">' + slideContent + '</div>';
                        return customIndicator;
                    }
                });

                function addNewMedia(mediaSrc, isVideo) {
                    var newSlide;
                    if (isVideo) {
                        newSlide = $('<div><video  autoplay="autoplay" loop  ><source src="' + mediaSrc + '" type="video/mp4"></video></div>');
                    } else {
                        newSlide = $('<div><img src="' + mediaSrc + '" alt="Media"></div>');
                    }
                    slickSlider.slick('slickAdd', newSlide);
                }

                $('#media-upload').on('change', function () {
                    var input = this;
                    if (input.files && input.files.length > 0) {
                        for (var i = 0; i < input.files.length; i++) {
                            var reader = new FileReader();
                            reader.onload = function (e) {
                                // Check if the file is an image (JPEG, PNG, GIF, etc.)
                                var isImage = e.target.result.match(/^data:image\//) !== null;
                                addNewMedia(e.target.result, !isImage);
                            };
                            reader.readAsDataURL(input.files[i]);
                        }
                    }
                });
            });
        })(jQuery);
        function readMedia(input) {
        if (input.files && input.files.length > 0) {
            for (var i = 0; i < input.files.length; i++) {
                (function(index) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var mediaItem = document.createElement('div');
                        mediaItem.className = 'media-item img-thumbnail';

                        var mediaElement;
                        if (input.files[index].type.startsWith('image')) {
                            mediaElement = document.createElement('img');
                            mediaElement.src = e.target.result;
                        } else if (input.files[index].type.startsWith('video')) {
                            mediaElement = document.createElement('video');
                            mediaElement.src = e.target.result;
                            mediaElement.controls = true;
                        } else {
                            return;
                        }

                        var closeButton = document.createElement('div');
                        closeButton.innerHTML = '&times;';
                        closeButton.className = 'close-button';

                        closeButton.addEventListener('click', function() {
                            mediaItem.parentElement.removeChild(mediaItem);
                        });

                        mediaItem.appendChild(mediaElement);
                        mediaItem.appendChild(closeButton);

                        document.getElementById('media-container').appendChild(mediaItem);
                    };
                    reader.readAsDataURL(input.files[index]);
                })(i);
            }
        }
    }

    $("#media-upload").change(function () {
        readMedia(this);
    });

    CKEDITOR.replace('editor', {
  skin: 'moono',
  enterMode: CKEDITOR.ENTER_BR,
  shiftEnterMode:CKEDITOR.ENTER_P,
  toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },
             { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
             { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },
             { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
             { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
             { name: 'links', items: [ 'Link', 'Unlink' ] },
             { name: 'insert', items: [ 'Image'] },
             { name: 'spell', items: [ 'jQuerySpellChecker' ] },
             { name: 'table', items: [ 'Table' ] }
             ],
});

  
$(document).ready(function() {
            $("#previewButton").click(function() {
                // Get values from form inputs
                var product = $("#productname").val(); // Replace with actual input ID
                var productPrice = $("#productPrice").val(); // Replace with actual input ID
                var productEditor = $("#editor").val();
                var categoryId = $("#categoryId").val();
                var subCategoryId = $("#subCategoryId").val();
               
                var media_upload = $("#media-upload").val(); // Replace with actual input ID
                
                
                // Update preview elements in the modal
                $("#previewEmail").text(product);
                $("#previewProduct").text(productPrice);
                $("#previewEditor").text(productEditor);
                $("#previewCategoryId").text(categoryId);
                $("#previewsubCategoryId").text(subCategoryId);
                $("#media_upload").text(media_upload);
                
                //add
        $(".previewImagesModelBox").empty();

$("#media-container div.media-item").each(function () {
    var clonedImage = $(this).clone();
    clonedImage.removeClass("img-thumbnail");
    $(".previewImagesModelBox").append(clonedImage);
});
                // Show the modal
                // Add code here to display your modal
            });
        });

        $(document).ready(function() {
            $("#previewButton").click(function() {
                // Get values from the CKEditor instance
                var productEditor = CKEDITOR.instances.editor.getData();
                
                // Update preview elements in the modal
                $("#previewEditor").html(productEditor);

                // Show the modal
                $("#previewModal").modal('show');
            });
        });
  (function ($) {
    $(function () {
      $('.slider').slick({
        dots: true,
        arrows: false, // Set arrows to false to remove the navigation buttons
        customPaging: function (slick, index) {
          var slide = slick.$slides.eq(index);
          var targetImageSrc = slide.find('img').attr('src');
          var targetDiv = slide.find('div').attr('class');
          
          // Check if the src attribute of the img element is defined and not empty
          if (targetImageSrc && targetImageSrc.trim() !== '') {
            // Include the img element in the custom indicator
            var customIndicator = '<img src="' + targetImageSrc + '"/>';
          } else {
            // No valid src attribute, use only the div element
            var customIndicator = '<div class="' + targetDiv + '"/>';
          }
          
          return customIndicator;
        }
      });
    });
  })
  
//   (jQuery);
//   jQuery(document).ready(function () {
//     jQuery('#datepicker').datepicker({
//       dateFormat: 'mm-dd-yy',
//       minDate: 0
//     });
//   });
      

$(document).ready(function() {
    $.validator.addMethod("lessThanOrEqualToPrice", function(value, element) {
        var productPrice = parseFloat($("#productPrice").val());
        var productdiscount = parseFloat(value);
        return productdiscount >= 0 && productdiscount <= productPrice;
    }, "Discounted price must be less than or equal to the price");

    
    $.validator.addMethod("ckeditorNotEmpty", function() {
        return CKEDITOR.instances.editor.getData().trim() !== '';
      }, "Please enter some text in the editor.");
       
    $('#categoryForm').validate({
        rules: {
            productname: {
                required: true
            },
            productPrice: {
                required: true,
                number: true,
                min: 0
            },
            productdiscount: {
                required: true,
                number: true,
                min: 0,
                lessThanOrEqualToPrice: true
            },    
            qtyProduct: {
                required: true,
                number: true,
                min: 0
            },
            skuProduct:{
                required:true
            },
            productDes: {
                required: true,
                ckeditorNotEmpty: true,     }
        },
        
        
        messages: {
            productname: {
                required: "Name field cannot be blank"
            },
            productPrice: {
                required: "Please enter the price.",
                number: "Please enter a valid number.",
                min: "Price cannot be negative."
            },
            productdiscount: {
                required: "Please enter a valid discount price.",
                number: "Please enter a valid number.",
                min: "Discounted price cannot be negative."
            },
            qtyProduct:{
                required: "Quantity field cannot be blank."
            },
            skuProduct:{
                required: "Sku field cannot be blank."
            },
            productDes:{
                required:"please enter des",
                number: "Please enter a valid number.",
            },

            
            
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});


$('#categoryFormUpdate').validate({
    rules: {
        product_title: {
            required: true
        },
        productPrice: {
            required: true,
            number: true,
            min: 0
        },
        productdiscount: {
            required: true,
            number: true,
            min: 0,
            lessThanOrEqualToPrice: true
        },    
        qtyProduct: {
            required: true,
            number: true,
            min: 0
        },
        skuProduct:{
            required:true
        },
        productDes: {
            required: true,
            ckeditorNotEmpty: true,     }
    },
    
    
    messages: {
        product_title: {
            required: "Name field cannot be blank"
        },
        productPrice: {
            required: "Please enter the price.",
            number: "Please enter a valid number.",
            min: "Price cannot be negative."
        },
        productdiscount: {
            required: "Please enter a valid discount price.",
            number: "Please enter a valid number.",
            min: "Discounted price cannot be negative."
        },
        qtyProduct:{
            required: "Quantity field cannot be blank."
        },
        skuProduct:{
            required: "Sku field cannot be blank."
        },
        productDes:{
            required:"please enter des",
            number: "Please enter a valid number.",
        },

        
        
    },
    submitHandler: function(form) {
        form.submit();
    }
});
jQuery(document).ready(function() {
  jQuery('#datepicker').datepicker({
    dateFormat: 'yy-mm-dd',
    minDate: 0
  });
});
$(document).ready(function() {
$.ajax({
url: 'Classes/get_categories.php',
method: 'GET',
dataType: 'json',
success: function(data) {
$('#categoryComboTree').comboTree({
    source: data,
    isMultiple: false,
    cascadeSelect: false,
    collapse: true,
    selectName: 'title',
    selectValue: 'id',
});

// Add an event listener to handle changes in the comboTree selection
$('#categoryComboTree').on('combotree:change', function(event, values) {
    // Get the selected category ID
    var selectedCategoryID = values[0];

    // Update the hidden input field's value with the selected category ID
    $('#selectedCategoryId').val(selectedCategoryID);
});
},
error: function(xhr, status, error) {
console.error(error);
}
});
});

$(document).ready(function() {
var max_fields = 10; // maximum input boxes allowed
var wrapper = $(".input_fields_wrap"); // Fields wrapper
var add_button = $(".extra-fields-customer"); // Add button ID
var x = 1; // initial text box count

$(add_button).click(function(e) {
e.preventDefault();
if (x < max_fields) {
    x++;

    var fieldHtml = `
        <div>
            <div class="form-row ms-5">
                <div class="form-group col-md-3">
                    <select class="form-control" name="variate_name[${x}]" id="variate_name_${x}">
                        <option>Color</option>
                        <option>Size</option>
                    </select>
                </div>
                <div class="col-md-8">
                <input type="checkbox"  class="enable-disable ms-5" name="mycheckbox[${x}]"/>
                <input type="text" class="h-75"  name="mytext[${x}]" disabled/>
                <input type="text" class="ms-5 h-75" placeholder="Please Enter Quality" name="mydate[${x}]" disabled/>
            </div>
          
<a name="" id="" class="btn btn-danger remove_field" style="height:36px;" href="#" role="button">X</a>
            </div>
        </div>
    `;

    $(wrapper).append(fieldHtml);
}
});

$(wrapper).on("click", ".remove_field", function(e) {
e.preventDefault();
$(this).closest('div').remove();
x--;
});

// Add event listener for checkbox elements in dynamically added fields
wrapper.on("change", ".enable-disable", function() {
var textInputs = $(this).siblings("input[type='text']");
textInputs.prop("disabled", !this.checked);
});
});
function updateVariate() {
var selectElement = document.getElementById("parent_category_id");
var inputElement = document.getElementById("enter_variate");

// Get the selected option's value
var selectedValue = selectElement.value;

// Get the attribute name associated with the selected value
var attributeName = getAttributeName(selectedValue);

// Set the value of the "Enter Variate" input field to the attribute name
inputElement.value = attributeName;
}
