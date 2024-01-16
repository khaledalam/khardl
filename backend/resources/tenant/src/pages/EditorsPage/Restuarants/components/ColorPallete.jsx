import React, { useState } from "react";
import { ChromePicker } from "react-color";
import { IoIosClose } from "react-icons/io";

const ColorPallete = ({
  color,
  handleColorChange,
  defaultColor = "#ffffff",
  modalId,
}) => {
  const [isResetColor, setIsResetColor] = useState(false);

  return (
    <div className="w-[50%]">
      <button className="btn hover:bg-neutral-100 w-full h-[40px] flex items-center justify-between p-1 px-2">
        <div
          onClick={() => document.getElementById(modalId).showModal()}
          style={{ backgroundColor: isResetColor ? defaultColor : color }}
          className={`w-7 h-7 rounded-lg`}
        ></div>
        <span className="tracking-wide">{color}</span>
        <IoIosClose
          size={24}
          onClick={() => {
            setIsResetColor(true);
            handleColorChange(defaultColor);
          }}
        />
      </button>
      <dialog id={modalId} className="modal">
        <div className="modal-box w-[300px] flex items-center justify-center">
          <ChromePicker
            color={color}
            onChange={(updatedColor) => {
              handleColorChange(updatedColor.hex);
            }}
            onChangeComplete={(updatedColor) => {
              handleColorChange(updatedColor.hex);
            }}
          />
        </div>
        <form method="dialog" className="modal-backdrop">
          <button>close</button>
        </form>
      </dialog>
    </div>
  );
};

export default ColorPallete;
