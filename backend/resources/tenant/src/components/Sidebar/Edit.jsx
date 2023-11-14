import React, { useState, useEffect } from 'react';
import Shape from './Shape';
import { FaAlignLeft, FaAlignRight, FaAlignJustify } from 'react-icons/fa';
import { useSelector, useDispatch } from 'react-redux';
import { changeImageShape } from '../../redux/editor/shapeImageSlice';
import { selectButtons, updateButton, updateGlobalButtons } from '../../redux/editor/buttonSlice';
import { selectAlignText } from '../../redux/editor/alignTextSlice';
import { useTranslation } from "react-i18next";
import { MdKeyboardArrowDown } from 'react-icons/md';
import { setFontsList, setSelectedFontFamily, setSelectedFontWeight } from '../../redux/editor/fontsSlice';

function Edit() {
    const [GlobalColor, setGlobalColor] = useState('#C0D123');
    const [activeShape, setActiveShape] = useState("Rounded");
    const [activeImgShape, setActiveImgShape] = useState("SharpIMG");
    const buttons = useSelector(selectButtons);
    const fontsList = useSelector((state) => state.fonts.fontsList);
    const Language = useSelector((state) => state.languageMode.languageMode);
    const selectedAlignText = useSelector((state) => state.alignText.selectedAlignText);
    const selectedFontWeight = useSelector((state) => state.fonts.selectedFontWeight);

    const dispatch = useDispatch();
    const { t } = useTranslation();
    useEffect(() => {
        fetch('https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyCAQ84qDJQa8z0n-jwL3DzAdV-prndG4-s')
            .then(response => response.json())
            .then(data => {
                dispatch(setFontsList(data.items));
            })
            .catch(error => {
                console.error('Error fetching fonts:', error);
            });
    }, []);
    const handleGlobalColorChange = (GlobalColor) => {
        buttons.forEach((button) => {
            dispatch(updateButton({ id: button.id, newText: button.text, newColor: GlobalColor, newShape: button.shape }));
        });
        dispatch(updateGlobalButtons({ newGlobalColor: GlobalColor }));
    };
    const handleGlobalShapeChange = (GlobalShape) => {
        buttons.forEach((button) => {
            dispatch(updateButton({ id: button.id, newText: button.text, newColor: button.color, newShape: GlobalShape }));
        });
        dispatch(updateGlobalButtons({ newGlobalColor: GlobalColor, newGlobalShape: GlobalShape }));
    };
    const handleAlignTextChange = selectedAlign => {
        dispatch(selectAlignText(selectedAlign));
    };
    const handleFontChange = (event) => {
        dispatch(setSelectedFontFamily(event.target.value));
    };
    const handleFontWeightChange = (event) => {
        let fontWeight = 'normal';
        switch (event.target.value) {
            case `${t("Thin")}`:
                fontWeight = 'lighter';
                break;
            case `${t("Medium")}`:
                fontWeight = 'normal';
                break;
            case `${t("Bold")}`:
                fontWeight = 'bold';
                break;
            default:
                fontWeight = 'normal';
        }
        dispatch(setSelectedFontWeight(fontWeight));
    };
    const handleShapeImageClick = newImageShape => {
        dispatch(changeImageShape(newImageShape));
    };
    return (
        <div className="">
            <div className="flex justify-between items-center p-4 pt-6 pb-2">
                <div className='text-[18px] font-semibold'>{t("Color")}</div>
                <input
                    className='rounded-[2px] px-2 border-0 shadow-md '
                    style={{ backgroundColor: GlobalColor }}
                    type="color"
                    value={GlobalColor}
                    onChange={(e) => { setGlobalColor(e.target.value); handleGlobalColorChange(e.target.value) }}
                />
            </div>
            <div className="p-4 py-2">
                <div className="text-[18px] font-semibold">{t("Shape")}</div>
                <div className="text-[14px] mt-[-4px]">{t("Buttons and form fields")}</div>
                <div className="flex justify-start items-center flex-wrap mt-2 gap-2 ">
                    <Shape component={
                        <div className="flex justify-between items-center px-1 gap-2">
                            <div className="text-[16px]">{t("Sharp")}</div>
                            <Shape component={<div className="w-3 h-2"/>} contentClassName="rounded-none bg-[var(--third)] px-1"
                                active={activeShape === "sharp"}
                            />
                        </div>
                    } contentClassName="min-w-[45%]"
                        onClick={() => {
                            handleGlobalShapeChange("0px");
                            setActiveShape("sharp");
                        }}
                        active={activeShape === "sharp"}
                    />
                    <Shape component={
                        <div className="flex justify-between items-center px-1 gap-2">
                            <div className="text-[16px]">{t("Rounded")}</div>
                            <Shape component={<div className="w-3 h-2"></div>} contentClassName="!rounded-[4px] bg-[var(--third)] px-1"
                                active={activeShape === "Rounded"}
                            />
                        </div>
                    } contentClassName="min-w-[45%]"
                        onClick={() => {
                            handleGlobalShapeChange("6px");
                            setActiveShape("Rounded");
                        }}
                        active={activeShape === "Rounded"}
                    />
                    <Shape component={
                        <div className="flex justify-between items-center px-1 gap-2">
                            <div className="text-[16px]">{t("Pill")}</div>
                            <Shape component={<div className="w-3 h-2"></div>} contentClassName="!rounded-full bg-[var(--third)]  px-1"
                                active={activeShape === "Pill"}
                            />
                        </div>
                    } contentClassName="min-w-[45%]"
                        onClick={() => {
                            handleGlobalShapeChange("20px");
                            setActiveShape("Pill");
                        }}
                        active={activeShape === "Pill"}
                    />
                </div>
            </div>
            <div className="p-4 py-2">
                <div className="text-[18px] font-semibold">{t("Images")}</div>
                <div className="flex justify-start items-center flex-wrap mt-2 gap-2 ">
                    <Shape component={
                        <div className="flex justify-between items-center px-1 ">
                            <div className="text-[16px]">{t("Sharp")}</div>
                            <Shape component={<div className="w-3 h-2"></div>} contentClassName="rounded-none bg-[var(--third)] px-1"
                                active={activeImgShape === "SharpIMG"}
                            />
                        </div>
                    } contentClassName="min-w-[45%]"
                        onClick={() => {
                            handleShapeImageClick("0px");
                            setActiveImgShape("SharpIMG");
                        }}
                        active={activeImgShape === "SharpIMG"}
                    />
                    <Shape component={
                        <div className="flex justify-between items-center px-1 gap-2">
                            <div className="text-[16px]">{t("Rounded")}</div>
                            <Shape component={<div className="w-3 h-2"></div>} contentClassName="!rounded-[4px] bg-[var(--third)] px-1"
                                active={activeImgShape === "RoundedIMG"}
                            />
                        </div>
                    } contentClassName="min-w-[45%]"
                        onClick={() => {
                            handleShapeImageClick("14px");
                            setActiveImgShape("RoundedIMG");
                        }}
                        active={activeImgShape === "RoundedIMG"}
                    />
                </div>
            </div>
            <div className="p-4 py-2">
                <div className="text-[18px] font-semibold">{t("Fonts")}</div>
                <div className='mt-2 flex flex-col gap-2'>
                    <div className='relative w-[100%]'>
                        <select onChange={handleFontChange} className='text-[14px] bg-[var(--secondary)]  w-[100%] p-1 rounded-full px-4 appearance-none'>
                            {fontsList.map((font, i) => (
                                <option
                                    key={i}
                                    style={{ fontFamily: `${font.family}` }}
                                    className="bg-white text-black" value={font.family}>{font.family}</option>
                            ))}
                        </select>
                        <MdKeyboardArrowDown className={`absolute top-1/2 ${Language == "en" ? "right-4" : "left-4"} transform -translate-y-1/2 text-black`} />
                    </div>
                    <div className='flex items-center justify-start gap-2'>
                        <div className='relative  w-[100%]'>
                            <select
                                onChange={handleFontWeightChange}
                                className='text-[14px] bg-[var(--secondary)]  w-[100%] p-1 rounded-full px-4 appearance-none'>
                                {["Thin", "Medium", "Bold"].map((option, index) => (
                                    <option className="bg-white text-black" key={index}>{t(option)}</option>
                                ))}
                            </select>
                            <MdKeyboardArrowDown className={`absolute top-1/2 ${Language == "en" ? "right-4" : "left-4"} transform -translate-y-1/2 text-black`} />
                        </div>
                        <div className='max-w-[80px] relative w-[100%]'>
                            <select className='text-[14px] bg-[var(--secondary)]  w-[100%] p-1 rounded-full px-4 appearance-none'>
                                {[...Array(5)].map((option, index) => (
                                    <option className="bg-white text-black" value="" key={index}>{index + 1}</option>
                                ))}
                            </select>
                            <MdKeyboardArrowDown className={`absolute top-1/2 ${Language == "en" ? "right-4" : "left-4"} transform -translate-y-1/2 text-black`} />
                        </div>
                    </div>
                </div>
                <div className='flex justify-center items-center gap-6 mt-6'>
                    <button
                        onClick={() => handleAlignTextChange(Language === "en" ? "Left" : "Right")}
                        className={`
                    ${selectedAlignText === "Left" && Language === "en" ? "text-[var(--primary)]"
                                :
                                selectedAlignText === "Right" && Language === "ar" ? "text-[var(--primary)]" : ""}
                    `}
                    >
                        {Language == "en" ?
                            <FaAlignLeft size={22} />
                            :
                            <FaAlignRight size={22} />
                        }
                    </button>
                    <button
                        onClick={() => handleAlignTextChange("Center")}
                        className={`${selectedAlignText === "Center" ? "text-[var(--primary)]" : ""}`}
                    >
                        <FaAlignJustify size={22} />
                    </button>
                    <button
                        onClick={() => handleAlignTextChange(Language === "en" ? "Right" : "Left")}
                        className={`
                    ${selectedAlignText === "Right" && Language === "en" ? "text-[var(--primary)]"
                                :
                                selectedAlignText === "Left" && Language === "ar" ? "text-[var(--primary)]" : ""}
                    `}
                    >
                        {Language == "en" ?
                            <FaAlignRight size={22} />
                            :
                            <FaAlignLeft size={22} />
                        }
                    </button>
                </div>
            </div>
        </div>
    );
}

export default Edit;
