import React, { useCallback, useState } from "react";
import { useTranslation } from "react-i18next";
import AlignLeft from "../../../../assets/alignLeft.png";
import AlignCenter from "../../../../assets/alignCenter.png";
import AlignRight from "../../../../assets/alignRight.png";

const EditorAlignment = ({ defaultValue, onChange }) => {
    const [activeAlign, setActiveAlign] = useState(defaultValue);

    const alignments = [
        {
            position: "left",
            icon: <img src={AlignLeft} alt="align left icon" />,
        },
        {
            position: "center",
            icon: <img src={AlignCenter} alt="align center icon" />,
        },
        {
            position: "right",
            icon: <img src={AlignRight} alt="align right icon" />,
        },
    ];

    const handleActiveAlign = useCallback((position) => {
        setActiveAlign(position);
        onChange(position);
    }, []);
    return (
        <div className={""}>
            <div
                className={`flex items-center justify-between w-[208px] h-[40px] bg-[#F3F3F3] rounded-[50px] py-[4px] px-[12px]`}
            >
                {alignments.map((alignment, idx) => (
                    <div
                        className={`${
                            alignment.position === activeAlign
                                ? "bg-white rounded-[50px] py-[10px] px-[25px]"
                                : "rounded-[50px] py-[10px] px-[25px]"
                        }`}
                        key={idx}
                        onClick={() => {
                            handleActiveAlign(alignment.position);
                        }}
                    >
                        {alignment.icon}
                    </div>
                ))}
            </div>
        </div>
    );
};

export default EditorAlignment;
