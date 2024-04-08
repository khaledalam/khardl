import { useTranslation } from "react-i18next";
import React, { useState } from "react";
import FlashDown from "../../../../assets/flashDown.svg";

export const LeftSideBar = ({
    activeSection,
    setActiveSection,
    activeSubitem,
    setActiveSubitem,
    navItems,
    activeDesignSection,
    setActiveDesignSection,
}) => {
    const { t } = useTranslation();
    // const [activeSection, setActiveSection] = useState(null);
    // const [activeSubitem, setActiveSubitem] = useState(null);

    const toggleSection = (sectionId) => {
        setActiveSection(sectionId === activeSection ? null : sectionId);
        setActiveSubitem(null);
        setActiveDesignSection(null);
    };

    return (
        <div className="flex flex-row h-[38px] md:h-full md:flex-col pl-[16px] md:px-[16px] z-40">
            <h2 className="font-medium my-auto border-r md:border-none py-[2px] md:py-0 pr-[13px] text-sm md:mt-[24px] md:mb-[21px]">
                {t("Sections")}
            </h2>
            <ul
                className="flex flex-row items-center md:items-start overflow-x-scroll md:overflow-x-hidden md:flex-col md:space-y-[16px] space-x-[8px] md:space-x-0 px-[8px] md:px-0"
                style={{
                    WebkitScrollbar: {
                        display: "none",
                    },
                    msOverflowStyle: "none",
                    scrollbarWidth: "none",
                }}
            >
                {navItems.map((item, index) => (
                    <li
                        key={`section-${index}`}
                        className="text-[#1118278A] text-[12px] font-light leading-[16px] relative"
                    >
                        <div
                            className={`${activeSection === index ? "bg-[#F3F3F3] text-[#111827]" : ""} cursor-pointer whitespace-nowrap md:whitespace-normal py-[4px] md:py-[8px] px-[8px] md:px-[24px] rounded-[50px] flex flex-row items-center md:flex-none space-x-[8px] md:space-x-0`}
                            onClick={() => toggleSection(index)}
                        >
                            <div>{item.title}</div>
                            <div className="md:hidden w-[10px] h-[10px]">
                                <img
                                    src={FlashDown}
                                    alt="flash-down"
                                    className="object-contain w-full h-full"
                                />
                            </div>
                        </div>
                        {/* <ul
                            className={`${activeSection === `section-${index}` ? "block absolute z-50 top-0 left-0 w-[137px]  border rounded-[8px] h-[56px]" : "hidden"}`}
                        >
                            Hello
                        </ul> */}
                        <ul
                            className={`px-4 text-[10px] leading-[13px] space-y-[16px] font-medium overflow-hidden transition-all duration-300 ${activeSection === index ? "max-h-40 mt-[16px]" : "max-h-0"} `}
                        >
                            {item.subItems.map((subItem, i) => (
                                <li
                                    key={`sub-section-${i}`}
                                    className={`${
                                        activeSection === index &&
                                        activeSubitem === i
                                            ? "bg-[#F3F3F3] text-[#111827]"
                                            : ""
                                    } ml-[14px] pt-[6px] pb-[5px] px-[24px] rounded-[50px] cursor-pointer`}
                                    onClick={() => setActiveSubitem(i)}
                                >
                                    {subItem.title}
                                </li>
                            ))}
                        </ul>
                    </li>
                ))}
            </ul>
        </div>
    );
};
