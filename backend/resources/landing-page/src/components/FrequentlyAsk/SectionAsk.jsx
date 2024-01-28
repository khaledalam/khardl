import React from 'react'
import Accordion from './Accordion';

const SectionAsk = ({ data , Visible}) => {
    return (
        <div className="lg:w-[100%]  pt-8 max-sm:pt-2">
            <div className="max-xl:w-[90vw] xl:w-[60vw] pt-2 pb-4 text-center mx-auto section-ask">
                {data.slice(0,Visible).map((faq, index) => (
                    <Accordion 
                    key={index} 
                    first={index === 0}
                    number={index + 1}
                    question={faq.question} 
                    answer={faq.answer} />
                ))} 
                <br />
            </div>
        </div>
    )
}

export default SectionAsk