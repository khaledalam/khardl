import React from "react";
import { useSelector } from "react-redux";
import Percentage from "../../../../assets/percentage.png";

const EditorPercentageInput = ({
  label,
  percentage,
  handlePercentageChange,
  defaultPercentage,
}) => {
  const Language = useSelector((state) => state.languageMode.languageMode);

  return (
    <div
      className={`flex flex-row items-center w-[208px] xl:w-full justify-between`}
    >
      {label && (
        <label className="text-[12px] xl:text-[16px] w-[81px] text-[rgba(17,24,39,0.54)] leading-[16px] font-medium ">
          {label}
        </label>
      )}
      <div
        className={`h-[32px] w-[111px] rounded-[50px] bg-[#F3F3F3] flex flex-row justify-between ${
          Language == "ar" ? "pl-[2px] pr-[16px]" : "pr-[2px] pl-[16px]"
        }`}
      >
        <div className="w-[50px]">
          <input
            type="text"
            className="w-full h-full bg-[#F3F3F3] text-[12px] xl:text-[16px] leading-[16px] font-light focus:outline-none"
            value={percentage}
            onChange={(e) => handlePercentageChange(e.target.value)}
          />
        </div>
        <div className="bg-white rounded-[50px] flex justify-center items-center my-[2px]">
          <img
            src={Percentage}
            width={16}
            height={16}
            alt="percentage icon"
            className="m-[6px]"
          />
        </div>
      </div>
    </div>
  );
};

export default EditorPercentageInput;
