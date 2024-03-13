import React, { useState } from "react";
import { useSelector } from "react-redux";
import { FaStarOfLife } from "react-icons/fa";

const Card = ({
    FeatureImage,
    FeatureTitle,
    FeatureDetails,
    FeaturePrice,
    FeatureDevice,
}) => {
    const [, setIsHover] = useState(false);
    const Language = useSelector((state) => state.languageMode.languageMode);

    const handleMouseEnter = () => {
        setIsHover(true);
    };
    const handleMouseLeave = () => {
        setIsHover(false);
    };

    return (
        <div
            onMouseEnter={handleMouseEnter}
            onMouseLeave={handleMouseLeave}
            data-aos="fade-up"
            data-aos-delay="800"
            className={`h-[100%] bg-[var(--third)] rounded-lg shadow-md`}
        >
            <div
                className={`bg-[var(--third)] px-4 py-8 rounded-lg hover:translate-y-2 ease-in duration-200 max-[600px]:py-12  flex flex-col items-center ${FeatureDevice ? "justify-start" : "justify-center"}`}
            >
                {FeatureImage && (
                    <div className="flex flex-col sp-2 px-6">
                        <img
                            loading="lazy"
                            className={`mb-2 w-[80px] h-auto`}
                            src={FeatureImage}
                            alt="Bonnieimage"
                        />
                    </div>
                )}
                <div className="text-center flex flex-col items-center justify-start gap-1">
                    <h2
                        className={`font-bold ${FeaturePrice ? "text-[22px]" : ""} mt-4`}
                    >
                        {FeatureTitle}
                    </h2>
                    <h2 className="font-bold text-[20px] text-[var(--primary)] mt-1">
                        {FeaturePrice}{" "}
                        {!isNaN(FeaturePrice)
                            ? `${Language === "en" ? "SAR" : "ريال"}`
                            : ""}
                    </h2>
                    {FeatureDevice && (
                        <div className="flex justify-start items-center gap-2 text-start mt-4">
                            <FaStarOfLife size={10} className="text-red-500" />
                            <h2 className="text-[18px]">{FeatureDevice}</h2>
                        </div>
                    )}
                    <h2 className="text-[14px]">{FeatureDetails}</h2>
                </div>
            </div>
        </div>
    );
};

export default Card;
