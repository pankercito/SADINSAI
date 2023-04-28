$(function(){

    menulist = $(".nav li a");

    menulist.click(function(){

        menulist.removeClass("active");

        $(this).addClass("active");
        
        localStorage.setItem('activeSection', 
        $(this).data('position'));
    })

    activeSection = localStorage.getItem('activeSection');
    if (activeSection) {
        const section = menulist.eq(activeSection-1);
        section.addClass('active');
  }
})
