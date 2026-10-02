import { useState } from 'react';
import ScreenCalendar from './screen/ScreenCalendar';
import ScreenShelf from './screen/ScreenShelf';

// ICON
import Calendar_icon from "./assets/images/calendar.svg";
import Block_icon from "./assets/images/block.svg";

// STYLE
import './App.css';

function App() {
  // STATE
  const [view, setView] = useState(0); // 0: is block | 1: is calendar

  // RENDER
  return (
    <div className="App-pray-for-us">
      <div className='App-info'>
        <div className='App-sub-title'>Giáo Xứ Phú Hoà</div>
        <div className='App-title'>Nhà chờ phục sinh</div>
        <div className='App-ornament' aria-hidden='true'>
          <svg viewBox='0 0 20 28' width='14' height='20'>
            <path d='M8 0h4v8h8v4h-8v16H8V12H0V8h8z' fill='currentColor'/>
          </svg>
        </div>
        <div className='App-desc'>"Chính lúc chết đi là khi vui sống muôn đời."</div>
        <div className='App-control-view'>
          <button className={view === 0 ? '--active' : '' } onClick={() => setView(0)} aria-label='Xem theo kệ'>
            <img src={Block_icon} alt=''/>
          </button>
          <button className={view === 1 ? '--active' : '' } onClick={() => setView(1)} aria-label='Xem theo lịch'>
            <img src={Calendar_icon} alt=''/>
          </button>
        </div>
      </div>
      {view === 1
        ? <ScreenCalendar />
        : <ScreenShelf />
      }
      
    </div>
  );
}

export default App;
