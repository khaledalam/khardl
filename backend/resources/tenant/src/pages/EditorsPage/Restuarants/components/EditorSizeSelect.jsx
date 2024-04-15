import React, { useCallback, useState } from "react";
import { BiChevronDown } from "react-icons/bi";
import halfArrowDown from "../../../../assets/halfArrowDown.svg";
import { useSelector, useDispatch } from "react-redux";

const EditorSizeSelect = ({ defaultValue, options, handleChange, label }) => {
    const [currentValue, setCurrentValue] = useState(defaultValue);

    const Language = useSelector((state) => state.languageMode.languageMode);

    const handleIncrement = () => {
        setCurrentValue(currentValue + 1);
        handleChange(currentValue + 1);
    };

    const handleDecrement = () => {
        setCurrentValue(currentValue - 1);
        handleChange(currentValue - 1);
    };
    const [isOpen, setisOpen] = useState(false);

    const handleDropdown = useCallback(() => {
        setisOpen((prev) => !prev);
    }, []);
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
                        type="number"
                        value={currentValue}
                        className="bg-[#F3F3F3] w-[30px] focus:outline-none text-[12px] leading-[16px] font-light text-[rgba(17,24,39,0.77)]"
                    />

                    <div
                        className={`absolute ${
                            Language == "ar" ? "left-[16px]" : "right-[16px]"
                        } flex flex-col items-center`}
                    >
                        <button onClick={handleIncrement} className="">
                            <img
                                src={halfArrowDown}
                                alt="Increase"
                                className="rotate-180"
                            />
                        </button>
                        <button onClick={handleDecrement} className="">
                            <img
                                src={halfArrowDown}
                                alt="Decrease"
                                className=""
                            />
                        </button>
                    </div>
                </div>
                {/* <div
                    tabIndex={0}
                    role="button"
                    onClick={() => handleDropdown()}
                    className="h-[32px] w-[154px] rounded-[50px] flex items-center justify-between px-[16px] bg-neutral-100 active:bg-neutral-100 hover:bg-neutral-100"
                >
                    <span className="text-[12px] leading-[16px] font-light text-[rgba(17,24,39,0.77)]">
                        {defaultValue}
                    </span>
                    <span className="">
                        <img src={halfArrowDown} alt="arrow down" />
                    </span>
                </div> */}
            </div>
        </div>
    );
};

export default EditorSizeSelect;
