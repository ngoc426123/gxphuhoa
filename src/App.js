import ScreenCalendar from './screen/ScreenCalendar';
import CandleIcon from './components/CandleIcon';
import useSeasonalTheme from './hooks/useSeasonalTheme';

// STYLE
import './App.css';

function App() {
  const { isSoulsMonth } = useSeasonalTheme();

  // RENDER
  return (
    <div className="App-pray-for-us">
      <div className='App-info'>
        {isSoulsMonth && (
          <div className='souls-month-banner'>Tháng Mười Một — Tháng Các Linh Hồn</div>
        )}
        <div className='App-sub-title'>Giáo Xứ Phú Hoà</div>
        <div className='App-title'>Nhà chờ phục sinh</div>
        {isSoulsMonth ? (
          <div className='App-ornament-candles' aria-hidden='true'>
            <CandleIcon />
            <CandleIcon />
            <CandleIcon />
          </div>
        ) : (
          <div className='App-ornament' aria-hidden='true'>
            <CandleIcon />
          </div>
        )}
        <div className='App-desc'>
          {isSoulsMonth
            ? '"Cầu cho các đẳng linh hồn được an nghỉ muôn đời trong Chúa."'
            : '"Chính lúc chết đi là khi vui sống muôn đời."'}
        </div>
      </div>
      <ScreenCalendar />
    </div>
  );
}

export default App;
