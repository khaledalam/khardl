import React from 'react';
import { useTranslation } from "react-i18next";
import { FaChevronRight, FaStarOfLife } from 'react-icons/fa';

const Footer = ({ FooterText }) => {
    const { t } = useTranslation();

    return (
        <div className='w-[100%] max-md:w-[100%] text-center flex justify-around mt-10'>
            <button className='cta-btn p-[10px] flex px-[30px]'>Get Started <FaChevronRight/></button>
            {/* <div className="flex justify-center items-center gap-2 text-start bg-[var(--primary)] py-3 rounded-b-2xl font-bold border-[0.5px] border-gray-300">
                <FaStarOfLife size={10} className="text-red-500" />
                <h1>
                    {FooterText}
                </h1>
            </div> */}
        </div>
    )
}

export default Footer;