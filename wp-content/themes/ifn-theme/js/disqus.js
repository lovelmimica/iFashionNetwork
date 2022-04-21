var disqus_config = function () {
    let article = document.querySelector(".blog-item.blog-single");
    let permalink = article.dataset.permalink;
    let slug = article.dataset.slug;
    
    this.page.url = permalink;  
    this.page.identifier = slug; 
};
    
(function() { 
    console.log("Hello from disqus ");

    var d = document, s = d.createElement('script');
        
    s.src = 'https://ifashionnetwork2.disqus.com/embed.js';
        
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
})();
