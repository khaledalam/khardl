import React, { useCallback, useState } from "react";
import { BiChevronDown } from "react-icons/bi";

const PrimaryOrderSelect = ({
    defaultValue,
    options,
    handleChange,
    background,
    label,
    widthStyle,
}) => {
    const [isOpen, setisOpen] = useState(false);

    const handleDropdown = useCallback(() => {
        setisOpen((prev) => !prev);
    }, []);
    return (
        <div
            className={`flex flex-col gap-2 ${widthStyle ? widthStyle : "w-full"}`}
        >
            {label && (
                <label className="text-[13px] font-normal text-neutral-700">
                    {label}
                </label>
            )}
            <div
                className={`dropdown w-full outline-none focus:outline-none focus-within:outline-none hover:outline-none`}
            >
                <div
                    tabIndex={0}
                    role="button"
                    onClick={() => handleDropdown()}
                    className={`btn min-h-[40px] w-full min-w-full flex items-center hover:border-[var(--customer)] h-10 rounded-2xl outline-none hover:outline-none focus:outline-none focus-within:outline-none justify-between px-2 border-[var(--customer)] ${
                        background
                            ? "bg-[var(--customer)] active:bg-[var(--customer)] hover:bg-[var(--customer)]"
                            : "bg-transparent active:bg-transparent hover:bg-transparent"
                    } `}
                >
                    <span
                        className={`text-sm md:text-[0.8rem] ${
                            background ? "text-white" : "text-neutral-500"
                        }`}
                    >
                        {defaultValue}
                    </span>
                    <span className="">
                        <BiChevronDown size={22} />
                    </span>
                </div>
                {isOpen && (
                    <div
                        tabIndex={0}
                        className="dropdown-content z-[1] menu flex flex-col gap-4 !px-0 shadow bg-base-100 rounded-box w-full max-h-[150px] overflow-x-hidden overflow-y-scroll !flex-nowrap hide-scroll"
                    >
                        {options &&
                            options?.map((item, i) => (
                                <div
                                    className="flex w-full gap-3 items-center p-2 hover:bg-[var(--customer)] cursor-pointer"
                                    key={i}
                                    onClick={() => {
                                        handleChange(item.value);
                                        handleDropdown();
                                    }}
                                >
                                    <h3 className="text-[12px] text-neutral-500">
                                        {item.text}
                                    </h3>
                                </div>
                            ))}
                    </div>
                )}
            </div>
        </div>
    );
};

export default PrimaryOrderSelect;
