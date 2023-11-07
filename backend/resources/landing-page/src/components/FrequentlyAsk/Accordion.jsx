import React, { useState } from 'react'
import { BsPlus, BsDash } from "react-icons/bs";

const Accordion = ({ question, answer, number, first }) => {
    const [isOpen, setIsOpen] = useState(first ? true : false);
    return (
        <div className='my-8'>
            <button
                className="flex flex-col w-full px-8 py-6 rounded-[16px] text-[18px] font-medium text-gray-700 bg-[var(--third)]  hover:bg-gray-100 focus:outline-none focus-visible:ring focus-visible:ring-gray-500 focus-visible:ring-opacity-50  border-t-1"
                onClick={() => setIsOpen(!isOpen)}
            >
                <div className='flex justify-between w-[100%]'>
                    <div className='flex items-center justify-start w-[100%]'>
                        <span>{`${number}.`}{"\u00A0"}{"\u00A0"}</span>
                        <div className="text-[18px] text-[#252625] text-right max-sm:text-lg">{question}</div>
                    </div>
                    <div className="flex-shrink-0">
                        {!isOpen ? (
                            <BsPlus size={26} className='text-[var(--primary)]' />
                        ) : (
                            <BsDash size={26} className='text-[var(--primary)]' />
                        )}
                    </div>
                </div>
                {isOpen && (
                    <div className="py-4 text-start text-[16px] text-[#00000090] max-sm:text-[15px]">{answer}</div>
                )}
            </button>
        </div>
    )
}

export default Accordion