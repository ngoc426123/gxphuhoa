import './App.css';
import ViewCalendar from './screen/ViewCalendar';

function App() {
  // RENDER
  return (
    <div className="App-pray-for-us">
      <div className='App-title'>Xin cầu cho các linh hồn</div>
      <div className='App-desc'>"Chính lúc chết đi là khi vui sống muôn đời."</div>
      <ViewCalendar />
    </div>
  );
}

export default App;
