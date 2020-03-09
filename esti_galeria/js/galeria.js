$(document).ready(function () {
    $('[name=reg-form]').submit(function (event) {
        event.preventDefault();
        let email = $('[name=email]').val().trim();
        let pass = $('[name=password]').val().trim();
        let pass2 = $('[name=password2]').val().trim();
        
        var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/;

        if (regex.test(pass) && pass === pass2) {
            console.log("jee");
            $.ajax({
            url: 'modifydetails.php',
            method: 'POST',
            data: {id: id, desc: str}, //amit a servernek elküldök
            dataType: 'text', //amit kapok a servertől (pl.: text, html, json)
            success: function (adat) {
                //response code = 200
                $('.leiras').text(adat);
                console.log("A kép leírása módosításra került!");
            },
            error: function () {
                console.log("A kép leírása nem módosult!");
            }
        })
        } else {
            console.log("neee");
        }

    })

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
            console.log('A cím módosításra került!')
            $('.cim').text(adat);
            //console.log($(this));
        }).fail(function () {
            console.log('Hiba!');
        })
    }); // kép címének módosítása VÉGE

    // Kép leírásának módosítása
    $('.leiras').blur(function () {
        let id = $('.cim').data('id');
        let str = $(this).text();

        console.log(id, str);
        $.ajax({
            url: 'modifydetails.php',
            method: 'POST',
            data: {id: id, desc: str}, //amit a servernek elküldök
            dataType: 'text', //amit kapok a servertől (pl.: text, html, json)
            success: function (adat) {
                //response code = 200
                $('.leiras').text(adat);
                console.log("A kép leírása módosításra került!");
            },
            error: function () {
                console.log("A kép leírása nem módosult!");
            }
        })

    }); // kép leírásának módosítása VÉGE

});

