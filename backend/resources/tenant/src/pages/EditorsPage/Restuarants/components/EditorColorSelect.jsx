import React, { useState } from "react";
import { ChromePicker } from "react-color";
import { IoIosClose } from "react-icons/io";
import { useTranslation } from "react-i18next";

const EditorColorSelect = ({
    label,
    color,
    handleColorChange,
    defaultColor,
    modalId,
}) => {
    const { t } = useTranslation();
    const newdefaultColor = `#ffffff`;
    const [isResetColor, setIsResetColor] = useState(false);

    return (
        <div
            className={`flex flex-row items-center w-[208px] xl:w-full justify-between`}
        >
            {label && (
                <label className="text-[12px] xl:text-[16px] text-[rgba(17,24,39,0.54)] leading-[16px] font-medium ">
                    {label}
                </label>
            )}
            <div className="">
                <button className="h-[32px] w-[154px] rounded-[50px] bg-[#F3F3F3] flex items-center p-[2px] px-[2px]">
                    <div
                        onClick={() =>
                            document.getElementById(modalId).showModal()
                        }
                        style={{
                            backgroundColor: isResetColor
                                ? newdefaultColor
                                : color,
                        }}
                        className={`w-[28px] h-[28px] rounded-[50px] mx-1`}
                    ></div>
                    <span className="ml-[6px] text-[12px] xl:text-[16px] leading-[16px] font-light tracking-wide">
                        {isResetColor ? `${t("#ffffff")}` : color}
                    </span>
                </button>
                <dialog id={modalId} className="modal">
                    <div className="modal-box w-[300px] flex items-center justify-center">
                        <ChromePicker
                            color={color}
                            onChange={(updatedColor) => {
                                handleColorChange(updatedColor.hex);
                                setIsResetColor(false);
                            }}
                            onChangeComplete={(updatedColor) => {
                                handleColorChange(updatedColor.hex);
                                setIsResetColor(false);
                            }}
                        />
                    </div>
                    <form method="dialog" className="modal-backdrop">
                        <button>close</button>
                    </form>
                </dialog>
            </div>
        </div>
    );
};

export default EditorColorSelect;
