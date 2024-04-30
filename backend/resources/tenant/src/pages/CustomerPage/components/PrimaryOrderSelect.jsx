import React, { useCallback, useState } from "react";
import { BiChevronDown } from "react-icons/bi";

const PrimaryOrderSelect = ({
  defaultValue,
  options,
  handleChange,
  background,
  label,
  widthStyle,
  value,
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
          className={`btn min-h-[40px] w-full min-w-full flex items-center hover:border-neutral-700 h-10 rounded-2xl outline-none hover:outline-none focus:outline-none focus-within:outline-none justify-between px-2 border-neutral-700 ${
            background
              ? "bg-neutral-700 active:bg--neutral-700 hover:bg-neutral-700"
              : "bg-transparent active:bg-transparent hover:bg-transparent"
          } `}
        >
          <span
            // className={`text-sm md:text-[0.8rem] ${
            // background ? "text-white" : "text-neutral-500"
            // }`}
            className={value ? "text-neutral-900 px-2" : "text-neutral-500 px-2"}
          >
            {value || defaultValue}
          </span>
          <span className="">
            <BiChevronDown size={22} />
          </span>
        </div>
        {isOpen && (
          <div
            tabIndex={0}
            className="dropdown-content z-[1] menu flex flex-col gap-2 !px-0 shadow bg-base-100 rounded-box w-full max-h-fit overflow-x-hidden overflow-y-scroll !flex-nowrap hide-scroll"
          >
            {options &&
              options?.map((item, i) => (
                <div
                  className="transition-all p-2 flex w-full items-center hover:bg-neutral-700 cursor-pointer text-neutral-500 text-sm hover:text-neutral-50 px-4"
                  key={i}
                  onClick={() => {
                    handleChange(item);
                    handleDropdown();
                  }}
                >
                  {item.text}
                </div>
              ))}
          </div>
        )}
      </div>
    </div>
  );
};

export default PrimaryOrderSelect;
