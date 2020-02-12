$(document).ready(function () {
    $(document).on('click', '.reszletek', function () {
        let az = $(this).data('azonosito');
        // let az = $(this).attr('data-azonosito');
        //console.log(az);
        window.location = 'details.php?kep=' + az;
    });
//Leírás karakterek számainak megjelenítése
    $(document).on('keyup paste', 'textarea', function () {
        const maxLength = 10;
        let str = this.value;
        let hossz = str.length;
        if (maxLength - hossz < 0) {
            str = str.slice(0, str.length - 1);
            this.value = str;
            hossz = str.length;
        }
        $('#countdown').text(maxLength - hossz);
    });
    // Leírás VÉGE

// Kép címének módosítása
    $('.cim').blur(function () {
        let str = $(this).text();
        let id = $(this).data('id');
        //console.log(id, str);
        $.post('modifydetails.php', {id: id, cim: str}, function (adat, status) {
            alert('A cím módosításra került!')
            $('.cim').text(adat);
            //console.log($(this));
        }).fail(function () {
            alert('Hiba!');
        })
    }); // kép címének módosítása VÉGE
});

