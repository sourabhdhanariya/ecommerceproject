const charts = document.querySelectorAll(".chart");

charts.forEach(function (chart) {
  var ctx = chart.getContext("2d");
  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
      datasets: [
        {
          label: "# of Votes",
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
});

$(document).ready(function () {
  $(".data-table").each(function (_, table) {
    $(table).DataTable();
  });
});

$(document).ready (function () {  
  $('#first_form').submit (function (e) {  
     e.preventDefault();  
     
     var first_name = $('#first_name').val();  
     var email = $('#email').val();  
   var number = $('#number').val();  
   var city =$('#city').val();
   var area =$('#area').val();
   var bed =$('#bed').val();
   var tel=$('#tel').val();
   $(".error").remove();  
 if (first_name.length < 1) {  
       $('#first_name').after('<span class="error">Please Enter Your Full Name</span>');  
     }  
     else {
      var regExname = /^[a-zA-Z -]*$/;
      var validname= regExname.test(first_name);
      if(!validname){
        $('#first_name').after('<span class="error">please enter 6 digit or only alphanumeric</span>');  
      }
     }

//  if (number.length < 1) {  
//        $('#number').after('<span class="error">This field is required</span>');  
//      }  
//      else {
//       var regExnumber = /^(0|91)?[6-9][0-9]{9}$/;
//       var validnumber= regExnumber.test(number);
//       if(!validnumber){
//         $('#number').after('<span class="error">please enter valid number</span>');  
//       }
//      }


 if (tel.length < 1) {  
       $('#tel').after('<span class="error">This field is required</span>');  
     }  
     else {
      var regExnumber = /^(0|91)?[6-9][0-9]{9}$/;
      var validnumber= regExnumber.test(tel);
      if(!validnumber){
        $('#tel').after('<span class="error">please enter valid number</span>');  
      }
     }
     if (email.length < 1) {  
      $('#email').after('<span class="error">This field is required</span>');  
    } else {  
      
      var regEx = /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/;  
      var validEmail = regEx.test(email);  
      if (!validEmail) {  
        $('#email').after('<span class="error">Enter a valid email</span>');  
      }  
    }      
     if (city.length < 1) {  
      $('#city').after('<span class="error">This field is required</span>');  
    }     else {
      

      var regExcity = /^([a-zA-Z\u0080-\u024F]+(?:. |-| |'))*[a-zA-Z\u0080-\u024F]*$/;  
      var validcity = regExcity.test(city);  
      if (!validcity) {  
        $('#city').after('<span class="error">Enter a valid city</span>');  
      }  

    }
      
    if (area.length < 1) {  
      $('#area').after('<span class="error">This field is required</span>');  
    }  else {
      
      var regExaddreass = /^[A-Za-z-0-99999999']/;  
      var validaddress = regExaddreass.test(area);  
      if (!validaddress) {  
        $('#area').after('<span class="error">Enter a valid address</span>');  
      }  

    }
    if (bed.length < 1) {  
      $('#bed').after('<span class="error">This field is required</span>');  
    }  
   });  
   
   
 });  

