import { useEffect, useState } from 'react';

// IMAGE
import Unknown_person_img from '../../assets/images/Unknown_person.jpg';

// UTIL
import { formatDate } from '../../utils/formatDate';
import useDragScroll from '../../hooks/useDragScroll';

// STYLE
import './style.css';

// Danh sách thẻ người đã khuất, kéo ngang được — dùng chung cho SPA Hôm nay và popup lịch
export default function PersonList(props) {
  const { data } = props;

  const { trackRef, onMouseDown, onMouseMove, onMouseUp } = useDragScroll();
  const [overflow, setOverflow] = useState(false);

  // Chỉ hiện gợi ý vuốt khi danh sách dài hơn khung
  useEffect(() => {
    const el = trackRef.current;

    if (!el) return;

    const check = () => setOverflow(el.scrollWidth > el.clientWidth + 1);
    const observer = new ResizeObserver(check);

    observer.observe(el);
    check();

    return () => observer.disconnect();
  }, [trackRef, data]);

  // RENDER
  return (
    <div className='person-list'>
      <div
        className='person-list__track'
        ref={trackRef}
        onMouseDown={onMouseDown}
        onMouseMove={onMouseMove}
        onMouseUp={onMouseUp}
        onMouseLeave={onMouseUp}
        onDragStart={(event) => event.preventDefault()}
      >
        {data && data.map(item => (
          <div key={item.ID} className='person-list__card'>
            <div className='person-list__image'>
              <img src={item.img || Unknown_person_img} alt=''/>
            </div>
            <div className='person-list__info'>
              <div className='person-list__name'>{item.name || 'Chưa có tên'}</div>
              <div className='person-list__year-of-dead'>An nghỉ ngày: {formatDate(item.yearOfDead) || 'Chưa thông tin'}</div>
              {/* Tạm ẩn vị trí lưu tro cốt (Kệ/Hàng/Thứ tự), dữ liệu vẫn giữ trong admin & API
              <div className='person-list__position'>
                Kệ {item.shelf || '—'} · Hàng {item.row || '—'} · Vị trí {item.number || '—'}
              </div>
              */}
            </div>
          </div>
        ))}
      </div>
      {overflow && <div className='person-list__text-swipe'>(Vuốt sang trái để xem)</div>}
    </div>
  );
}
