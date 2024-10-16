import { useMemo, useState } from 'react';
import './App.css';
import Calendar from './components/Calendar';
import { months } from './constants/date';

function App() {
  // STATE
  const [current] = useState({ month: 10, year: 2024 });
  const textMonth = useMemo(() => {
    return months[current.month - 1];
  }, [current.month]);

  return (
    <div className="App-pray-for-us">
      <div className='App-title'>Xin cầu cho các linh hồn</div>
      <div className='App-desc'>'Chính lúc chết đi là khi vui sống muôn đời.'</div>
      <div className='App-date-header'>
        <div className='App-date-info'>
          <div className='App-date-info__year'>{current?.year || 0}</div>
          <div className='App-date-info__month'>{textMonth}</div>
        </div>
      </div>
      <Calendar {...current} />
    </div>
  );
}

export default App;
