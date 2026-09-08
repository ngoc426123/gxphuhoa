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
    this.$pause    = this.$element.find('.heroBanner-pause');
  }

  initSwiper() {
    this.swiper = new Swiper(this.$swiper[0], {
      modules: [Autoplay, Pagination, Navigation],
      loop: true,
      speed: 700,
      autoplay: {
        delay: 6000,
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
    this.initPause();
  }

  initPause() {
    this.$pause.on('click', () => {
      const $icon = this.$pause.find('i');
      if (this.swiper.autoplay.running) {
        this.swiper.autoplay.stop();
        $icon.removeClass('fa-pause').addClass('fa-play');
      } else {
        this.swiper.autoplay.start();
        $icon.removeClass('fa-play').addClass('fa-pause');
      }
    });
  }
}
