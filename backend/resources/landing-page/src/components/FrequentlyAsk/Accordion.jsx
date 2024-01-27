import React, { useState } from 'react'
import { BsPlus, BsDash } from "react-icons/bs";

const Accordion = ({ question, answer, number, first }) => {
    const [isOpen, setIsOpen] = useState(first ? true : false);
    return (
        <div className='my-2 item'
            data-aos='zoom-in'
            data-aos-delay='400' >
            <button
                className={`flex flex-col w-full px-8 max-sm:px-4 py-6 ${!isOpen ? "pb-6" : "pb-2" } rounded-[16px] text-[18px] font-medium text-gray-700    focus:outline-none focus-visible:ring focus-visible:ring-gray-500 focus-visible:ring-opacity-50  border-t-1`}
                onClick={() => setIsOpen(!isOpen)}
            >
                <div className='flex justify-between w-[100%]'>
                    <div className='flex items-center justify-start w-[100%]'>
                        <span>{`${number}.`}{"\u00A0"}{"\u00A0"}</span>
                        <div className="text-[18px] text-[#252625] text-right max-sm:text-[15px]">{question}</div>
                    </div>
                    <div className="flex-shrink-0">
                        {!isOpen ? (
                            <BsPlus size={26} className='text-dark' />
                        ) : (
                            <BsDash size={26} className='text-dark' />
                        )}
                    </div>
                </div>
                {isOpen && (
                    <div className="py-4 px-4 text-start text-[16px] text-[#00000090] max-sm:text-[13px]">{answer}</div>
                )}
            </button>
        </div>
    )
}

export default Accordion