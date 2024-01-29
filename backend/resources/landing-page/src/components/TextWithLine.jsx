import React from 'react';

const TextWithLine = ({ text, classNameLine, className }) => {
  return (
    <div className="relative">
      {/* <span className={`absolute w-full h-3 rounded-full bg-[var(--primary)] top-[38px] max-[1000px]:top-[28px] max-[500px]:top-[22px] transform -translate-y-1/2 z-0 ${classNameLine}`}></span> */}
      <svg className={`-translate-y-1/2 absolute top-[26px] left-[-20px] transform`} xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
        <circle cx="30" cy="30" r="29.5" stroke="#C0D123" stroke-dasharray="2 2" />
      </svg>
      <span className={`relative z-10 text-black px-2 text-[40px] max-[1000px]:text-[30px] max-[500px]:text-[26px] ${className}`}>
        {text}
      </span>
    </div>
  );
};

export default TextWithLine;