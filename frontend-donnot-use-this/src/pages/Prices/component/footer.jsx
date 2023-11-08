import React from 'react';
import { useTranslation } from "react-i18next";
import { FaStarOfLife } from 'react-icons/fa';

const Footer = ({ FooterText }) => {
    const { t } = useTranslation();

    return (
        <div className='w-[60%] max-md:w-[100%]'>
            <div className="flex justify-center items-center gap-2 text-start bg-[var(--primary)] py-3 rounded-b-2xl font-bold border-[0.5px] border-gray-300">
                <FaStarOfLife size={10} className="text-red-500" />
                <h1>
                    {FooterText}
                </h1>
            </div>
        </div>
    )
}

export default Footer;