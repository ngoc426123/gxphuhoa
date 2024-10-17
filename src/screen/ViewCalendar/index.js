import { useCallback, useEffect, useMemo, useRef, useState } from 'react';
import Calendar from '../../components/Calendar';
import { months } from '../../constants/date';
import Modal from 'react-modal';
import PraySlider from '../../components/PraySlider';

// ICON
import Left_icon from '../../assets/images/angle-left.svg';
import Close_icon from '../../assets/images/close.svg';

// STYLE
import './style.css';

function ViewCalendar() {
  const _timeRef = useRef();

  // STATE
  const [current, setCurrent] = useState({ month: 10, year: 2024 });
  const [prayData, setPrayData] = useState([]);
  const [praySliderData, setPraySliderData] = useState([]);
  const [openModal, setOpenModal] = useState(false);
  const textMonth = useMemo(() => {
    return months[current.month - 1];
  }, [current.month]);
  const calendarPrayData = useMemo(() => {
    return prayData
      .reduce((cum, cur) => {
        const date = new Date(cur.yearOfDead);
        const day = date.getDate();
        const hasDay = cum.some(item => item.day === day);
        const yearOfDeadFormat = date.toLocaleDateString('vi-VN');
        const curFormatDate = { ...cur, yearOfDeadFormat };

        if (hasDay) {
          const shipIndex = cum.findIndex(item => item.day === day);
          const shipFilter = cum.filter(item => item.day === day)[0];
          const shipData = shipFilter.data;

          shipData.push(curFormatDate);

          cum[shipIndex] = { ...cum[shipIndex], data: shipData };
        } else {
          cum.push({ day, data: [curFormatDate] });
        }

        return cum;
      }, [])
      .sort((a, b) => a.day - b.day);
  }, [prayData]);

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

  const onClickDay = (day) => {
    setPraySliderData(() => {
      const { data } = calendarPrayData.filter(item => item.day === day)[0];

      return data;
    });
    setOpenModal(true);
  };

  const handleEventClosePopup = () => {
    setOpenModal(false);
    setPraySliderData([])
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

  // RENDER
  return (
    <>
      <div className="screen-calendar">
        <div className='screen-calendar__header'>
          <div className='screen-calendar__info'>
            <div className='screen-calendar__info-year'>{current?.year || 0}</div>
            <div className='screen-calendar__info-month'>{textMonth}</div>
          </div>
          <div className='screen-calendar__control'>
            <button
              className='screen-calendar__control-cta --left'
              onClick={handleEventPreDate}
            >
              <img src={Left_icon} alt=''/>
            </button>
            <button
              className='screen-calendar__control-cta --right'
              onClick={handleEventNextDate}
            >
              <img src={Left_icon} alt=''/>
            </button>
          </div>
        </div>
        <Calendar
          {...current}
          prayData={calendarPrayData}
          onClickDay={onClickDay}
        />
      </div>
      <Modal
        isOpen={openModal}
        className='houdini-modal'
        overlayClassName='houdini-modal-overlay'
      >
        <button className='houdini-modal-close' onClick={handleEventClosePopup}>
          <img src={Close_icon} alt=''/>
        </button>
        <PraySlider data={praySliderData} />
      </Modal>
    </>
  );
}

export default ViewCalendar;
