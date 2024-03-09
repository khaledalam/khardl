import React from "react";
import ContactUsCover from "../../../assets/ContactUsCover.webp";

const Card = ({
    children,
    contentClassName = "",
    MainContentClassName = "",
}) => {
    return (
        <div
            className={`flex justify-center items-center h-[100vh] text-center w-[100%] ${MainContentClassName}`}
            style={{
                backgroundImage: `url(${ContactUsCover})`,
                backgroundSize: "cover",
            }}
        >
            <div
                className={`flex items-center shadow-xl rounded-xl ${contentClassName} `}
            >
                {children}
            </div>
        </div>
    );
};
export default Card;
