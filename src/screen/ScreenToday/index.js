import { useCallback, useEffect, useRef, useState } from 'react';

// IMAGE
import Unknown_person_img from "../../assets/images/Unknown_person.jpg";

// UTIL
import { formatDate } from '../../utils/formatDate';

// STYLE
import "./style.css";

export default function ScreenToday() {
  const _grid = useRef(null);
  const _drag = useRef({ active: false, moved: false, x: 0, left: 0 });

  // STATE
  const [prayData, setPrayData] = useState([]);
  const [loaded, setLoaded] = useState(false);

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

  // Giữ chuột kéo ngang danh sách (cảm ứng đã tự cuộn được nên chỉ xử lý chuột)
  const onMouseDownGrid = (event) => {
    if (event.button !== 0) return;

    _drag.current = { active: true, moved: false, x: event.pageX, left: _grid.current.scrollLeft };
  };

  const onMouseMoveGrid = (event) => {
    const drag = _drag.current;

    if (!drag.active) return;

    const dx = event.pageX - drag.x;

    if (Math.abs(dx) > 5 && !drag.moved) {
      drag.moved = true;
      _grid.current.classList.add('--dragging');
    }
    if (drag.moved) _grid.current.scrollLeft = drag.left - dx;
  };

  const onMouseUpGrid = () => {
    _drag.current.active = false;
    _grid.current.classList.remove('--dragging');
  };

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
          <svg viewBox='0 0 20 28' width='14' height='20'>
            <path d='M8 0h4v8h8v4h-8v16H8V12H0V8h8z' fill='currentColor'/>
          </svg>
        </div>
        <div className='screen-today__empty-line1'>Không có ngày giỗ nào của người đã mất trong xứ</div>
        <div className='screen-today__empty-line2'>Xin mọi người cầu nguyện cho các linh hồn</div>
      </div>
    );
  }

  return (
    <div className='screen-today'>
      <div
        className='screen-today__grid'
        ref={_grid}
        onMouseDown={onMouseDownGrid}
        onMouseMove={onMouseMoveGrid}
        onMouseUp={onMouseUpGrid}
        onMouseLeave={onMouseUpGrid}
        onDragStart={(event) => event.preventDefault()}
      >
        {prayData.map(item => (
          <div key={item.positionID} className='screen-today__card'>
            <div className='screen-today__image'>
              <img src={item.img || Unknown_person_img} alt=''/>
            </div>
            <div className='screen-today__info'>
              <div className='screen-today__name'>{item.name || 'Chưa có tên'}</div>
              <div className='screen-today__year-of-dead'>Ngày mất: {formatDate(item.yearOfDead) || 'Chưa thông tin'}</div>
              <div className='screen-today__position-info'>
                <div className='screen-today__position-item'>Số kệ: {item.shelf || 'Chưa thông tin'}</div>
                <div className='screen-today__position-item'>Số hàng: {item.row || 'Chưa thông tin'}</div>
                <div className='screen-today__position-item'>Vị trí: {item.number || 'Chưa thông tin'}</div>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
