function updateStatus(orderId, newStatus)
{
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("order" + orderId).style.display = "none";
        }
    }
    xhttp.open("POST", "../../Controller/UpdateStatus.php", true);
    xhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhttp.send("order_id=" + orderId + "&status=" + newStatus);
}