$(function(){
    
    var menulist = $(".nav li a");

    menulist.click(function(){
        menulist.removeClass("active");
        $(this).addClass("active");
        
        localStorage.setItem('activeSection', 
        $(this).attr('href'));
    })

    const activeSection = localStorage.getItem('activeSection');
    if(activeSection){
        const  section = $('nav a[href="' + activeSection + '"]'); 
        if (section){
            section.addClass('active');
        }
    }
})
