$(document).ready(function(){    
    $(document).on('keyup','.proba',function(){
       console.log("Leütések száma: "+this.value.length); 
       let x = this.value.length;
       let leutesek = document.getElementById("leutesek");
       leutesek.innerHTML = 1000-x;
    });  
    $(document).on('click','.reszletek',function(){
       let az = $(this).data('azonosito');
       console.log(az);
       window.location = 'details.php?kep=' + az;
    });   
});
 
