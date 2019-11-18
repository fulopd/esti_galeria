$(document).ready(function(){
    $('[name="continent"]').change(function(){
        let url = "index.php?continent="+$(this).val();
        location.replace(url);
    });
    
    
})

