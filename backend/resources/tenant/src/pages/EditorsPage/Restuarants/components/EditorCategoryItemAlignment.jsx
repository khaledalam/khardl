import React, { useEffect, useState } from "react";
import AlignLeft from "../../../../assets/alignLeft.png";
import AlignCenter from "../../../../assets/alignCenter.png";
import AlignRight from "../../../../assets/alignRight.png";
import { cn } from "../../../../utils/styles";
import { useTranslation } from "react-i18next";

const EditorCategoryItemAlignment = ({ defaultValue, onChange, modalId }) => {
  const [activeAlign, setActiveAlign] = useState(defaultValue);
  const { t } = useTranslation();

  const alignments = [
    {
      position: "left",
      icon: (
        <div className="flex flex-row justify-between items-center gap-2">
          <div className="w-3 h-3 border-2 border-gray-900 rounded-full"></div>
          text
        </div>
      ),
    },
    {
      position: "center",
      icon: (
        <div className="flex flex-col justify-between items-center gap-1">
          <div className="w-3 h-3 border-2 border-gray-900 rounded-full"></div>
          text
        </div>
      ),
    },
    {
      position: "none",
      icon: <div>text</div>,
    },
  ];

  useEffect(() => {
    setActiveAlign(defaultValue);
  }, [defaultValue]);

  // const handleActiveAlign = useCallback((position) => {
  //     setActiveAlign(position);
  //     onChange(position);
  // }, []);
  return (
    <div
      className={`flex flex-col items-start w-[208px] xl:w-full justify-between`}
    >
      <label className="text-[12px] xl:text-[16px] py-[8px] text-[rgba(17,24,39,0.54)] leading-[16px] font-medium ">
        {t("Layout")}
      </label>
      <div
        className={`flex items-center justify-around w-[208px] xl:w-full h-[80px] bg-[#F3F3F3] rounded-[50px] py-[2px] px-[6px] text-xs`}
      >
        {alignments.map((alignment, idx) => (
          <div
            className={cn("cursor-pointer flex justify-center items-center rounded-3xl py-1 px-2 min-w-[60px] min-h-[30px]", {
              "bg-white": alignment.position === activeAlign,
            })}
            key={idx}
            onClick={() => {
              onChange(alignment.position);
            }}x
          >
            {alignment.icon}
          </div>
        ))}
      </div>
    </div>
  );
};

export default EditorCategoryItemAlignment;
