window.addEventListener('scroll', onScroll); //Concertando erro no console, referente ao scrool, no body tinhamos a seguinte function = onscroll="onScroll()"

onScroll();
function onScroll() {
    
    if(scrollY > 0){
        navigation.classList.add('scroll');
        //OBJETO.LISTA-DE-CLASSES.FUNÇÃO('parametro');
    }else{
        navigation.classList.remove('scroll');
    }
}

activateMenuAtCurrentSection();
function activateMenuAtCurrentSection() {
    //linha alvo
    const targetLine = scrollY + innerHeight / 2;

    // verificar se a seção passou da linha   // quais dados irá precisar?
  
    //o topo da seção
    const sectionTop = home.offsetTop;

    // a altura da seção
    const sectionHeight = home.offsetHeight;

    // o topo da seção chegou ou ultrapassou a linha alvo
    const sectionTopReachOrPassedTargetLine = targetLine >= sectionTop;

    //Informação dos dados e da lógica
    console.log (
        'O topo da seção chegou ou passou da linha?',
        sectionTopReachOrPassedTargetLine
    );

    //verificar se a base está abaixo da linha alvo

    //a seção termina onde?
    const sectionEndsAt = sectionTop + sectionHeight
    
}

function openMenu() {
    document.body.classList.add('menu-expanded');
}

function closeMenu() {
    document.body.classList.remove('menu-expanded');
}

ScrollReveal({
    origin: 'top', /*top = de cima p/ baixo*/ /*ou*/ /*padding = de baixo p/cima*/
    distance: '30px',
    duration: 700,
}).reveal(`
    #home, 
    #home img, 
    #home .stats, 
    #services,
    #services header,
    #services .card,
    #about,
    #about header,
    #about .content`); //Irá revelar elementos da pag. aos poucos