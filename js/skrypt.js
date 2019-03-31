
    function form(){
        var lokalizacja = document.getElementById("form").elements.namedItem("kino").value;
        var data = document.getElementById("form").elements.namedItem("data").value;
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("zamiana").innerHTML = this.responseText;
            }};
        if(data=="")
            {
                var Today = new Date()  

                var data = Today.getFullYear()+"-"+Today.getMonth()+1+"-"+Today.getDate();
                //alert(zm2);
            }
        zm="lokalizacja="+lokalizacja+"&data="+data;
        xmlhttp.open("POST", "kina2.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(zm);

  }
function form2(id, mm){
      var ulgowe = document.getElementById("ulgowe"+id).value;
      var normalny = document.getElementById("normalne"+id).value;
      var suma = parseInt(ulgowe) + parseInt(normalny);
        if(suma>mm){
            var ile = mm-parseInt(ulgowe)-parseInt(normalny);
            alert("Możesz zarezerwować: "+mm);
        }
        else{
        if(ulgowe=='')
            {
                parseInt(ulgowe)=0;
            }
        if(normalny=='')
            {
                parseInt(normalny)=0;
            }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("zamiana").innerHTML = this.responseText;
            }};
        
        zm="id_zdarzenia="+id+"&ulgowe="+ulgowe+"&normalny="+normalny;
        
        xmlhttp.open("POST", "kina3.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(zm);
            }
}

