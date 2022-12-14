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
document.getElementsByClassName('nav-link')[4].addEventListener('click',()=>{subMenuControl(2)});

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
  if (!document.getElementsByClassName('dropdown')[2].contains(pointer)){
    closeSubMenu(2);
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
    content[i].style.width = i!=1 ? '230px' : '330px';
    document.getElementsByClassName('fa-angle-down')[i].style.transform = 'rotate(-180deg)';
  } else {                  // LARGURA DA TELA MENOR
    content[i].style.display = 'block';
    content[i].style.borderWidth = '4px';
    content[i].style.visibility = 'visible';
    content[i].style.height = (i!=2) ? '145px' : '75px';
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

let articleP = 0.8;
let articleH1 = 1.3;
let articleH2 = 0.9;

const increaseFontSize = ()=>{
  const tagH1 = document.getElementsByTagName('h1');
  const tagH2 = document.getElementsByTagName('h2');
  const tagP = document.getElementsByTagName('p');
  if (articleH1 <= 2){
    articleH1 += 0.1;
    for (let i=0; i<tagH1.length; i++) {
      tagH1[i].style.fontSize = articleH1+'rem';
      console.log(tagH1[i].style.fontSize);
    }
  }
  
  if (articleH2 <= 1.6){
    articleH2 += 0.1;
    for (let i=0; i<tagH2.length; i++) {
      tagH2[i].style.fontSize = articleH2+'rem';
      console.log(tagH2[i].style.fontSize);
    }
  }
  if (articleP <= 1.5){
    articleP += 0.1;
    for (let i=0; i<tagP.length; i++) {
      tagP[i].style.fontSize = articleP+'rem';
      console.log(tagP[i].style.fontSize);
    }
  }
}

const decreaseFontSize = ()=>{
  const tagH1 = document.getElementsByTagName('h1');
  const tagH2 = document.getElementsByTagName('h2');
  const tagP = document.getElementsByTagName('p');
  if (articleH1 > 0.9){
    articleH1 -= 0.1;
    for (let i=0; i<tagH1.length; i++) {
      tagH1[i].style.fontSize = articleH1+'rem';
      console.log(tagH1[i].style.fontSize);
    }
  }
  
  if (articleH2 > 0.5){
    articleH2 -= 0.1;
    for (let i=0; i<tagH2.length; i++) {
      tagH2[i].style.fontSize = articleH2+'rem';
      console.log(tagH2[i].style.fontSize);
    }
  }
  if (articleP > 0.4){
    articleP -= 0.1;
    for (let i=0; i<tagP.length; i++) {
      tagP[i].style.fontSize = articleP+'rem';
      console.log(tagP[i].style.fontSize);
    }
  }
}