import ScreenToday from './screen/ScreenToday';

// STYLE
import './App.css';

function AppToday() {
  // RENDER
  return (
    <div className="App-pray-for-us">
      <div className='App-info'>
        <div className='App-sub-title'>Giáo Xứ Phú Hoà</div>
        <div className='App-title'>Hôm nay cầu nguyện cho</div>
        <div className='App-ornament' aria-hidden='true'>
          <svg viewBox='0 0 20 28' width='14' height='20'>
            <path d='M8 0h4v8h8v4h-8v16H8V12H0V8h8z' fill='currentColor'/>
          </svg>
        </div>
        <div className='App-desc'>"Chính lúc chết đi là khi vui sống muôn đời."</div>
      </div>
      <ScreenToday />
    </div>
  );
}

export default AppToday;
