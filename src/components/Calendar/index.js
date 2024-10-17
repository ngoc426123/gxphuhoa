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
  const onTopData = useMemo(() => {
    return listdayData.map(item => {
      const filterCal = prayData.filter(it => it.day === item.day)[0];

      return { ...item, ...filterCal };
    });
  }, [listdayData, prayData]);

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
            className={`calendar__day ${day.data ? '--need-pray' : ''} ${!day.day ? '--blank' : ''}`}
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