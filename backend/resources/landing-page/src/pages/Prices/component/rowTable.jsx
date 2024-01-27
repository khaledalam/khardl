import React from 'react';
import { useTranslation } from "react-i18next";

const RowTable = ({ points, price, without }) => {
    const { t } = useTranslation();

    return (
        <div className='w-[100%] content max-md:w-[100%]'>
            <div className='grid grid-cols-2 text-center items-center bg-white py-3'>
                <h1 className='content'>{points} {without ? "" : <>{t("point")}</> }</h1>
                <h1><span className='price'>{price}</span> <span className="small">{t("SAR")}</span></h1>
            </div>
        </div>
    )
}

export default RowTable;