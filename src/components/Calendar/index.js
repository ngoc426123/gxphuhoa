import { useMemo, useState } from "react";

import { weekdays } from "../../constants/date";

// IMAGE
import Unknown_person_img from "../../assets/images/Unknown_person.jpg";

// STYLE
import "./style.css";

export default function Calendar(props) {
  // PROPS
  const { month, year, prayData, onClickDay } = props;

  // STATE
  const [weekday] = useState(weekdays);
  const listdayData = useMemo(() => {
    let findFirstDay = false;
    let countDay = 0;
    const countDate = new Date(year, month - 1, 0).getDate();
    const firstDay = new Date(year, month - 1, 1).getDay();
 
    return Array.from(Array(35).keys()).map(item => {
      if (!findFirstDay) {
        if (item === firstDay ) {
          countDay++;
          findFirstDay = true;
          return { day: countDay };
        } else {
          return {};
        }
      }
      if (countDay <= countDate) {
        countDay++;
        return { day: countDay };
      } else {
        return {};
      }
    });
  }, [month, year]);
  const onCalendarPrayData = useMemo(() => {
    return prayData
      .reduce((cum, cur) => {
        const date = new Date(cur.yearOfDead);
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
  const onTopData = useMemo(() => {
    return listdayData.map(item => {
      const filterCal = onCalendarPrayData.filter(it => it.day === item.day)[0];

      return { ...item, ...filterCal };
    });
  }, [listdayData, onCalendarPrayData]);

  // RENDER
  return (
    <div className="calendar">
      <div className="calendar__weekday">
        {weekday.map((wDay, index) => (
          <div key={index} className="calendar__weekday-day">{wDay}</div>
        ))}
      </div>
      <div className="calendar__days">
        {onTopData && onTopData.map((day, index) => (
          <div
            key={index}
            className={`calendar__day ${day.data ? '--need-pray' : ''}`}
            {...(day.data 
              ? { onClick: () => onClickDay(day.day, month) } 
              : {})
            }
          >
            <span className="calendar__day-name">{day?.day || ''}</span>
            {day.data && (
              <div className="calendar__peace-list">
                {day.data.map(item => (
                  <div key={item.positionID} className="calendar__peace-item">
                    <img src={item.img || Unknown_person_img} alt=""/>
                  </div>
                ))}
              </div>
            )}
          </div>
        ))}
      </div>
    </div>
  )
}