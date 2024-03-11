import React, { useState } from "react";
import imgEyesWhite from "../../../assets/eyesWhite.svg";
import imgEyes from "../../../assets/eyeIcon.svg";

const Eyes = ({cursorPointer = false, onClick = null}) => {
    const [isHovering, setIsHovering] = useState(false);

    return (
        <div
            onClick={onClick}
            onMouseEnter={() => {
                setIsHovering((prev) => !prev);
            }}
            onMouseLeave={() => {
                setIsHovering((prev) => !prev);
            }}
            className="w-8 h-8 p-1 flex items-center justify-center rounded-full ml-7 border border-[var(--customer)] hover:bg-[var(--customer)]"
        >
            <img
                src={isHovering ? imgEyesWhite : imgEyes}
                alt=""
                className={`object-contain w-full h-full ${cursorPointer && 'cursor-pointer'}`}
            />
        </div>
    );
};

export default Eyes;
