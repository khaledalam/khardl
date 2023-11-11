import React from 'react';
import { useTranslation } from "react-i18next";

const RowTable = ({ points, price, without }) => {
    const { t } = useTranslation();

    return (
        <div className='w-[60%] max-md:w-[100%]'>
            <div className='grid grid-cols-2 text-center items-center bg-white py-3 border-[0.5px] border-gray-300 border-t-0'>
                <h1>{points} {without ? "" : <>{t("point")}</> }</h1>
                <h1>{price} {t("SAR")}</h1>
            </div>
        </div>
    )
}

export default RowTable;