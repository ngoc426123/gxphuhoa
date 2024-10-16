import { useMemo, useState } from "react";

import "./style.css";
import { weekdays } from "../../constants/date";

export default function Calendar(props) {
  // PROPS
  const { month, year } = props;

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

  // RENDER
  return (
    <div className="calendar">
      <div className="calendar__weekday">
        {weekday.map((wDay, index) => (
          <div key={index} className="calendar__weekday-day">{wDay}</div>
        ))}
      </div>
      <div className="calendar__days">
        {listdayData && listdayData.map((day, index) => (
          <div className="calendar__day">
            <span className="calendar__day-name">{day?.day || ''}</span>
          </div>
        ))}
      </div>
    </div>
  )
}