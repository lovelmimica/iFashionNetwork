addLoadEventCallback( () => {

    let galleryModal = document.querySelector('.gallery-modal');

    let closeGalleryModal = galleryModal.querySelector(".gallery-modal__back");

    let galleryModalImage = galleryModal.querySelector(".gallery-modal__image");

    let nextImageCtrl = galleryModal.querySelector(".gallery-modal__navigation .next-image");

    let previouseImageCtrl = galleryModal.querySelector(".gallery-modal__navigation .previous-image");

    

    let galleryImageLinks = document.querySelectorAll('.gallery a');

    let updateGalleryModalSocialShareCtrls = (imageUrl) => {
        let galleryModalSocialShareCtrls = galleryModal.querySelectorAll(".entry-social > a"); 
        galleryModalSocialShareCtrls.forEach(ctrl => {
            ctrl.href = ctrl.href + imageUrl;
        });
    }


    galleryImageLinks.forEach( (imgLink, index) => {

        imgLink.addEventListener('click', e => {

            e.preventDefault();

            galleryModalImage.src = imgLink.href.includes("/uploads/") ? imgLink.href : imgLink.querySelector("img").src;

            updateGalleryModalSocialShareCtrls(galleryModalImage.src);

            let previousIndex = index == 0 ? galleryImageLinks.length - 1 : index - 1;

            let previousImageSrc = galleryImageLinks[previousIndex].href;



            let nextIndex = index == galleryImageLinks.length - 1 ? 0 : index + 1;

            let nextImageSrc = galleryImageLinks[nextIndex].href;



            nextImageCtrl.dataset.href = nextImageSrc;

            previouseImageCtrl.dataset.href = previousImageSrc;

            

            let currentImageNum = document.querySelector(".current-image-num");



            currentImageNum.textContent = index + 1 + " / " + galleryImageLinks.length;



            galleryModal.classList.add("displayed");

        });

    });



    nextImageCtrl.addEventListener('click', () => {

        let href = nextImageCtrl.dataset.href; 

        let image = document.querySelector(`a[href='${href}']`);

        image.click();

    });



    previouseImageCtrl.addEventListener('click', () => {

        let href = previouseImageCtrl.dataset.href; 

        let image = document.querySelector(`a[href='${href}']`);

        image.click();

    });



    document.addEventListener("keydown", (e) => {

        if(galleryModal.classList.contains("displayed")){

            if(e.key == 'ArrowLeft') previouseImageCtrl.click();

            else if(e.key == 'ArrowRight') nextImageCtrl.click();

        }

    });



    closeGalleryModal.addEventListener("click", () =>{

        galleryModal.classList.remove("displayed");

    });

});

