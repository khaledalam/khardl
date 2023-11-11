import React, { useState } from 'react';
import Shape from './Sidebar/Shape';
import { useTranslation } from "react-i18next";
import { MdKeyboardArrowDown } from 'react-icons/md';

function Dropdown({ title, options, selectedValue, onSelect }) {
    const [isOpen, setIsOpen] = useState(false);
    const { t } = useTranslation();

    return (
        <div>
            <div className={`p-4 py-2 ${isOpen ? "pb-0" : ""}`}>
                <Shape
                    component={
                        <div className={`flex justify-between items-center gap-2 p-0`}>
                            <div className='text-[16px] font-semibold'>{title}</div>
                            <span className="flex-shrink-0">
                                {isOpen ? (
                                    <MdKeyboardArrowDown size={20} className="font-bold rotate-180" />
                                ) : (
                                    <MdKeyboardArrowDown size={20} className="font-bold" />
                                )}
                            </span>
                        </div>
                    }
                    contentClassName="p-2 px-4 w-[100%]"
                    onClick={() => setIsOpen(!isOpen)}
                />
            </div>
            {isOpen && (
                <div className='px-4 py-2'>
                    <div className='text-[16px] font-semibold bg-white text-black rounded-xl ring-1 ring-[var(--third)] cursor-pointer w-[100%]'>
                    {options.map((option) => (
                        <div
                            key={option}
                            onClick={() => {
                                onSelect(option); 
                            }}
                            className={`py-1 px-4 ${option === selectedValue ? "bg-[var(--primary)] text-white" : ""}
                            ${option === `${t("Tabs")}` || option === `${t("Slider")}` ? "rounded-t-xl" : "" }
                            ${option === `${t("Left")}` || option === `${t("One Photo")}` ? "rounded-b-xl" : "" }
                            `}
                        >
                            {option}
                        </div>
                    ))}
                    </div>
                </div>
            )}
        </div>
    )
}

export default Dropdown;
