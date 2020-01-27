$(document).ready(function(){
   $(document).on('click','.reszletek',function(){
       let az = $(this).data('azonosito');
       // let az = $(this).attr('data-azonosito');
       //console.log(az);
       window.location='details.php?kep='+az;
   }); 
});

