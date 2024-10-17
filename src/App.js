import { useState } from 'react';
import Modal from 'react-modal';
import ScreenCalendar from './screen/ScreenCalendar';
import ScreenShelf from './screen/ScreenShelf';

// ICON
import Calendar_icon from "./assets/images/calendar.svg";
import Block_icon from "./assets/images/block.svg";

// STYLE
import './App.css';

Modal.setAppElement('#root-pray-for-us');

function App() {
  // STATE
  const [view, setView] = useState(0); // 0: is block | 1: is calendar

  // RENDER
  return (
    <div className="App-pray-for-us">
      <div className='App-info'>
        <div className='App-sub-title'>Giáo Xứ Phú Hoà</div>
        <div className='App-title'>Nhà chờ phục sinh</div>
        <div className='App-desc'>"Chính lúc chết đi là khi vui sống muôn đời."</div>
        <div className='App-control-view'>
          <button className={view === 0 ? '--active' : '' } onClick={() => setView(0)}>
            <img src={Block_icon} alt=''/>
          </button>
          <button className={view === 1 ? '--active' : '' } onClick={() => setView(1)}>
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
