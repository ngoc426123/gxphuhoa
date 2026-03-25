import Swiper from 'swiper';
import { Autoplay, Pagination, Navigation } from 'swiper/modules';

@Plugin({
  options: {
    default: {}
  }
})
export default class HeroBannerSlider {
  init() {
    this.initDOM();
    this.initSwiper();
  }

  initDOM() {
    this.$swiper   = this.$element.find('.heroBanner-swiper');
    this.$prev     = this.$element.find('.heroBanner-prev');
    this.$next     = this.$element.find('.heroBanner-next');
    this.$pag      = this.$element.find('.heroBanner-pagination');
  }

  initSwiper() {
    this.swiper = new Swiper(this.$swiper[0], {
      modules: [Autoplay, Pagination, Navigation],
      loop: true,
      speed: 700,
      autoHeight: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
      },
      pagination: {
        el: this.$pag[0],
        clickable: true,
      },
      navigation: {
        prevEl: this.$prev[0],
        nextEl: this.$next[0],
      },
    });
  }
}
