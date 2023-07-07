$(function () {

    menulist = $(".nav li a");

    //Cambiar al elemento de lista clickeado
    menulist.click(function () {

        menulist.removeClass("active");

        $(this).addClass("active");

        localStorage.setItem('activeSection',
            $(this).data('position'));
    })

    //Guardar en LocalStorage
    activeSection = localStorage.getItem('activeSection');
    if (activeSection) {
        const section = menulist.eq(activeSection - 1);
        section.addClass('active');
    }
})