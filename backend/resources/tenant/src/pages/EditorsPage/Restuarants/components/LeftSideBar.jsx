import { useTranslation } from "react-i18next";
import React, { useState } from "react";

export const LeftSideBar = () => {
    const { t } = useTranslation();
    const [activeSection, setActiveSection] = useState(null);
    const [activeSubitem, setActiveSubitem] = useState(null);

    const navItems = [
        {
            title: t("Header"),
            subItems: [
                {
                    title: t("Side Menu"),
                },
                {
                    title: t("Order Cart"),
                },
                {
                    title: t("Home"),
                },
            ],
        },
        {
            title: t("Logo"),
            subItems: [
                {
                    title: t("Logo"),
                },
            ],
        },
        {
            title: t("Banner"),
            subItems: [
                {
                    title: t("Banner"),
                },
            ],
        },
        {
            title: t("Menu Category"),
            subItems: [
                {
                    title: t("Category"),
                },
            ],
        },
        {
            title: t("Menu Category Detail"),
            subItems: [
                {
                    title: t("Menu Name"),
                },
                {
                    title: t("Total Calories"),
                },
                {
                    title: t("Price"),
                },
            ],
        },
        {
            title: t("Social Media"),
            subItems: [
                {
                    title: t("Social Media"),
                },
            ],
        },
        {
            title: t("Footer "),
            subItems: [
                {
                    title: t("Footer "),
                },
            ],
        },
    ];

    const toggleSection = (sectionId) => {
        setActiveSection(sectionId === activeSection ? null : sectionId);
        setActiveSubitem(null);
    };

    return (
        <div className="flex flex-row h-[40px] md:h-full md:flex-col px-[16px]">
            <h2 className="font-medium text-sm md:mt-[24px] md:mb-[21px]">
                {t("Sections")}
            </h2>
            <ul className="flex flex-row overflow-x-auto whitespace-nowrap hide-scroll md:flex-col md:space-y-[16px]">
                {navItems.map((item, index) => (
                    <li
                        key={`section-${index}`}
                        className="text-[#1118278A] text-[12px] font-light leading-[16px]"
                    >
                        <h3
                            className={`${activeSection === `section-${index}` ? "bg-[#F3F3F3] text-[#111827]" : ""} py-[8px] px-[24px] rounded-[50px]`}
                            onClick={() => toggleSection(`section-${index}`)}
                        >
                            {item.title}
                        </h3>
                        <ul
                            className={`pl-4 text-[10px] leading-[13px] space-y-[16px] font-medium overflow-hidden transition-all duration-300 ${activeSection === `section-${index}` ? "max-h-40 mt-[16px]" : "max-h-0"} `}
                        >
                            {item.subItems.map((subItem, i) => (
                                <li
                                    key={`sub-section-${i}`}
                                    className={`${
                                        activeSection === `section-${index}` &&
                                        activeSubitem === i
                                            ? "bg-[#F3F3F3] text-[#111827]"
                                            : ""
                                    } ml-[14px] pt-[6px] pb-[5px] px-[24px] rounded-[50px]`}
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
