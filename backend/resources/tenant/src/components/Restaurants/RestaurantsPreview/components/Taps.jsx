import React, { useState } from "react";
import { FaArrowRight, FaArrowLeft } from "react-icons/fa";
import { useTranslation } from "react-i18next";
import { useSelector } from "react-redux";

export function Taps({ children, contentClassName = "" }) {
    const { t } = useTranslation();
    const [activeTap, setActiveTap] = useState(findActiveTap(children));
    const styleDataRestaurant = useSelector(
        (state) => state.styleDataRestaurant.styleDataRestaurant,
    );

    if (!styleDataRestaurant) return;

    const selectedCategory =
        styleDataRestaurant?.category_style ||
        sessionStorage.getItem("selectedCategory");
    const selectedAlignText =
        styleDataRestaurant?.font_alignment ||
        sessionStorage.getItem("selectedCategory");

    const GlobalShape =
        styleDataRestaurant?.buttons_style ||
        sessionStorage.getItem("globalShape");
    const Color =
        styleDataRestaurant?.primary_color ||
        sessionStorage.getItem("globalColor");
    const Language = sessionStorage.getItem("Language") || "en";

    function findActiveTap(a) {
        return a.reduce((accumulator, currentValue, i) => {
            if (currentValue.props.active) {
                return i;
            }
            return accumulator;
        }, 0);
    }

    function TapValidator(Tap) {
        return Tap.type.displayName === "Tap" ? true : false;
    }

    const isFirstTap = activeTap === 0;
    const isLastTap = activeTap === children.length - 1;
    const handleTabClick = (index) => {
        setActiveTap(index);
    };

    return (
        <div
            className={`${selectedAlignText === "Right" ? "flex gap-2" : ""} ${selectedAlignText === "Left" ? "flex flex-row-reverse gap-5" : ""}`}
        >
            <div
                className={`p-3 gap-1 justify-start
    ${selectedAlignText === "Right" || selectedAlignText === "Left" ? "h-fit mt-4 " : ""}
    ${selectedCategory === "Tabs" ? "flex" : ""}
      ${contentClassName}`}
                style={{ borderRadius: GlobalShape, overflowX: "scroll" }}
            >
                {selectedCategory === `${t("Carousel")}` ? (
                    <button
                        onClick={() => handleTabClick(activeTap - 1)}
                        disabled={activeTap === 0}
                        className={`${isFirstTap ? "text-[#00000040]" : "text-white"}`}
                        style={{ userSelect: "none" }}
                    >
                        <div
                            className="rounded-full p-[8px]"
                            style={{ backgroundColor: `${Color}` }}
                        >
                            {Language == "en" ? (
                                <FaArrowLeft className="text-[20px] max-[900px]:text-[24px] max-[600px]:text-[18px]" />
                            ) : (
                                <FaArrowRight className="text-[20px] max-[900px]:text-[24px] max-[600px]:text-[18px]" />
                            )}
                        </div>
                    </button>
                ) : (
                    <div></div>
                )}
                {children.map((item, i) => {
                    return (
                        <div
                            key={`Tap-child-${i}`}
                            className={` ${selectedCategory === `${t("Carousel")}` ? "flex items-center justify-center " : ""} `}
                        >
                            {(selectedCategory === `${t("Carousel")}`
                                ? i >= activeTap - 1 &&
                                  i <= activeTap + 1 &&
                                  TapValidator(item)
                                : TapValidator(item)) && (
                                <Tap
                                    key={i}
                                    currentTap={i}
                                    activeTap={activeTap}
                                    setActiveTap={setActiveTap}
                                >
                                    {item.props.children}
                                </Tap>
                            )}
                        </div>
                    );
                })}
                {selectedCategory === `${t("Carousel")}` ? (
                    <button
                        onClick={() => handleTabClick(activeTap + 1)}
                        disabled={activeTap === children.length - 1}
                        className={`${isLastTap ? "text-[#00000080]" : "text-white"}`}
                        style={{ userSelect: "none" }}
                    >
                        <div
                            className="rounded-full p-[8px]"
                            style={{ backgroundColor: `${Color}` }}
                        >
                            {Language == "en" ? (
                                <FaArrowRight className="text-[20px] max-[900px]:text-[24px] max-[600px]:text-[18px]" />
                            ) : (
                                <FaArrowLeft className="text-[20px] max-[900px]:text-[24px] max-[600px]:text-[18px]" />
                            )}
                        </div>
                    </button>
                ) : (
                    <div></div>
                )}
            </div>
            <div className="">
                {children.map((item, i) => {
                    return (
                        <div
                            key={"child-" + i}
                            className={` ${i === activeTap ? "visible" : "hidden"}`}
                        >
                            {item.props.component}
                        </div>
                    );
                })}
            </div>
        </div>
    );
}

export function Tap({
    children,
    activeTap,
    currentTap,
    setActiveTap,
    contentClassName = "",
}) {
    const { t } = useTranslation();
    const styleDataRestaurant = useSelector(
        (state) => state.styleDataRestaurant.styleDataRestaurant,
    );

    if (!styleDataRestaurant) return;
    const selectedCategory = sessionStorage.getItem("selectedCategory");
    const Color =
        styleDataRestaurant?.primary_color ||
        sessionStorage.getItem("globalColor");
    const GlobalShape =
        styleDataRestaurant?.buttons_style ||
        sessionStorage.getItem("globalShape");

    return (
        <>
            {selectedCategory === `${t("Carousel")}` ? (
                <div
                    className={`px-6 cursor-pointer text-black
       text-[18px] max-[600px]:text-[15px] mx-2
       ${activeTap === currentTap ? `font-bold text-xl my-2` : "text-md"}
        py-[6px]
        select-none ${contentClassName}`}
                    style={
                        activeTap === currentTap
                            ? {
                                  background: Color,
                                  borderRadius: GlobalShape,
                              }
                            : {}
                    }
                    onClick={() => setActiveTap(currentTap)}
                >
                    {children}
                </div>
            ) : (
                <div
                    className={`px-4 cursor-pointer text-[18px] max-[600px]:text-[15px]
     ${selectedCategory === `${t("Tabs")}` || selectedCategory === `${t("Carousel")}` ? "mx-1" : ""}
     ${activeTap === currentTap && (selectedCategory === `${t("Tabs")}` || selectedCategory === `${t("Carousel")}`) ? `font-bold` : ""}
     ${activeTap === currentTap && (selectedCategory === `${t("Right")}` || selectedCategory === `${t("Left")}`) ? `w-[100%] rounded-md py-[6px] font-bold` : "py-[4px] px-[28px] my-2"}
      select-none ${contentClassName}`}
                    style={
                        activeTap === currentTap
                            ? {
                                  background: Color,
                                  borderRadius: GlobalShape,
                                  width: "max-content",
                              }
                            : {
                                  borderRadius: GlobalShape,
                                  border: `0.5px solid ${Color}`,
                                  width: "max-content",
                              }
                    }
                    onClick={() => setActiveTap(currentTap)}
                >
                    {children}
                </div>
            )}
        </>
    );
}

Tap.displayName = "Tap";
