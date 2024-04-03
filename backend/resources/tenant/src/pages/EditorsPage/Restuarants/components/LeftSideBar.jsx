import { useTranslation } from "react-i18next";
import React, { useState } from 'react';


export const LeftSideBar = () => {
    const { t } = useTranslation();
    const [activeSection, setActiveSection] = useState(null);

    const navItems = [
        {
            title: t("Header"),
            subItems: [{
                title: t("Side Menu")
            },{
                title: t("Order Cart")
            },{
                title: t("Home")
            }]
        },
        {
            title: t("Logo"),
            subItems: [{
                title: t("Logo")
            }]
        },
        {
            title: t("Banner"),
            subItems: [{
                title: t("Banner")
            }]
        },
        {
            title: t("Menu Category"),
            subItems: [{
                title: t("Category")
            }]
        },
        {
            title: t("Menu Category Detail"),
            subItems: [{
                title: t("Menu Name")
            },{
                title: t("Total Calories")
            },{
                title: t("Price")
            }]
        },
        {
            title: t("Social Media"),
            subItems: [{
                title: t("Social Media")
            }]
        },
        {
            title: t("Footer "),
            subItems: [{
                title: t("Footer ")
            }]
        },
    ]

    const toggleSection = (sectionId) => {
        setActiveSection(sectionId === activeSection ? null : sectionId);
      };


    return (
        <div className="px-[16px]" style={
            {fontFamily: "Plus Jakarta Sans, sans-serif"}
        }>
            <h2 className="!font-jakarta-sans font-medium text-sm mt-[24px] mb-4">{t("Sections")}</h2>
            <ul>
            {navItems.map((item, index) => (
                <li key={`section-${index}`} className="mb-4">
                    <h3 className="font-medium text-[14px] mb-2" onClick={() => toggleSection(`section-${index}`)}>{item.title}</h3>
                    <ul className={`pl-4 mt-2 overflow-hidden transition-all duration-300 ${activeSection === `section-${index}` ? 'max-h-40' : 'max-h-0'} `}>
                        {item.subItems.map((subItem, i) => (
                            <li key={`sub-section-${i}`} className="text-[14px] text-neutral-700 ml-3">{subItem.title}</li>
                        ))}
                    </ul>
                </li>
            ))}
            </ul>
        </div>
        
    );
};