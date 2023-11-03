var statusSelect = document.getElementById("statusSelect");
var selectedOption = statusSelect.options[statusSelect.selectedIndex];
var color = "";

switch (selectedOption.value) {
  case "0":
    color = "black";
    statusSelect.style.backgroundColor = "yellow"; 
    break;
  case "1":
    color = "white";
    statusSelect.style.backgroundColor = "green"; 
    break;
  case "2":
    color = "white";
    statusSelect.style.backgroundColor = "SkyBlue";
    break;
  default:
    color = "initial"; 
    statusSelect.style.backgroundColor = "initial";
}

statusSelect.style.color = color; 
function filterByTime(select) {
    var selectedTime = select.value;

    var currentUrl = window.location.href;
    var url = new URL(currentUrl);
    url.searchParams.set("time", selectedTime);
    
    window.location.href = url.toString();
}