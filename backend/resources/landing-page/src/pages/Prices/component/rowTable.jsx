import React from 'react';
import { useTranslation } from "react-i18next";

const RowTable = ({ points, price, without }) => {
    const { t } = useTranslation();

    return (
        <>
        <div className='w-[100%] content max-md:w-[100%]'>
            <div className='text-center items-center  py-3'>
                {/* <h1 className='content'>{points} {without ? "" : <>{t("point")}</> }</h1> */}
                <h1> <span className="small">{t("SAR")}</span><span className='price' >388</span><span className="small">/Branch</span><span className="text-[#C0D123] ms-2 hover:text-[#C0D123]">* Yearly</span></h1>
            </div>
        </div>
        <div className='w-[100%] content max-md:w-[100%]'>
        <div className='text-center items-center  py-3'>
            {/* <h1 className='content'>{points} {without ? "" : <>{t("point")}</> }</h1> */}
            <h1> <span className="small">{t("SAR")}</span><span className='price'>0,75</span><span className="small">/Order</span><span className="text-[#C0D123]  hover:text-[#C0D123] ms-2">* Flat</span></h1>
        </div>
    </div>
    </>
    )
}

export default RowTable;