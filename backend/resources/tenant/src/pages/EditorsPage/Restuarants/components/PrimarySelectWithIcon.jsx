import React, { useCallback, useState } from "react";
import { BiChevronDown } from "react-icons/bi";
import { useSelector } from "react-redux";
import { GiCardPickup } from "react-icons/gi";

const PrimarySelectWithIcon = ({
    imgUrl,
    text,
    defaultValue,
    options,
    placeholder,
    onChange,
}) => {
    const [isOpen, setisOpen] = useState(false);
    const restuarantStyle = useSelector((state) => state.restuarantEditorStyle);
    const handleDropdown = useCallback(() => {
        setisOpen((prev) => !prev);
    }, []);

    const parseValue = (value) => {
        if (value.includes("*")) {
            return (
                <span className="text-ellipsis">
                    {value.slice(0, -1)}{" "}
                    <b style={{ color: "orange" }}>closed</b>
                </span>
            );
        } else {
            return <span className="text-ellipsis">{value}</span>;
        }
    };

    return (
        <div
            style={{ borderColor: restuarantStyle?.categoryDetail_cart_color }}
            className={`w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border  items-center cursor-pointer `}
        >
            <div className={` flex items-center gap-1  border-r `}>
                <div className="w-[30px] h-[30px] rounded-xl flex items-center justify-center">
                    <GiCardPickup />
                </div>
                <h3
                    className="capitalize pr-2 w-max"
                    style={{ color: "#000000" }}
                >
                    {text}
                </h3>
            </div>
            <div
                className={`dropdown w-full border-none hover:border-none outline-none focus-visible:border-none focus-visible:outline-none`}
            >
                <div
                    tabIndex={0}
                    role="button"
                    onClick={() => handleDropdown()}
                    className="btn h-[30px] flex items-center w-full justify-between px-2 border-none hover:border-none outline-none focus-visible:border-none focus-visible:outline-none bg-neutral-100 active:bg-neutral-100 hover:bg-neutral-100"
                >
                    {parseValue(defaultValue)}
                    <span className="">
                        <BiChevronDown size={22} />
                    </span>
                </div>
                {isOpen && (
                    <div
                        tabIndex={0}
                        className="dropdown-content z-[1] menu flex flex-col gap-4 p-2 shadow bg-base-100 rounded-md w-full max-h-[150px] overflow-x-hidden overflow-y-scroll !flex-nowrap hide-scroll"
                    >
                        {options &&
                            options?.map((item, i) => (
                                <div
                                    className="flex w-full gap-3 items-center p-2 hover:bg-[#C0D12330]"
                                    key={i}
                                    onClick={() => {
                                        onChange(item);
                                        handleDropdown();
                                    }}
                                >
                                    {parseValue(`${item.name}${item.isClosed}`)}
                                </div>
                            ))}
                    </div>
                )}
            </div>
        </div>
    );
};

export default PrimarySelectWithIcon;
