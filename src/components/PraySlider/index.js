// COMPONENT
import PersonList from '../PersonList';

// STYLE
import "./style.css";

const pad2 = (value) => String(value).padStart(2, '0');

export default function PraySlider(props) {
  // PROPS
  const { data, date } = props;
  const formattedDate = date ? `${pad2(date.day)}/${pad2(date.month)}/${date.year}` : '';

  // RENDER
  return (
    <div className='pray-slider'>
      <div className='pray-slider__head'>
        {formattedDate && <div className='pray-slider__date'>Ngày {formattedDate}</div>}
        <div className='pray-slider__title'>Cầu cho các linh hồn trong ngày này</div>
        <div className='pray-slider__desc'>Đọc 1 kinh lạy Cha + 1 kinh tin kính … tùy lòng mỗi người.</div>
      </div>
      <PersonList data={data} />
    </div>
  );
}
