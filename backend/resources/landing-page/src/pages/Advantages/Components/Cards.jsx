import React, { useEffect, useState } from 'react'
import AdvantageCard from './AdvantageCard';
import { useTranslation } from "react-i18next";
import Button from '../../../components/Button';
import { RiArrowDownDoubleFill } from 'react-icons/ri';

function Cards() {
    const { t } = useTranslation();
    const [Visible, setVisible] = useState(10);
    const showMoreItems = () => {
        setVisible((prevValue) => prevValue + 5);
    }
    const [isMobile, setIsMobile] = useState(false);

    useEffect(() => {
      const isMobile = window.innerWidth <= 1000;
      setIsMobile(!isMobile);
    }, []);
    const Advantages = [
        { Advantage: `${t("Advantage 1")}` },
        { Advantage: `${t("Advantage 2")}` },
        { Advantage: `${t("Advantage 3")}` },
        { Advantage: `${t("Advantage 4")}` },
        { Advantage: `${t("Advantage 5")}` },
        { Advantage: `${t("Advantage 6")}` },
        { Advantage: `${t("Advantage 7")}` },
        { Advantage: `${t("Advantage 8")}` },
        { Advantage: `${t("Advantage 9")}` },
        { Advantage: `${t("Advantage 10")}` },
        { Advantage: `${t("Advantage 11")}` },
        { Advantage: `${t("Advantage 12")}` },
        { Advantage: `${t("Advantage 13")}` },
        { Advantage: `${t("Advantage 14")}` },
        { Advantage: `${t("Advantage 15")}` },
        { Advantage: `${t("Advantage 16")}` },
        { Advantage: `${t("Advantage 17")}` },
        { Advantage: `${t("Advantage 18")}` },
        { Advantage: `${t("Advantage 19")}` },
        { Advantage: `${t("Advantage 20")}` },
        { Advantage: `${t("Advantage 21")}` },
        { Advantage: `${t("Advantage 22")}` },
        { Advantage: `${t("Advantage 23")}` },
    ];

    return (
        <div className='mx-[160px] max-[1250px]:mx-[20px] max-sm:mx-[0px]'>
            <div
                className="grid max-sm:grid-cols-2 max-sm:gap-x-4  max-sm:mx-0 max-lg:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-10 mx-4 mt-8 mb-[50px]">
                {Advantages.slice(0, Visible).map((advantage, index) => (
                    <div key={index}
                        data-aos='fade-up'
                        data-aos-delay='400' >
                        <AdvantageCard
                            number={index + 1}
                            AdvantageTitle={advantage.Advantage}
                        />
                    </div>
                ))}
            </div>
            {Advantages.slice(0, Visible).length === Advantages.length ?
                <div></div>
                :
                <div
                className="flex flex-col items-center justify-center cta-btn-more"
                data-aos="fade-up"
                data-aos-delay="400"
              >
                <button
                  onClick={showMoreItems}
                  className={`flex gap-5 ${
                    !isMobile ? "w-[100%]" : "w-fit"
                  } justify-center cta-btn font-bold bg-[var(--primary)] rounded-full transition-all delay-100  py-2 px-6 text-[15px] hover:bg-[#d6eb16]`}
                >
                  {t("More")}
                  <RiArrowDownDoubleFill />
                </button>
              </div>
            }
        </div>
    )
}

export default Cards
