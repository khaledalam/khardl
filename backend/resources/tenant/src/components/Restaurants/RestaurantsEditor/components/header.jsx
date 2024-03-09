import React, { useState } from "react";
import { useSelector } from "react-redux";
import { MdOutlineDeliveryDining, MdOutlineDoneAll } from "react-icons/md";
import Toolbar from "./toolbar";
import Model from "./Model";
import { selectButtons } from "../../../../redux/editor/buttonSlice";
import { BiEditAlt } from "react-icons/bi";
import { AiOutlineClose } from "react-icons/ai";
import { LiaShoppingCartSolid } from "react-icons/lia";
import { globalColor } from "../../../../redux/editor/buttonSlice";
import Login from "./Login";
import { useTranslation } from "react-i18next";

function Header() {
    const buttons = useSelector(selectButtons);
    const [isOpen, setIsOpen] = useState(null);
    const [isOpenModel, setIsOpenModel] = useState(null);
    const cartItems = useSelector((state) => state.cart.items);
    const GlobalColor = useSelector(globalColor);
    const [showDetailesItem, setShowDetailesItem] = useState(false);
    const [isMenuOpen, setMenuOpen] = useState(false);
    const divWidth = useSelector((state) => state.divWidth.value);
    const styleDataRestaurant = useSelector(
        (state) => state.styleDataRestaurant,
    );

    const { t } = useTranslation();

    if (!styleDataRestaurant) return;

    function showMeDetailesItem() {
        if (!showDetailesItem) {
            setShowDetailesItem(true);
        } else {
            setShowDetailesItem(false);
        }
    }
    const handleEditClick = (buttonId) => {
        setIsOpen(buttonId);
    };
    const handleModelClick = (buttonId) => {
        setIsOpenModel(buttonId);
    };
    const toggleMenu = () => {
        setMenuOpen(!isMenuOpen);
    };
    const renderButton = (button, component, fill) => {
        const buttonStyle = {
            border: `1px solid ${button?.color}`,
            borderRadius: button?.shape,
            color: "black",
            backgroundColor: fill ? button?.color : "transparent",
        };

        return (
            <div className="relative">
                {buttons[2].id === button?.id ? (
                    <div>
                        <button
                            style={buttonStyle}
                            className="p-[6px] px-4 flex items-center justify-center gap-1 font-semibold"
                            onClick={showMeDetailesItem}
                        >
                            {t(button?.text)}
                        </button>
                        {button?.id === isOpen && (
                            <Toolbar
                                selectedText={t(button?.text)}
                                selectedColor={button?.color}
                                selectedShape={button?.shape}
                                buttonId={button?.id}
                                lastButton={true}
                            />
                        )}
                        {showDetailesItem && (
                            <Login
                                onClose={showMeDetailesItem}
                                onRequest={showMeDetailesItem}
                            />
                        )}
                        <button
                            key={button.id}
                            className={`absolute top-[-8px] right-[-4px] text-[15px] ring ring-white text-bold h-fit w-fit rounded-full ${isOpen && button.id === isOpen ? "bg-red-500" : "bg-blue-500"} p-[4px] text-white`}
                            onClick={() => handleEditClick(button.id)}
                        >
                            {isOpen && button.id === isOpen ? (
                                <AiOutlineClose />
                            ) : (
                                <BiEditAlt />
                            )}
                        </button>
                    </div>
                ) : (
                    <div>
                        <button
                            style={buttonStyle}
                            className="p-[6px] px-4 flex items-center justify-center gap-1 font-semibold"
                            onClick={() => handleModelClick(button.id)}
                        >
                            {component}
                            {button.id === isOpenModel ? (
                                <Model
                                    selectedText={t(button.text)}
                                    selectedColor={button.color}
                                    selectedShape={button.shape}
                                    buttonId={button.id}
                                />
                            ) : (
                                <div></div>
                            )}
                            {t(button.text)} <small>(test branch)</small>
                        </button>
                        {button.id === isOpen ? (
                            <div>
                                <Toolbar
                                    selectedText={t(button.text)}
                                    selectedColor={button.color}
                                    selectedShape={button.shape}
                                    buttonId={button.id}
                                />
                            </div>
                        ) : (
                            <div></div>
                        )}
                        <button
                            key={button.id}
                            className={`absolute top-[-8px] right-[-4px] text-[15px] ring ring-white text-bold h-fit w-fit rounded-full ${isOpen && button.id === isOpen ? "bg-red-500" : "bg-blue-500"} p-[4px] text-white`}
                            onClick={() => handleEditClick(button.id)}
                        >
                            {isOpen && button.id === isOpen ? (
                                <AiOutlineClose />
                            ) : (
                                <BiEditAlt />
                            )}
                        </button>
                    </div>
                )}
            </div>
        );
    };

    return (
        <div
            className={`flex items-start justify-between ${divWidth <= 400 ? "px-2" : ""} p-[10px] px-4 bg-[var(--secondary)]`}
        >
            <div className=" flex flex-col">
                <div className={`relative ${divWidth >= 800 ? "hidden" : ""}`}>
                    <label
                        className={` hamburger ${isMenuOpen ? "absolute top-[5px] z-[999999999]" : ""}`}
                        style={{
                            stroke: "#000000",
                        }}
                    >
                        <input
                            type="checkbox"
                            checked={isMenuOpen}
                            onChange={toggleMenu}
                        />
                        <svg viewBox="0 0 32 32">
                            <path
                                className="line line-top-bottom"
                                d="M27 10 13 10C10.8 10 9 8.2 9 6 9 3.5 10.8 2 13 2 15.2 2 17 3.8 17 6L17 26C17 28.2 18.8 30 21 30 23.2 30 25 28.2 25 26 25 23.8 23.2 22 21 22L7 22"
                            ></path>
                            <path className="line" d="M7 16 27 16"></path>
                        </svg>
                    </label>
                </div>
                <div
                    className={`${divWidth >= 800 ? "flex items-center justify-between gap-2" : isMenuOpen ? "block" : "hidden"}`}
                >
                    <div
                        className={`${divWidth <= 800 ? "flex-col mt-16" : ""} flex gap-2`}
                    >
                        {renderButton(
                            buttons[1],
                            <MdOutlineDoneAll size={20} />,
                        )}
                        {renderButton(
                            buttons[0],
                            <MdOutlineDeliveryDining size={20} />,
                        )}
                    </div>
                </div>
            </div>
            <div className="flex items-center justify-end gap-4">
                <button
                    className="relative p-1"
                    style={{
                        border: `1px solid ${GlobalColor}`,
                        borderRadius: "100%",
                    }}
                >
                    <LiaShoppingCartSolid size={26} />
                    <span className="absolute top-[-7px] right-[-6px] text-[10px] text-bold h-[20px] w-[20px] rounded-full bg-red-500 text-white">
                        <div>{cartItems.length}</div>
                    </span>
                </button>
                {renderButton(buttons[2], <div></div>, true)}
                {isOpen !== null && (
                    <button
                        onClick={() => setIsOpen(null)}
                        className="w-full h-full fixed inset-0 z-[100] transition-all duration-500"
                        style={{ display: isOpen ? "block" : "none" }}
                    ></button>
                )}
                {isOpenModel !== null && (
                    <button
                        onClick={() => setIsOpenModel(null)}
                        className="w-full h-full fixed inset-0 z-[80] transition-all duration-500"
                        style={{ display: isOpenModel ? "block" : "none" }}
                    ></button>
                )}
            </div>
        </div>
    );
}

export default Header;
