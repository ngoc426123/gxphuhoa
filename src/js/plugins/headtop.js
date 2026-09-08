@Plugin({
  options: {
  }
})
export default class HeadTop {
  init() {
    $(".iAbout").fancybox({
      type: 'ajax',
      toolbar: false,
      smallBtn: false,
      baseClass: 'introAbout',
      animationEffect: 'fade',
      animationDuration: 300,
      buttons: [],
      touch: false,
    });
  }
}