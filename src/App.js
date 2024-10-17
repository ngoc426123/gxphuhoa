import { useCallback, useEffect, useMemo, useRef, useState } from 'react';
import './App.css';
import Calendar from './components/Calendar';
import { months } from './constants/date';

// ICON
import Left_icon from './assets/images/angle-left.svg';

function App() {
  const _timeRef = useRef();

  // STATE
  const [current, setCurrent] = useState({ month: 10, year: 2024 });
  const [prayData, setPrayData] = useState([]);
  const textMonth = useMemo(() => {
    return months[current.month - 1];
  }, [current.month]);

  // METHOD
  const getPrayForUs = useCallback(async () => {
    try {
      const { month } = current;
      const apiUrl = process.env.REACT_APP_API + '/' + month;
      const options = {
        method: 'GET'
      }
      const response = await fetch(apiUrl, options);
      const data = await response.json();

      setPrayData(data);
    } catch (error) {
      console.error(error);
    }
  }, [current]);

  const handleEventPreDate = () => {
    let currentMonth = current.month;
    let currentYear = current.year;

    if (currentMonth === 1) {
      currentMonth = 12;
      currentYear--;
    } else {
      currentMonth--;
    }

    setPrayData(() => []);
    setCurrent({ month: currentMonth, year: currentYear });
  };

  const handleEventNextDate = () => {
    let currentMonth = current.month;
    let currentYear = current.year;

    if (currentMonth === 12) {
      currentMonth = 1;
      currentYear++;
    } else {
      currentMonth++;
    }

    setPrayData(() => []);
    setCurrent(() => ({ month: currentMonth, year: currentYear }));
  };

  const onClickDay = (day, month) => {
    console.log('day nè', day, month);
  }

  // SIDE EFFECT
  useEffect(() => {
    _timeRef.current = setTimeout(() => {
      getPrayForUs();
    }, 300);

    return () => {
      clearTimeout(_timeRef.current);
    }
  }, [getPrayForUs, current]);

  // RENDER
  return (
    <div className="App-pray-for-us">
      <div className='App-title'>Xin cầu cho các linh hồn</div>
      <div className='App-desc'>"Chính lúc chết đi là khi vui sống muôn đời."</div>
      <div className='App-date-header'>
        <div className='App-date-info'>
          <div className='App-date-info__year'>{current?.year || 0}</div>
          <div className='App-date-info__month'>{textMonth}</div>
        </div>
        <div className='App-date-control'>
          <button
            className='App-date-control__cta --left'
            onClick={handleEventPreDate}
          >
            <img src={Left_icon} alt=''/>
          </button>
          <button
            className='App-date-control__cta --right'
            onClick={handleEventNextDate}
          >
            <img src={Left_icon} alt=''/>
          </button>
        </div>
      </div>
      <Calendar
        {...current}
        prayData={prayData}
        onClickDay={onClickDay}
      />
    </div>
  );
}

export default App;
