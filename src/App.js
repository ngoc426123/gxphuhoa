import { useEffect, useState } from 'react';

// IMAGE
import Unknown_person_img from './assets/images/Unknown_person.jpg';

// STYLE
import './App.css';

// Thứ tự hiển thị theo thứ bậc; linh mục chưa chọn vị trí rơi vào nhóm cuối
const GROUPS = [
  { positionID: '2', title: 'Cha Chánh xứ' },
  { positionID: '3', title: 'Các Cha nguyên Chánh xứ' },
  { positionID: '1', title: 'Các Cha khách' },
  { positionID: '', title: 'Các Cha khác' },
];

// Bỏ dấu để tìm "nguyen" vẫn ra "Nguyễn"
const normalize = (text) => text.normalize('NFD').replace(/[̀-ͯ]/g, '').replace(/đ/g, 'd').replace(/Đ/g, 'D').toLowerCase();

const groupOf = (item) => GROUPS.some(group => group.positionID === item.positionID) ? item.positionID : '';

function Cross() {
  return (
    <svg className='father-love__cross' viewBox='0 0 20 28' width='12' height='17' aria-hidden='true'>
      <path d='M8 0h4v8h8v4h-8v16H8V12H0V8h8z' fill='currentColor'/>
    </svg>
  );
}

function App() {
  // STATE
  const [fathers, setFathers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [keyword, setKeyword] = useState('');

  // METHOD
  const getFathers = async () => {
    try {
      const response = await fetch((window.FATHER_LOVE?.api || process.env.REACT_APP_API) + '/getall');
      if (!response.ok) throw new Error('API lỗi: ' + response.status);
      const data = await response.json();

      setFathers(data);
    } catch (error) {
      console.error(error);
    } finally {
      setLoading(false);
    }
  }

  useEffect(() => {
    getFathers();
  }, []);

  const result = fathers.filter(item => normalize(item.name).includes(normalize(keyword.trim())));

  // RENDER
  return (
    <div className='father-love'>
      <div className='father-love__heading'>
        <div className='father-love__sub-title'>Giáo xứ Phú Hòa</div>
        <h1 className='father-love__title'>Danh sách Linh mục</h1>
        <div className='father-love__divider'><Cross /></div>
        <p className='father-love__desc'>Hình ảnh, tên và dòng tu (hoặc chủng viện) của các linh mục đã từng và đang giúp tại giáo xứ Phú Hòa, xin mọi người một lời cầu nguyện cho các ngài mạnh giỏi, đầy tràn hồng ân để luôn kiên trì trong việc Chúa.</p>
        <div className='father-love__search'>
          <input
            type='search'
            placeholder='Tìm theo tên linh mục...'
            aria-label='Tìm linh mục theo tên'
            value={keyword}
            onChange={(e) => setKeyword(e.target.value)}
          />
        </div>
      </div>
      {loading
        ? <div className='father-love__loading'>Đang tải danh sách...</div>
        : result.length > 0
          ? GROUPS.map(group => {
            const items = result.filter(item => groupOf(item) === group.positionID);

            return items.length > 0 && (
              <section className='father-love__group' key={group.positionID}>
                <h2 className='father-love__group-title'><span>{group.title}</span></h2>
                <div className='father-love__list'>
                  {items.map(item => (
                    <article className='father-love__item' key={item.ID}>
                      <div className='father-love__image'>
                        <img src={item.img || Unknown_person_img} alt={item.name} loading='lazy'/>
                      </div>
                      <div className='father-love__info'>
                        <h3 className='father-love__name'>{item.name}</h3>
                        {item.background && <div className='father-love__place'>{item.background}</div>}
                      </div>
                    </article>
                  ))}
                </div>
              </section>
            );
          })
          : (
            <div className='father-love__no-result'>
              <div className='father-love__no-result-text-1'>Không tìm thấy linh mục</div>
              <div className='father-love__no-result-text-2'>Vui lòng thử lại với tên khác.</div>
            </div>
          )
      }
    </div>
  );
}

export default App;
