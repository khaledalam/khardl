import React from "react";
import { useSelector } from "react-redux";
import { globalShape } from "../../redux/editor/buttonSlice";

function Shape({ component, contentClassName, onClick, value, active }) {
    const GlobalShape = useSelector(globalShape);

    return (
        <button
            className={`bg-[var(--secondary)] p-1 px-2 rounded-full ${contentClassName} ${active ? "bg-[#C0D12325] font-semibold border-[1px] border-[var(--primary)]" : ""}`}
            onClick={onClick}
            value={value}
        >
            {component}
        </button>
    );
}

export default Shape;
