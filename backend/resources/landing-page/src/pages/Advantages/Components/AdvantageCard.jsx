import React, { useState } from "react";

const AdvantageCard = ({ number, AdvantageTitle }) => {
  const [, setIsHover] = useState(false);

  const handleMouseEnter = () => {
    setIsHover(true);
  };
  const handleMouseLeave = () => {
    setIsHover(false);
  };

  return (
    <div
      onMouseEnter={handleMouseEnter}
      onMouseLeave={handleMouseLeave}
      className={`new-advantage-card relative h-[150px] max-sm:h-[170px] bg-[var(--third)] rounded-lg my-1 px-4 py-8 max-[600px]:py-12 shadow-md hover:translate-y-2 ease-in duration-200 flex flex-col items-center justify-center`}
    >
      <div
        className={`absolute  font-bold flex items-center justify-center w-12 h-12 rounded-full max-[640px]:right-[37%] max-[640px]:top-[-22px]  top-[-15px] -left-1 `}
      >
        {number <= 9 ? <div>0{number}</div> : <div>{number}</div>}
      </div>
      <div className="text-center flex flex-col items-center justify-center gap-3 ">
        <h2 className="font-bold max-sm:text-[13px]">{AdvantageTitle}</h2>
      </div>
    </div>
  );
};

export default AdvantageCard;
