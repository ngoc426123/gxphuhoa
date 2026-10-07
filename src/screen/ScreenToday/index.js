import { useCallback, useEffect, useState } from 'react';

// COMPONENT
import PersonList from '../../components/PersonList';

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

      if (!response.ok) throw new Error('API lỗi: ' + response.status);

      const data = await response.json();

      setPrayData(Array.isArray(data) ? data : []);
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
  // Giữ chỗ khi đang tải để trang không bị nhảy
  if (!loaded) return <div className='screen-today__empty' aria-busy='true' />;

  if (!prayData.length) {
    // Link trang lịch: lấy từ shortcode [pray_for_us_today link="..."] (data-link trên div mount)
    const calendarLink = document.getElementById('root-pray-for-us-today')?.dataset.link;

    return (
      <div className='screen-today__empty'>
        <div className='screen-today__empty-line1'>Không có ngày giỗ nào của người đã mất trong xứ</div>
        {calendarLink && (
          <a className='screen-today__empty-link' href={calendarLink}>Xem lịch cầu nguyện tháng này</a>
        )}
      </div>
    );
  }

  return <PersonList data={prayData} />;
}
