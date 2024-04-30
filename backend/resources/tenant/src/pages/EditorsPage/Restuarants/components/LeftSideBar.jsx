import { useTranslation } from "react-i18next";
import React, { useState } from "react";
import useWindowSize from "../../../../hooks/useWindowSize";
import FlashDown from "../../../../assets/flashDown.svg";
import GreenDot from "../../../../assets/greenDot.png";
import { cn } from "../../../../utils/styles";

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
  const toggleSection = (e, sectionIndex) => {
    if (activeSection === sectionIndex) {
      setActiveSection(null);
      setActiveSubitem(null);
    } else {
      setActiveSection(sectionIndex);
      setActiveSubitem(0);
    }

    setActiveDesignSection(null);
  };

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
          <Section
            key={`section-${index}`}
            title={item.title}
            active={activeSection === index}
            activeSubitem={activeSubitem}
            subItems={item.subItems}
            onClick={(e) => toggleSection(e, index)}
          />
        ))}
      </ul>
    </div>
  );
};

const Section = ({ title, subItems, active, activeSubitem, onClick }) => {
  const [mouseClick, setMouseClick] = useState(0);
  const { width } = useWindowSize();
  const isMobile = width < 768;

  const listDesktopClassName = cn(
    "px-4 text-[10px] xl:text-[14px] leading-[13px] space-y-[16px] font-medium overflow-hidden transition-all duration-300",
    active ? "max-h-40 mt-[16px]" : "max-h-0",
  );

  const listMobileClassName = active
    ? "block left-0 w-[137px] bg-white rounded-md border border-black border-opacity-10 fixed p-[8px] space-y-[8px]"
    : "hidden";

  const handleSectionClick = (e) => {
    setMouseClick(e.clientX);
    onClick();
  };

  return (
    <li className="text-[#1118278A] text-[12px]  xl:text-[16px] font-light leading-[16px] relative w-full">
      <div
        className={cn(
          "cursor-pointer whitespace-nowrap md:whitespace-normal py-[4px] md:py-[8px] px-[8px] md:pl-[24px] md:pr-[16px] rounded-[50px] flex flex-row justify-between items-center md:flex-none space-x-[8px] md:space-x-0 w-full",
          { "bg-[#F3F3F3] text-[#111827]": active },
        )}
        onClick={handleSectionClick}
      >
        <div>{title}</div>
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
          className={
            active
              ? "hidden md:block md:w-[9px] md:h-[9px] md:object-contain"
              : "hidden"
          }
        />
      </div>

      <ul
        className={cn(
          isMobile ? listMobileClassName : listDesktopClassName,
          subItems.length === 1 && "hidden", // hide subitems if there is only one
        )}
        style={
          !isMobile
            ? undefined
            : {
                zIndex: 11,
                left: Math.max(0, Math.min(200, mouseClick)),
              }
        }
      >
        {subItems.map((subItem, i) => (
          <SubItem
            key={`sub-section-${i}`}
            title={subItem.title}
            active={active && activeSubitem === i}
            onClick={() => setActiveSubitem(i)}
          />
        ))}
      </ul>
    </li>
  );
};

const SubItem = ({ title, active, onClick }) => {
  const { width } = useWindowSize();
  const isMobile = width < 768;

  const desktopClassName = cn(
    "ml-[14px] pt-[6px] pb-[5px] pl-[24px] pr-[16px] rounded-[50px] cursor-pointer flex justify-between items-center",
    { "bg-[#F3F3F3] text-[#111827]": active },
  );
  const mobileClassName = cn(
    "w-[115px] h-6 rounded-md cursor-pointer py-[5px] px-[8px] flex flex-row justify-between items-center",
    { "bg-zinc-100 text-[#111827] border": active },
  );

  return (
    <li
      className={isMobile ? mobileClassName : desktopClassName}
      onClick={onClick}
    >
      <span>{title}</span>
      <img
        src={GreenDot}
        alt="green-dot"
        className={active ? "w-[9px] h-[9px] object-contain" : "hidden"}
      />
    </li>
  );
};
