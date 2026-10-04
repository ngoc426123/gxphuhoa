import { useRef } from 'react';

// IMAGE
import Unknown_person_img from "../../assets/images/Unknown_person.jpg";

// UTIL
import { formatDate } from '../../utils/formatDate';

// STYLE
import "./style.css";

const pad2 = (value) => String(value).padStart(2, '0');

export default function PraySlider(props) {
  // PROPS
  const { data, date } = props;
  const formattedDate = date ? `${pad2(date.day)}/${pad2(date.month)}/${date.year}` : '';

  const _track = useRef(null);
  const _drag = useRef({ active: false, moved: false, x: 0, left: 0 });

  // Giữ chuột kéo ngang danh sách (cảm ứng đã tự cuộn được nên chỉ xử lý chuột)
  const onMouseDownTrack = (event) => {
    if (event.button !== 0) return;

    _drag.current = { active: true, moved: false, x: event.pageX, left: _track.current.scrollLeft };
  };

  const onMouseMoveTrack = (event) => {
    const drag = _drag.current;

    if (!drag.active) return;

    const dx = event.pageX - drag.x;

    if (Math.abs(dx) > 5 && !drag.moved) {
      drag.moved = true;
      _track.current.classList.add('--dragging');
    }
    if (drag.moved) _track.current.scrollLeft = drag.left - dx;
  };

  const onMouseUpTrack = () => {
    _drag.current.active = false;
    _track.current.classList.remove('--dragging');
  };

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
        ref={_track}
        onMouseDown={onMouseDownTrack}
        onMouseMove={onMouseMoveTrack}
        onMouseUp={onMouseUpTrack}
        onMouseLeave={onMouseUpTrack}
        onDragStart={(event) => event.preventDefault()}
      >
        {data && data.map(item => (
          <div key={item.positionID} className='pray-slider__item'>
            <div className='pray-slider__image'>
              <img src={item.img || Unknown_person_img} alt=''/>
            </div>
            <div className='pray-slider__info'>
              <div className='pray-slider__name'>{item.name || 'Chưa có tên'}</div>
              <div className='pray-slider__year-of-dead'>Ngày mất: {formatDate(item.yearOfDead) || 'Chưa thông tin'}</div>
              <div className='pray-slider__position-info'>
                <div className='pray-slider__position-item'>Số kệ: {item.shelf || 'Chưa thông tin'}</div>
                <div className='pray-slider__position-item'>Số hàng: {item.row || 'Chưa thông tin'}</div>
                <div className='pray-slider__position-item'>Vị trí: {item.number || 'Chưa thông tin'}</div>
              </div>
            </div>
          </div>
        ))}
      </div>
      <div className='pray-slider__text-swipe'>(Vuốt sang trái để xem)</div>
    </div>
  );
}
