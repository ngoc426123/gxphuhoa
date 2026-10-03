import { useCallback, useEffect, useState } from 'react';

// IMAGE
import Unknown_person_img from "../../assets/images/Unknown_person.jpg";

// UTIL
import { formatDate } from '../../utils/formatDate';

// STYLE
import "./style.css";

export default function ScreenToday() {
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
      <div className='screen-today__grid'>
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
