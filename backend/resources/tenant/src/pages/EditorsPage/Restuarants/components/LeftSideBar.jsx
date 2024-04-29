import { useTranslation } from "react-i18next";
import React, { useState } from "react";
import FlashDown from "../../../../assets/flashDown.svg";
import { use } from "i18next";
import useWindowSize from "../../../../hooks/useWindowSize";
import GreenDot from "../../../../assets/greenDot.png";

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

    const toggleSection = (e, sectionId) => {
        setActiveSection(sectionId === activeSection ? null : sectionId);
        setActiveSubitem(null);
        setActiveDesignSection(null);
        setMouseClick(e.clientX);
    };

    const [mouseClick, setMouseClick] = useState(0);
    const { width } = useWindowSize();

    return (
        <div className="flex flex-row h-[38px] md:h-full md:flex-col pl-[16px] md:px-[16px] z-40">
            <h2 className="font-medium my-auto border-r md:border-none py-[2px] md:py-0 pr-[13px] text-sm xl:text-[18px] md:mt-[24px] md:mb-[21px]">
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
                        className="text-[#1118278A] text-[12px]  xl:text-[16px] font-light leading-[16px] relative w-full"
                    >
                        <div
                            className={`${
                                activeSection === index
                                    ? "bg-[#F3F3F3] text-[#111827]"
                                    : ""
                            } cursor-pointer whitespace-nowrap md:whitespace-normal py-[4px] md:py-[8px] px-[8px] md:pl-[24px] md:pr-[16px] rounded-[50px] flex flex-row justify-between items-center md:flex-none space-x-[8px] md:space-x-0 w-full`}
                            onClick={(e) => {
                                toggleSection(e, index);
                                item.subItems.length === 1 && setActiveSubitem(0);
                            }}
                        >
                            <div>
                                {item.subItems.length !== 1
                                    ? item.title
                                    : item.subItems[0].title}
                            </div>
                            <div className="md:hidden w-[10px] h-[10px]">
                                <img
                                    src={FlashDown}
                                    alt="flash-down"
                                    className="object-contain w-full h-full"
                                />
                            </div>
                            <img
                                src={GreenDot}
                                alt="green-dot"
                                className={`${
                                    activeSection === index
                                        ? "hidden md:block md:w-[9px] md:h-[9px] md:object-contain"
                                        : "hidden"
                                }`}
                            />
                        </div>
                        {item.subItems.length !== 1 && (
                            <>
                                {width < 768 ? (
                                    <ul
                                        style={{
                                            zIndex: 11,
                                            left: Math.max(
                                                0,
                                                Math.min(200, mouseClick)
                                            ),
                                        }}
                                        className={`${
                                            activeSection === index
                                                ? "block left-0 w-[137px] bg-white rounded-md border border-black border-opacity-10 fixed p-[8px] space-y-[8px]"
                                                : "hidden"
                                        }`}
                                    >
                                        {item.subItems.map((subItem, i) => (
                                            <li
                                                key={`sub-section-${i}`}
                                                className={`${
                                                    activeSection === index &&
                                                    activeSubitem === i
                                                        ? "bg-zinc-100 text-[#111827] border"
                                                        : ""
                                                } w-[115px] h-6 rounded-md cursor-pointer py-[5px] px-[8px] flex flex-row justify-between items-center`}
                                                onClick={() =>
                                                    setActiveSubitem(i)
                                                }
                                            >
                                                <span>{subItem.title}</span>
                                                <img
                                                    src={GreenDot}
                                                    alt="green-dot"
                                                    className={`${
                                                        activeSection ===
                                                            index &&
                                                        activeSubitem === i
                                                            ? "w-[9px] h-[9px] object-contain"
                                                            : "hidden"
                                                    }`}
                                                />
                                            </li>
                                        ))}
                                    </ul>
                                ) : (
                                    <ul
                                        className={`px-4 text-[10px] xl:text-[14px] leading-[13px] space-y-[16px] font-medium overflow-hidden transition-all duration-300 ${
                                            activeSection === index
                                                ? "max-h-40 mt-[16px]"
                                                : "max-h-0"
                                        } `}
                                    >
                                        {item.subItems.map((subItem, i) => (
                                            <li
                                                key={`sub-section-${i}`}
                                                className={`${
                                                    activeSection === index &&
                                                    activeSubitem === i
                                                        ? "bg-[#F3F3F3] text-[#111827]"
                                                        : ""
                                                } ml-[14px] pt-[6px] pb-[5px] pl-[24px] pr-[16px] rounded-[50px] cursor-pointer flex justify-between items-center`}
                                                onClick={() =>
                                                    setActiveSubitem(i)
                                                }
                                            >
                                                <span>{subItem.title}</span>
                                                <img
                                                    src={GreenDot}
                                                    alt="green-dot"
                                                    className={`${
                                                        activeSection ===
                                                            index &&
                                                        activeSubitem === i
                                                            ? "w-[9px] h-[9px] object-contain"
                                                            : "hidden"
                                                    }`}
                                                />
                                            </li>
                                        ))}
                                    </ul>
                                )}
                            </>
                        )}
                    </li>
                ))}
            </ul>
        </div>
    );
};
