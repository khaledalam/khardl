import React from 'react';
import { useTranslation } from "react-i18next";

const Header = ({ headerText }) => {
    const { t } = useTranslation();

    return (
        <div className='w-[60%] max-md:w-[100%]'>
            <h1 className='text-center bg-[var(--third)] py-3 rounded-t-2xl font-bold border-[0.5px] border-gray-300'>
                {headerText}
            </h1>
        </div>
    )
}

export default Header;