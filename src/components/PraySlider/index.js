import { Swiper, SwiperSlide } from 'swiper/react';

// IMAGE
import Unknown_person_img from "../../assets/images/Unknown_person.jpg";

// STYLE
import "swiper/css";
import "./style.css";

export default function PraySlider(props) {
  // PROPS
  const { data } = props;

  // RENDER
  return (
    <div className='pray-slider'>
      <div className='pray-slider__head'>
        <div className='pray-slider__title'>Cầu cho các linh hồn trong ngày này</div>
        <div className='pray-slider__desc'>Đọc 1 kinh lạy Cha + 1 kinh tin kính … tùy lòng mỗi người.</div>
      </div>
      <Swiper
        className='pray-slider__slider'
        slidesPerView={'auto'}
        spaceBetween={10}
        centeredSlides={true}
        initialSlide={1}
        // breakpoints={{
        //   768: {
        //     slidesPerView: 2,
        //     spaceBetween: 15,
        //   },
        //   991: {
        //     slidesPerView: 3,
        //     spaceBetween: 20,
        //   }
        // }}
      >
        {data && data.map(item => (
          <SwiperSlide key={item.positionID}>
            <div className='pray-slider__item'>
              <div className='pray-slider__image'>
                <img src={item.img || Unknown_person_img} alt=''/>
              </div>
              <div className='pray-slider__info'>
                <div className='pray-slider__name'>{item.name || 'Chưa có tên'}</div>
                <div className='pray-slider__year-of-dead'>Ngày mất: {item.yearOfDeadFormat || 'Chưa thông tin'}</div>
              </div>
            </div>
          </SwiperSlide>
        ))}
      </Swiper>
      <div className='pray-slider__text-swipe'>(Vuốt sang trái để xem)</div>
    </div>
  );
}