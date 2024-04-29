import React, { useState } from "react";
import { BsChevronDown } from "react-icons/bs";

const Accordion = ({ header, details }) => {
  const [isOpen, setIsOpen] = useState(false);

  return (
    <div className="pt-4">
      <button
        className="flex items-start justify-between w-full font-medium focus:outline-none focus-visible:ring focus-visible:ring-gray-500 focus-visible:ring-opacity-50  border-t-1"
        onClick={() => setIsOpen(!isOpen)}
      >
        <div className="mx-4 flex justify-between w-full items-center gap-4">
          {header}
          <span className="flex-shrink-0">
            {isOpen ? (
              <BsChevronDown className="h-5 w-5 font-bold rotate-180" />
            ) : (
              <BsChevronDown className="h-5 w-5 font-bold" />
            )}
          </span>
        </div>
      </button>
      {isOpen && (
        <p className="mx-4 mb-4 text-base font-normal max-[450px]:text-[15px] w-[85%]">
          {details}
        </p>
      )}
    </div>
  );
};

export default Accordion;
