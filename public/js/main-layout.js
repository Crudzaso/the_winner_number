const header = document.querySelector('#header');

const headerToggle = document.querySelector("#toggle-header")

const mobileNav = document.querySelector("#mobile-nav")

console.log(header);

window.addEventListener("scroll", function(){
    if (window.scrollY > 50) {
        header.classList.add('scroll');
      } else {
        header.classList.remove('scroll');
      }
})

headerToggle.addEventListener("click", function(){
    mobileNav.classList.toggle('hidden');

    
})