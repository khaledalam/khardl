import React, { useState } from "react";
import { updateButton } from "../../../../redux/editor/buttonSlice";
import { useSelector, useDispatch } from "react-redux";

const Toolbar = ({
    selectedText,
    selectedShape,
    buttonId,
    lastButton,
    selectedColor,
}) => {
    const [editedText, setEditedText] = useState(selectedText);
    const [editedShape, setEditedShape] = useState(selectedShape);
    const [GlobalColor, setGlobalColor] = useState(selectedColor);
    const Language = useSelector((state) => state.languageMode.languageMode);
    const dispatch = useDispatch();
    const handleButonChange = (buttonId, newText, newColor, newShape) => {
        dispatch(updateButton({ id: buttonId, newText, newColor, newShape }));
    };
    return (
        <div
            className={`
        ${Language == "en" ? (lastButton === true ? "right-0" : "left-0") : lastButton === true ? "left-0" : "right-0"}
        absolute bottom-[-140px] z-[999999999999999999] p-3 bg-white rounded-lg text-black shadow-[0_-1px_10px_rgba(0,0,0,0.12)]`}
        >
            <div className="flex justify-center items-center gap-2 gap-y-3 flex-wrap w-[180px]">
                <div className="flex justify-between items-center gap-4 w-[180px]">
                    <div>Text</div>
                    <input
                        type="text"
                        value={editedText}
                        className="rounded-[4px] py-1 px-2 text-black w-[100%]"
                        style={{ border: `2px solid ${GlobalColor}` }}
                        onChange={(e) => {
                            setEditedText(e.target.value);
                            handleButonChange(
                                buttonId,
                                e.target.value,
                                GlobalColor,
                                editedShape,
                            );
                        }}
                    />
                </div>
                <div className="flex justify-between items-center gap-2 w-[180px]">
                    <div>Color</div>
                    <input
                        type="color"
                        className="rounded-[2px] px-2 border-0 shadow-md w-[100%]"
                        style={{ backgroundColor: GlobalColor }}
                        value={GlobalColor}
                        onChange={(e) => {
                            setGlobalColor(e.target.value);
                            handleButonChange(
                                buttonId,
                                editedText,
                                e.target.value,
                                editedShape,
                            );
                        }}
                    />
                </div>
                <div className="flex justify-center items-center gap-2">
                    <button
                        value="0px"
                        onClick={(e) => {
                            setEditedShape("0px");
                            handleButonChange(
                                buttonId,
                                editedText,
                                GlobalColor,
                                e.target.value,
                            );
                        }}
                        className={`bg-[var(--secondary)] p-1 border-[var(--third)]  border-[2px] w-10 h-6`}
                        style={
                            editedShape === "0px"
                                ? {
                                      backgroundColor: GlobalColor,
                                      border: `2px solid ${GlobalColor}`,
                                  }
                                : {}
                        }
                    ></button>
                    <button
                        value="8px"
                        onClick={(e) => {
                            setEditedShape("8px");
                            handleButonChange(
                                buttonId,
                                editedText,
                                GlobalColor,
                                e.target.value,
                            );
                        }}
                        className={`bg-[var(--secondary)] p-1 rounded-[8px] border-[var(--third)]  border-[2px] w-10 h-6`}
                        style={
                            editedShape === "8px"
                                ? {
                                      backgroundColor: GlobalColor,
                                      border: `2px solid ${GlobalColor}`,
                                  }
                                : {}
                        }
                    ></button>
                    <button
                        value="20px"
                        onClick={(e) => {
                            setEditedShape("20px");
                            handleButonChange(
                                buttonId,
                                editedText,
                                GlobalColor,
                                e.target.value,
                            );
                        }}
                        className={`bg-[var(--secondary)] p-1 rounded-full border-[var(--third)]  border-[2px] w-10 h-6`}
                        style={
                            editedShape === "20px"
                                ? {
                                      backgroundColor: GlobalColor,
                                      border: `2px solid ${GlobalColor}`,
                                  }
                                : {}
                        }
                    ></button>
                </div>
            </div>
        </div>
    );
};

export default Toolbar;
