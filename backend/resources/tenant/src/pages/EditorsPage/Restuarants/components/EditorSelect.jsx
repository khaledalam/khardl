import React, { useCallback, useState } from "react";
import { BiChevronDown } from "react-icons/bi";
import halfArrowDown from "../../../../assets/halfArrowDown.svg";

const EditorSelect = ({ defaultValue, options, handleChange, label }) => {
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
                <div
                    tabIndex={0}
                    role="button"
                    onClick={() => handleDropdown()}
                    className="h-[32px] w-[154px] rounded-[50px] flex items-center justify-between px-[16px] bg-neutral-100 active:bg-neutral-100 hover:bg-neutral-100"
                >
                    <span className="text-[12px] leading-[16px] font-light text-[rgba(17,24,39,0.77)]">
                        {defaultValue}
                    </span>
                    <span className="">
                        {/* <BiChevronDown size={22} /> */}
                        <img src={halfArrowDown} alt="arrow down" />
                    </span>
                </div>
                {isOpen && (
                    <div
                        tabIndex={0}
                        className="dropdown-content z-[1] menu flex flex-col gap-4 p-2 shadow bg-base-100 rounded-box w-full max-h-[150px] overflow-x-hidden overflow-y-scroll !flex-nowrap hide-scroll"
                    >
                        {options &&
                            options?.map((item, i) => (
                                <div
                                    className="flex w-full gap-3 items-center p-2 hover:bg-[#C0D12330]"
                                    key={i}
                                    onClick={() => {
                                        handleChange(item.value);
                                        handleDropdown();
                                    }}
                                >
                                    <h3 className="text-[14px]">{item.text}</h3>
                                </div>
                            ))}
                    </div>
                )}
            </div>
        </div>
    );
};

export default EditorSelect;
