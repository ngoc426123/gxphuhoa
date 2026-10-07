import ScreenToday from './screen/ScreenToday';
import ScreenSoulsMonth from './screen/ScreenSoulsMonth';
import CandleIcon from './components/CandleIcon';
import useSeasonalTheme from './hooks/useSeasonalTheme';

// STYLE
import './App.css';

function AppToday() {
  const { isSoulsMonth } = useSeasonalTheme();

  // RENDER
  if (isSoulsMonth) {
    return (
      <div className='App-pray-for-us App-pray-for-us--today --souls'>
        <ScreenSoulsMonth />
      </div>
    );
  }

  return (
    <div className='App-pray-for-us App-pray-for-us--today'>
      <div className='App-info'>
        <div className='App-sub-title'>Giáo Xứ Phú Hòa</div>
        <div className='App-title'>Hôm nay cùng nhau cầu nguyện</div>
        <div className='App-desc'>"Chính lúc chết đi là khi vui sống muôn đời."</div>
        <div className='App-ornament' aria-hidden='true'>
          <CandleIcon />
        </div>
        <div className='App-section-title'>Thắp nến cầu nguyện</div>
        <div className='App-section-sub'>Hôm nay bạn muốn cầu nguyện cho ai?</div>
      </div>
      <ScreenToday />
    </div>
  );
}

export default AppToday;
