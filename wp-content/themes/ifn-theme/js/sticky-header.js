addLoadEventCallback( () => {
    let headerMenu = document.querySelector('#header .menu-container.header-lower');

    document.addEventListener('scroll', (e) => {
        headerMenu.setAttribute('style', '');

        if(headerMenu.getBoundingClientRect().top <= 0){
            headerMenu.style.position = "fixed";

            let wpAdminBar = document.querySelector('#wpadminbar');
            if(wpAdminBar) headerMenu.style.top = wpAdminBar.getBoundingClientRect().height + "px";
        }
    });
});