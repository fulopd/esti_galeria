$(document).ready(function () {
    $(document).on('keyup', '.desc', function () {
        console.log("Leütések száma: " + this.value.length);
        let str = this.value;
        let max = 10;
        let x = this.value.length;
        let leutesek = document.getElementById("leutesek");

        if (max - x < 0) {
            str = str.slice(0, -1);
            this.value = str;
            x = this.value.length;

        }
        leutesek.innerHTML = max - x;

    });
    $(document).on('click', '.reszletek', function () {
        let az = $(this).data('azonosito');
        // let az = $(this).attr('data-azonosito');
        //console.log(az);
        window.location = 'details.php?kep=' + az;
    });
//   $('textarea').keyup(function(){
//       console.log(this.value);
//   })
    $('.cim').blur(function () {
        let str = $(this).text();
        let id = $(this).data('id');
        console.log(id);
        $.post('modifydetails.php', {id: id, cim: str}, function (adat, status) {

            
        })

    })



});

