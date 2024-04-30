import React, { useEffect, useState } from "react";
import AlignLeft from "../../../../assets/alignLeft.png";
import AlignCenter from "../../../../assets/alignCenter.png";
import { cn } from "../../../../utils/styles";

const EditorPosition = ({ defaultValue, onChange, modalId }) => {
  const [activeAlign, setActiveAlign] = useState(defaultValue);

  const alignments = [
    {
      position: "left",
      icon: (
        <img src={AlignLeft} width={12} height={12} alt="align left icon" />
      ),
    },
    {
      position: "center",
      icon: (
        <img src={AlignCenter} width={12} height={12} alt="align center icon" />
      ),
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
    <div id={modalId} className={""}>
      <div
        className={`flex items-center justify-between w-[208px] xl:w-full h-[40px] bg-[#F3F3F3] rounded-[50px] py-[4px] px-[12px]`}
      >
        {alignments.map((alignment, idx) => (
          <div
            className={cn("cursor-pointer rounded-full py-2.5 px-6", {
              "bg-white": alignment.position === activeAlign,
            })}
            key={idx}
            onClick={() => {
              onChange(alignment.position);
            }}
          >
            {alignment.icon}
          </div>
        ))}
      </div>
    </div>
  );
};

export default EditorPosition;
