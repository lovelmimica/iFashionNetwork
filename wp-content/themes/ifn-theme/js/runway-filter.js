addLoadEventCallback( () => {
    filterPosts();

    let filterForm = document.querySelector(".runway-filter-form");
    if(filterForm){
        filterForm.addEventListener( 'change', (e) => {
            filterPosts();
        });
    }
});

function filterPosts(){
    let filterForm = document.querySelector(".runway-filter-form");

    if(filterForm){
        let season = filterForm.querySelector('select[name="season"]').value;
        let city = filterForm.querySelector('select[name="city"]').value;
        let designer = filterForm.querySelector('select[name="designer"]').value;
    
        let posts = document.querySelectorAll('article.blog-item');
        posts.forEach( post => {
            if( season != "" && season != post.dataset.season ) post.style.display = "none";
            else if( city != "" && city != post.dataset.city ) post.style.display = "none";
            else if( designer != "" && designer != post.dataset.designer ) post.style.display = "none";
            else post.style.display = "block";
        });
    }

}
