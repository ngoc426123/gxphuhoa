import { useCallback, useEffect, useState } from 'react';

// IMAGE
import Unknown_person_img from "../../assets/images/Unknown_person.jpg";

// COMPONENT
import CandleIcon from '../../components/CandleIcon';

// UTIL
import { formatDate } from '../../utils/formatDate';
import useDragScroll from '../../hooks/useDragScroll';

// STYLE
import "./style.css";

export default function ScreenToday(props) {
  const { isSoulsMonth } = props;

  // STATE
  const [prayData, setPrayData] = useState([]);
  const [loaded, setLoaded] = useState(false);

  const { trackRef, onMouseDown, onMouseMove, onMouseUp } = useDragScroll();

  // METHOD
  const getPrayForUs = useCallback(async () => {
    try {
      const now = new Date();
      const day = now.getDate();
      const month = now.getMonth() + 1;
      const apiUrl = (window.PRAY_FOR_US?.api || process.env.REACT_APP_API) + '/' + day + '/' + month;
      const options = {
        method: 'GET'
      }
      const response = await fetch(apiUrl, options);
      const data = await response.json();

      setPrayData(data);
    } catch (error) {
      console.error(error);
    } finally {
      setLoaded(true);
    }
  }, []);

  // SIDE EFFECT
  useEffect(() => {
    getPrayForUs();
  }, [getPrayForUs]);

  // RENDER
  if (!loaded) return null;

  if (!prayData.length) {
    return (
      <div className='screen-today__empty'>
        <div className='App-ornament' aria-hidden='true'>
          <CandleIcon />
        </div>
        <div className='screen-today__empty-line1'>Không có ngày giỗ nào của người đã mất trong xứ</div>
        <div className='screen-today__empty-line2'>Xin hiệp thông cầu nguyện cho các linh hồn.</div>
        {isSoulsMonth && (
          <div className='screen-today__empty-line3'>
            Tháng Các Linh Hồn: xin dâng lời cầu cho mọi linh hồn đã an nghỉ trong Chúa.
          </div>
        )}
      </div>
    );
  }

  return (
    <div className='screen-today'>
      <div
        className='screen-today__grid'
        ref={trackRef}
        onMouseDown={onMouseDown}
        onMouseMove={onMouseMove}
        onMouseUp={onMouseUp}
        onMouseLeave={onMouseUp}
        onDragStart={(event) => event.preventDefault()}
      >
        {prayData.map(item => (
          <div key={item.positionID} className='screen-today__card'>
            <div className='screen-today__image'>
              <img src={item.img || Unknown_person_img} alt=''/>
            </div>
            <div className='screen-today__info'>
              <div className='screen-today__name'>{item.name || 'Chưa có tên'}</div>
              <div className='screen-today__year-of-dead'>An nghỉ ngày: {formatDate(item.yearOfDead) || 'Chưa thông tin'}</div>
              {/* Tạm ẩn vị trí lưu tro cốt (Kệ/Hàng/Thứ tự), dữ liệu vẫn giữ trong admin & API
              <div className='screen-today__position-info'>
                <div className='screen-today__position-label'>Vị trí lưu tro cốt</div>
                <div className='screen-today__position-value'>
                  Kệ {item.shelf || '—'} · Hàng {item.row || '—'} · Vị trí {item.number || '—'}
                </div>
              </div>
              */}
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
