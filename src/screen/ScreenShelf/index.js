import { useEffect, useRef, useState } from "react";
import Modal from 'react-modal';
import PraySlider from '../../components/PraySlider';

// IMAGE
import Unknown_person_img from "../../assets/images/Unknown_person.jpg";
import Close_icon from '../../assets/images/close.svg';

// STYLE
import "./style.css";

export default function ScreenShelf() {
  const _shelf = useRef(null);

  // STATE
  const [shelfSize] = useState([
    {
      shelfName: 'A',
      desc: '(kệ sát tường bên trái)',
      row: 12,
      number: 10,
    },
    {
      shelfName: 'B',
      desc: '(kệ chính diện)',
      row: 12,
      number: 25,
    },
    {
      shelfName: 'C',
      desc: '(kệ sát tường bên phải)',
      row: 12,
      number: 10,
    },
  ]);
  const [prayData, setPrayData] = useState([]);
  const [openModal, setOpenModal] = useState(false);
  const [praySliderData, setPraySliderData] = useState([]);

  // METHOD
  const getPrayForUs = async () => {
    try {
      const apiUrl = process.env.REACT_APP_API + '/getall';
      const options = {
        method: 'GET'
      }
      const response = await fetch(apiUrl, options);
      const data = await response.json();

      setPrayData(data);
    } catch (error) {
      console.error(error);
    }
  }

  const onClickPray = (positionID) => {
    setPraySliderData(() => prayData.filter(item => item.positionID === positionID));
    setOpenModal(true);
  }

  const handleEventClosePopup = () => {
    setOpenModal(false);
    setPraySliderData([])
  };

  // SIDE EFFECT
  useEffect(() => {
    getPrayForUs();
    const $ele = _shelf.current;

    if (!$ele) return;

    const width = $ele.clientWidth;
    const scrollWidth = $ele.scrollWidth;
    const defaultScroll = (scrollWidth - width) / 2;

    $ele.scroll({ left: defaultScroll })
  }, []);

  // RENDER
  return (
    <>
      <div className="screen-shelf" ref={_shelf}>
        {shelfSize.map((shelf) => (
          <div key={shelf.shelfName} className="screen-shelf__shelf">
            <div className="screen-shelf__shelf-head">
              <div className="screen-shelf__shelf-title">Kệ {shelf.shelfName}</div>
              <div className="screen-shelf__shelf-sub-title">{shelf.desc}</div>
            </div>
            <div className="screen-shelf__shelf-body">
              {[...Array(shelf.row)].map((_, rowIndex) => (
                <div key={`row-${rowIndex}`} className="screen-shelf__shelf-row">
                  {[...Array(shelf.number)].map((_, numberIndex) => {
                    const findPray = prayData.filter(pray => 
                      pray.shelf === shelf.shelfName && +pray.row === (rowIndex + 1) && +pray.number === (numberIndex + 1)
                    )[0];

                    return (
                      <div
                        key={`number-${numberIndex}`}
                        className="screen-shelf__shelf-cell"
                        data-position={`${rowIndex + 1}|${numberIndex + 1}`}
                        {...(findPray 
                          ? { onClick: () => onClickPray(findPray.positionID) } 
                          : {})
                        }
                      >
                        {findPray && <img src={findPray.img || Unknown_person_img} alt=""/>}
                      </div>
                    )
                  })}
                </div>
              ))}
            </div>
          </div>
        ))}
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
  )
}