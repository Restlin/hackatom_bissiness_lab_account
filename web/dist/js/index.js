const burg = $(".js-burg");
const menuMobile = $(".js-menu");

burg.on("click", () => {
  const isMenuHaveActiveClass = menuMobile.hasClass("active");

  if (isMenuHaveActiveClass) {
    menuMobile.removeClass("active");
    burg.removeClass("active");
    return;
  }
  menuMobile.addClass("active");
  burg.addClass("active");
});

$(window).resize(() => {
  menuMobile.removeClass("active");
  burg.removeClass("active");
});


const preview = $('.js-preview');
const wrapperPreview = preview.closest('.wrapper');

const previewAnimationFn = ()=>{
  const leftElements = $('.js-leftPreviewElement');
  const rightElements = $('.js-rightPreviewElement');

  $('.header').css('margin-bottom',0);

  preview.find('header').css('display','flex');

  setTimeout(()=>{
    leftElements.each((i,elem)=>{
      setTimeout(()=>{
        $(elem).addClass('animShowUpToBottom');
      },i*250);
    })

  },500)

  setTimeout(()=>{
    rightElements.addClass('animRightToLeft')
  },1500)

  setTimeout(()=>{
    const btn = $('.js-buttonPreview');
    btn.addClass('animShowOpacity')
  },2500)

};

const initPreviewPage = ()=>{
  if(!wrapperPreview) return;
  wrapperPreview.removeClass("wrapper");
  previewAnimationFn();


};
initPreviewPage();


