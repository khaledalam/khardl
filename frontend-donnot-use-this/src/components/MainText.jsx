import React from "react";
import TextWithLine from "./TextWithLine";

const MainText = ({ Title, SubTitle, classTitle, classSubTitle }) => {
  return (
    <div className="flex flex-col items-center">
      {Title ?
        <h2 className={`font-semibold text-[25px] max-[600px]:text-[22px] mb-2 `}>
          <TextWithLine text={Title} classNameLine={`!w-[75px] !h-[12px] ${classTitle}`} className={`${classTitle}`} />
        </h2>
        :
        <></>
      }
      <h2 className={`text-center leading-7 max-md:px-6 text-[20px] max-w-[650px] max-[600px]:text-[16px] mb-2 ${classSubTitle} !font-normal`}>
        {SubTitle}
      </h2>
    </div> 
  );
};

export default MainText;
