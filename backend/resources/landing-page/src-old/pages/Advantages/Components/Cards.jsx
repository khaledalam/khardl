import React, { useState } from 'react'
import AdvantageCard from './AdvantageCard';
import { useTranslation } from "react-i18next";
import Button from '../../../components/Button';

function Cards() {
    const { t } = useTranslation();
    const [Visible, setVisible] = useState(10);
    const showMoreItems = () => {
        setVisible((prevValue) => prevValue + 5);
    }
    const Advanages = [
        { Advanage: `${t("Advanage 1")}` },
        { Advanage: `${t("Advanage 2")}` },
        { Advanage: `${t("Advanage 3")}` },
        { Advanage: `${t("Advanage 4")}` },
        { Advanage: `${t("Advanage 5")}` },
        { Advanage: `${t("Advanage 6")}` },
        { Advanage: `${t("Advanage 7")}` },
        { Advanage: `${t("Advanage 8")}` },
        { Advanage: `${t("Advanage 9")}` },
        { Advanage: `${t("Advanage 10")}` },
        { Advanage: `${t("Advanage 11")}` },
        { Advanage: `${t("Advanage 12")}` },
        { Advanage: `${t("Advanage 13")}` },
        { Advanage: `${t("Advanage 14")}` },
        { Advanage: `${t("Advanage 15")}` },
        { Advanage: `${t("Advanage 16")}` },
        { Advanage: `${t("Advanage 17")}` },
        { Advanage: `${t("Advanage 18")}` },
        { Advanage: `${t("Advanage 19")}` },
        { Advanage: `${t("Advanage 20")}` },
        { Advanage: `${t("Advanage 21")}` },
        { Advanage: `${t("Advanage 22")}` },
        { Advanage: `${t("Advanage 23")}` },
    ];

    return (
        <div className='mx-[160px] max-[1250px]:mx-[20px]'>
            <div className="grid max-sm:grid-cols-1 max-lg:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-10 mx-4 mt-8 mb-[50px]">
                {Advanages.slice(0, Visible).map((advanage, index) => (
                    <div key={index}>
                        <AdvantageCard
                            number={index + 1}
                            AdvanageTitle={advanage.Advanage}
                        />
                    </div>
                ))}
            </div>
            {Advanages.slice(0, Visible).length === Advanages.length ?
                <div></div>
                :
                <div className="flex flex-col items-center justify-center">
                    <Button
                        title={t("More")}
                        classContainer="!border-none !px-12"
                        onClick={showMoreItems}
                    />
                </div>
            }
        </div>
    )
}

export default Cards
