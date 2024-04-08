import React, { useCallback, useState } from "react";

const EditorLink = ({ defaultValue, options, handleChange, label }) => {
    const [currentValue, setCurrentValue] = useState(null);
    return (
        <div className={`flex flex-row items-center w-[208px] justify-between`}>
            {label && (
                <label className="text-[12px] text-[rgba(17,24,39,0.54)] leading-[16px] font-medium ">
                    {label}
                </label>
            )}
            <div className={`dropdown`}>
                <div className="flex items-center h-[32px] w-[154px] rounded-[50px] px-[16px] bg-[#F3F3F3] relative">
                    <input
                        type="text"
                        value={currentValue}
                        placeholder="URL..."
                        className="bg-[#F3F3F3] w-full focus:outline-none text-[12px] leading-[16px] font-light text-[rgba(17,24,39,0.77)]"
                    />
                </div>
            </div>
        </div>
    );
};

export default EditorLink;
