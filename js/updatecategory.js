

// $(document).ready(function() {
//   $('#categoryUpdateForm').validate({
//       rules: {
//         categoryName: {
//               required: true
//           }
//       },
//       messages: {
//         categoryName: {
//               required: "Name field can not be blank"
//           }
//       },
//       submitHandler: function(form) {
//           form.submit();
//       }
//   });
// });
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

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#img-upload-tag').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#img-upload").change(function () {
  readURL(this);
});
 