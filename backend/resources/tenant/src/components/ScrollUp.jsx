import React, { useEffect, useState } from "react";
import { useSelector } from "react-redux";
import { AiOutlineArrowUp } from "react-icons/ai";

const ScrollUp = () => {
    const Language = useSelector((state) => state.languageMode.languageMode);
    const restaurantStyle = useSelector((state) => state.restuarantEditorStyle);

    const [scrollY, setScrollY] = useState(0);
    useEffect(() => {
        const handleScroll = () => {
            setScrollY(window.scrollY);
        };
        window.addEventListener("scroll", handleScroll);
        return () => {
            window.removeEventListener("scroll", handleScroll);
        };
    }, []);
    const scrollThreshold = 200;

    return (
        <div
            className={`z-[999] fixed max-[450px]:bottom-3  bottom-6 ${
                Language === "en"
                    ? "left-6 max-[450px]:left-4"
                    : "right-6 max-[450px]:right-4"
            }  `}
        >
            <button
                style={{
                    background: "black",
                }}
                onClick={() => window.scrollTo({ top: 0, behavior: "smooth" })}
                className={`p-[6px]  shadow-lg cursor-pointer w-fit rounded-md  flex flex-col items-center justify-center overflow-hidden transform transition-transform hover:-translate-y-2  ${
                    scrollY > scrollThreshold ? "block" : "hidden"
                }`}
            >
                <AiOutlineArrowUp className="text-white text-[25px] max-[450px]:text-[20px]" />
            </button>
        </div>
    );
};

export default ScrollUp;
