import React, { useState } from "react";
import ImgBurger from "../../../../assets/burger.png";
import { useTranslation } from "react-i18next";
import { useSelector } from "react-redux";

const CategoryItem = ({
    active,
    imgSrc,
    alt,
    name,
    onClick,
    hoverColor,
    textColor,
    textAlign,
    fontWeight,
    shape,
    isGrid,
    fontSize,
    valuekey,
}) => {
    const [isHover, setIsHover] = useState(false);
    const { t } = useTranslation();

    const { branches } = useSelector((state) => state.restuarantEditorStyle);

    if (!branches) return;

    let selectedBranch = branches?.filter(
        (b) => b?.id == localStorage.getItem("selected_branch_id")
    )[0];

    const handleMouseEnter = () => {
        setIsHover((prev) => !prev);
        console.log("mouse Enter");
    };

    const handleMouseLeave = () => {
        setIsHover((prev) => !prev);
    };

    return (
        <div
            onMouseEnter={handleMouseEnter}
            onMouseLeave={handleMouseLeave}
            onClick={onClick}
            key={valuekey}
            className={`flex w-5/6 cursor-pointer ${
                isGrid ? "flex-row" : "flex-col"
            } gap-[16px] items-center`}
        >
            {selectedBranch?.display_category_icon == "1" && (
                <div
                    style={{
                        backgroundColor: isHover
                            ? hoverColor
                            : active
                            ? hoverColor
                            : "#F5F5F5",
                    }}
                    className={`w-[60px] h-[60px] ${
                        shape === "sharp" ? "" : "rounded-full"
                    }  flex items-center justify-center scale-100 hover:scale-125 transition-all duration-300  bg-neutral-100  `}
                >
                    <div
                        className={`w-full h-full flex items-center ${
                            shape === "sharp" ? "" : "rounded-full"
                        } justify-center`}
                    >
                        <img
                            src={imgSrc ? imgSrc : ImgBurger}
                            alt={alt}
                            className={`w-full h-full object-cover ${
                                shape === "sharp" ? "" : "rounded-full"
                            } `}
                        />
                    </div>
                </div>
            )}
            <h3
                style={{
                    color: textColor,
                    fontWeight,
                    fontSize:
                        fontSize &&
                        typeof fontSize == "string" &&
                        fontSize.includes("px")
                            ? Number(fontSize.slice(0, 2)) - 2
                            : typeof fontSize == "number"
                            ? fontSize - 2
                            : 14,
                }}
                className={`font-normal w-max ${
                    textAlign === t("Center")
                        ? "text-center"
                        : textAlign === t("Left")
                        ? "text-left"
                        : textAlign === t("Right")
                        ? "text-right"
                        : ""
                }`}
            >
                {name}
            </h3>
        </div>
    );
};

export default CategoryItem;
