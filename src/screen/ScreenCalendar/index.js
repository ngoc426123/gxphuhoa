import { useCallback, useEffect, useMemo, useRef, useState } from 'react';
import gsap from 'gsap';
import Calendar from '../../components/Calendar';
import { months } from '../../constants/date';
import Modal from 'react-modal';
import PraySlider from '../../components/PraySlider';

// ICON
import Left_icon from '../../assets/images/angle-left.svg';
import Close_icon from '../../assets/images/close.svg';

// STYLE
import './style.css';

export default function ScreenCalendar() {
  const _timeRef = useRef();
  const _gridRef = useRef(null);
  // Trạng thái chuyển tháng: pendingDir (hướng đang chạy) / leaveDone / dataReady / target (tháng-năm đích)
  const _transition = useRef({ pendingDir: null, leaveDone: true, dataReady: true, target: null });
  const now = new Date();

  // STATE
  const [current, setCurrent] = useState({ month: now.getMonth() + 1, year: now.getFullYear() });
  // displayCurrent: tháng/năm thực sự đang render ra Calendar, chỉ đổi khi data mới đã sẵn sàng + animation thoát đã xong
  const [displayCurrent, setDisplayCurrent] = useState(current);
  const [prayData, setPrayData] = useState([]);
  const [praySliderData, setPraySliderData] = useState([]);
  const [selectedDate, setSelectedDate] = useState(null);
  const [openModal, setOpenModal] = useState(false);
  const textMonth = useMemo(() => {
    return months[displayCurrent.month - 1];
  }, [displayCurrent.month]);
  const calendarPrayData = useMemo(() => {
    return prayData
      .reduce((cum, cur) => {
        const date = new Date(cur.yearOfDead.replace(' ', 'T')); // 'YYYY-MM-DD HH:mm:ss' có dấu cách → Safari trả Invalid Date
        const day = date.getDate();
        const hasDay = cum.some(item => item.day === day);

        if (hasDay) {
          const shipIndex = cum.findIndex(item => item.day === day);
          const shipFilter = cum.filter(item => item.day === day)[0];
          const shipData = shipFilter.data;

          shipData.push(cur);

          cum[shipIndex] = { ...cum[shipIndex], data: shipData };
        } else {
          cum.push({ day, data: [cur] });
        }

        return cum;
      }, [])
      .sort((a, b) => a.day - b.day);
  }, [prayData]);

  // METHOD: hoàn tất chuyển tháng khi cả animation thoát lẫn data mới đều đã sẵn sàng
  const tryCommit = useCallback(() => {
    const t = _transition.current;

    if (!t.pendingDir || !t.leaveDone || !t.dataReady) return;

    const dir = t.pendingDir;
    const target = t.target;

    _transition.current = { pendingDir: null, leaveDone: true, dataReady: true, target: null };

    setDisplayCurrent(target);

    const el = _gridRef.current;

    if (el) {
      gsap.set(el, { x: dir === 'next' ? 30 : -30 });
      gsap.to(el, { autoAlpha: 1, x: 0, duration: 0.32, ease: 'power2.out' });
    }
  }, []);

  const animateOut = useCallback((dir) => {
    const el = _gridRef.current;

    if (!el) {
      _transition.current.leaveDone = true;
      tryCommit();
      return;
    }

    gsap.to(el, {
      autoAlpha: 0,
      x: dir === 'next' ? -30 : 30,
      duration: 0.28,
      ease: 'power1.in',
      onComplete: () => {
        _transition.current.leaveDone = true;
        tryCommit();
      },
    });
  }, [tryCommit]);

  const startTransition = useCallback((dir, nextMonth, nextYear) => {
    if (_transition.current.pendingDir) return; // đang chuyển dở thì bỏ qua click mới

    _transition.current = { pendingDir: dir, leaveDone: false, dataReady: false, target: { month: nextMonth, year: nextYear } };
    setCurrent({ month: nextMonth, year: nextYear });
    animateOut(dir);
  }, [animateOut]);

  const getPrayForUs = useCallback(async () => {
    try {
      const { month } = current;
      const apiUrl = (window.PRAY_FOR_US?.api || process.env.REACT_APP_API) + '/' + month;
      const options = {
        method: 'GET'
      }
      const response = await fetch(apiUrl, options);
      const data = await response.json();

      setPrayData(data);
    } catch (error) {
      console.error(error);
    } finally {
      _transition.current.dataReady = true;
      tryCommit();
    }
  }, [current, tryCommit]);

  const handleEventPreDate = () => {
    let currentMonth = current.month;
    let currentYear = current.year;

    if (currentMonth === 1) {
      currentMonth = 12;
      currentYear--;
    } else {
      currentMonth--;
    }

    startTransition('prev', currentMonth, currentYear);
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

    startTransition('next', currentMonth, currentYear);
  };

  const onClickDay = (day, month) => {
    setPraySliderData(() => {
      const { data } = calendarPrayData.filter(item => item.day === day)[0];

      return data;
    });
    setSelectedDate({ day, month, year: displayCurrent.year });
    setOpenModal(true);
  };

  const handleEventClosePopup = () => {
    setOpenModal(false);
    setPraySliderData([]);
    setSelectedDate(null);
  };

  // SIDE EFFECT
  useEffect(() => {
    _timeRef.current = setTimeout(() => {
      getPrayForUs();
    }, 300);

    return () => {
      clearTimeout(_timeRef.current);
    }
  }, [getPrayForUs, current]);

  useEffect(() => {
    const el = _gridRef.current;

    return () => {
      if (el) gsap.killTweensOf(el);
    };
  }, []);

  // RENDER
  return (
    <>
      <div className="screen-calendar">
        <div className='screen-calendar__header'>
          <div className='screen-calendar__info'>
            <div className='screen-calendar__info-year'>{displayCurrent?.year || 0}</div>
            <div className='screen-calendar__info-month'>{textMonth}</div>
          </div>
          <div className='screen-calendar__control'>
            <button
              className='screen-calendar__control-cta --left'
              onClick={handleEventPreDate}
              aria-label='Tháng trước'
            >
              <img src={Left_icon} alt=''/>
            </button>
            <button
              className='screen-calendar__control-cta --right'
              onClick={handleEventNextDate}
              aria-label='Tháng sau'
            >
              <img src={Left_icon} alt=''/>
            </button>
          </div>
        </div>
        <div className='screen-calendar__grid' ref={_gridRef}>
          <Calendar
            {...displayCurrent}
            prayData={calendarPrayData}
            onClickDay={onClickDay}
          />
        </div>
      </div>
      <Modal
        isOpen={openModal}
        className='houdini-modal'
        overlayClassName='houdini-modal-overlay'
      >
        <button className='houdini-modal-close' onClick={handleEventClosePopup}>
          <img src={Close_icon} alt=''/>
        </button>
        <PraySlider data={praySliderData} date={selectedDate} />
      </Modal>
    </>
  );
}
