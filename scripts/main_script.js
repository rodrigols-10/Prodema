// controlando o posicionamento do navbar
let navbar_height = document.getElementById('navbar_top').offsetHeight;
let header_height = document.getElementById('header_top').offsetHeight;
let height_change = header_height - navbar_height;
document.addEventListener("DOMContentLoaded", function(){
    window.addEventListener('scroll', function() {
        if (window.scrollY > height_change) {
            document.getElementById('navbar_top').classList.add('fixed-top');
            document.getElementById('navbar_top').style.backgroundColor = "rgba(0,136,169,0.9)";
            //document.body.style.paddingTop = navbar_height + 'px';
        } else {
            document.getElementById('navbar_top').classList.remove('fixed-top');
            // remove padding top from body
            // document.body.style.paddingTop = '0';
            document.getElementById('navbar_top').style.backgroundColor = "transparent";
        } 
    });
});
// FIM DO CONTROLE DO NAVBAR

// ADICIONANDO CLICKS PARA OS MENUS QUE MOSTRAM SEUS DROPDOWN
document.getElementsByClassName('nav-link')[0].addEventListener('click',()=>{subMenuControl(0)});
document.getElementsByClassName('nav-link')[2].addEventListener('click',()=>{subMenuControl(1)});

// VERIFICANDO SE OCORRE UM CLICK FORA DOS SUBMENUS PARA FECHÁ-LOS
// let pointer = '';
window.addEventListener('click', function(e){   
  const pointer = e.target;
  if (!document.getElementsByClassName('dropdown')[0].contains(pointer)){
    closeSubMenu(0);
  }
  if (!document.getElementsByClassName('dropdown')[1].contains(pointer)){
    closeSubMenu(1);
  }
});
// CONTROLE DOS SUBMENUS DO NAVBAR
const subMenuControl = (i)=>{
  const content = document.getElementsByClassName('dropdown-content');
  if(content[i].style.visibility == 'hidden'){
    openSubMenu(i);
  } else {
    closeSubMenu(i);
  }
}
const openSubMenu = (i)=>{
  const content = document.getElementsByClassName('dropdown-content');
  const documentWidth = document.body.clientWidth;
  //console.log(content[0].children[0]);
  if( documentWidth > 800){ // LARGURA DA TELA MAIOR
    content[i].style.display = 'block';
    content[i].style.borderWidth = '4px';
    content[i].style.visibility = 'visible';
    content[i].style.opacity = '1';
    content[i].style.width = i==0 ? '200px' : '290px';
    document.getElementsByClassName('fa-angle-down')[i].style.transform = 'rotate(-180deg)';
  } else {                  // LARGURA DA TELA MENOR
    content[i].style.display = 'block';
    content[i].style.borderWidth = '4px';
    content[i].style.visibility = 'visible';
    content[i].style.height = '145px';
    document.getElementsByClassName('fa-angle-down')[i].style.transform = 'rotate(-180deg)';
  }
}
const closeSubMenu = (i)=>{
  const content = document.getElementsByClassName('dropdown-content');
  const documentWidth = document.body.clientWidth;
    if(documentWidth > 800){  // LARGURA DA TELA MAIOR
      content[i].style.borderWidth = '0px';
      content[i].style.visibility = 'hidden';
      content[i].style.opacity = '0';
      document.getElementsByClassName('fa-angle-down')[i].style.transform = 'rotate(0deg)';
    } else {                  // LARGURA DA TELA MENOR
      content[i].style.borderWidth = '0px';
      content[i].style.visibility = 'hidden';
      content[i].style.height = '0px';
      document.getElementsByClassName('fa-angle-down')[i].style.transform = 'rotate(0deg)';
    }
  
}