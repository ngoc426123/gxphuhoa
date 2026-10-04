// IMAGE
import Unknown_person_img from "../../assets/images/Unknown_person.jpg";

// UTIL
import { formatDate } from '../../utils/formatDate';
import useDragScroll from '../../hooks/useDragScroll';

// STYLE
import "./style.css";

const pad2 = (value) => String(value).padStart(2, '0');

export default function PraySlider(props) {
  // PROPS
  const { data, date } = props;
  const formattedDate = date ? `${pad2(date.day)}/${pad2(date.month)}/${date.year}` : '';

  const { trackRef, onMouseDown, onMouseMove, onMouseUp } = useDragScroll();

  // RENDER
  return (
    <div className='pray-slider'>
      <div className='pray-slider__head'>
        {formattedDate && <div className='pray-slider__date'>Ngày {formattedDate}</div>}
        <div className='pray-slider__title'>Cầu cho các linh hồn trong ngày này</div>
        <div className='pray-slider__desc'>Đọc 1 kinh lạy Cha + 1 kinh tin kính … tùy lòng mỗi người.</div>
      </div>
      <div
        className='pray-slider__track'
        ref={trackRef}
        onMouseDown={onMouseDown}
        onMouseMove={onMouseMove}
        onMouseUp={onMouseUp}
        onMouseLeave={onMouseUp}
        onDragStart={(event) => event.preventDefault()}
      >
        {data && data.map(item => (
          <div key={item.positionID} className='pray-slider__item'>
            <div className='pray-slider__image'>
              <img src={item.img || Unknown_person_img} alt=''/>
            </div>
            <div className='pray-slider__info'>
              <div className='pray-slider__name'>{item.name || 'Chưa có tên'}</div>
              <div className='pray-slider__year-of-dead'>An nghỉ ngày: {formatDate(item.yearOfDead) || 'Chưa thông tin'}</div>
              <div className='pray-slider__position-info'>
                <div className='pray-slider__position-label'>Vị trí lưu tro cốt</div>
                <div className='pray-slider__position-value'>
                  Kệ {item.shelf || '—'} · Hàng {item.row || '—'} · Vị trí {item.number || '—'}
                </div>
              </div>
            </div>
          </div>
        ))}
      </div>
      <div className='pray-slider__text-swipe'>(Vuốt sang trái để xem)</div>
    </div>
  );
}
