import React from 'react';

const TextWithLine = ({ text, classNameLine, className }) => {
  return (
    <div className="relative">
      <span className={`absolute w-full h-3 rounded-full bg-[var(--primary)] top-[38px] max-[1000px]:top-[28px] max-[500px]:top-[22px] transform -translate-y-1/2 z-0 ${classNameLine}`}></span>
      <span className={`relative z-10 text-black px-2 text-[40px] max-[1000px]:text-[30px] max-[500px]:text-[26px] ${className}`}>
        {text}
      </span>
    </div>
  );
};

export default TextWithLine;