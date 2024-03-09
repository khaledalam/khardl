import React, { useState, useEffect } from "react";
import { useSelector, useDispatch } from "react-redux";
import { AiOutlinePlus, AiOutlineMinus, AiOutlineClose } from "react-icons/ai";
import {
    MdOutlineAlignHorizontalLeft,
    MdOutlineAlignHorizontalRight,
    MdOutlineAlignHorizontalCenter,
} from "react-icons/md";
import Dropdown from "../Dropdown";
import { setLogo } from "../../redux/editor/logoSlice";
import {
    selectCategory,
    getSelectedCategory,
} from "../../redux/editor/categorySlice";
import { selectAlign, getSelectedAlign } from "../../redux/editor/alignSlice";
import {
    selectBanner,
    getSelectedBanner,
} from "../../redux/editor/bannerSlice";
import {
    updateIconInput,
    setSelectedIconId,
    updatePhoneNumber,
    moveFromMoreToIcons,
    moveFromIconsToMore,
} from "../../redux/editor/contactSlice.js";
import {
    BsTwitter,
    BsMessenger,
    BsWhatsapp,
    BsInstagram,
    BsFacebook,
    BsLinkedin,
    BsTiktok,
    BsYoutube,
    BsTelegram,
} from "react-icons/bs";
import { FaYoutube } from "react-icons/fa";
import { useTranslation } from "react-i18next";
import { Link } from "react-router-dom";

function Section() {
    const dispatch = useDispatch();
    const { icons, more_icons } = useSelector((state) => state.contact);
    const phoneNumber = useSelector((state) => state.contact.phoneNumber);
    const [showPopup, setShowPopup] = useState(false);
    const { t } = useTranslation();

    const handlePhoneNumberChange = (event) => {
        const newPhoneNumber = event.target.value;
        dispatch(updatePhoneNumber(newPhoneNumber));
    };
    const handleIconClick = (id) => {
        dispatch(setSelectedIconId(id));
    };

    const handleLogoChange = (event) => {
        const selectedLogo = event.target.files[0];

        if (selectedLogo) {
            dispatch(setLogo(URL.createObjectURL(selectedLogo)));
        }
    };
    const selectedCategory = useSelector(getSelectedCategory);
    const selectedAlign = useSelector(getSelectedAlign);
    const selectedBanner = useSelector(getSelectedBanner);
    const selectedIconId = useSelector((state) => state.contact.selectedIconId);
    const Language = useSelector((state) => state.languageMode.languageMode);
    // useEffect(() => {
    //     const newCategory = Language === 'en' ? 'Tabs' : 'مربعات';
    //     dispatch(selectCategory(newCategory));
    // }, [Language, dispatch]);
    const handleCategoryChange = (selectedCategory) => {
        dispatch(selectCategory(selectedCategory));
    };
    const handleAlignChange = (selectedAlign) => {
        dispatch(selectAlign(selectedAlign));
    };
    const handleBannerChange = (selectedBanner) => {
        dispatch(selectBanner(selectedBanner));
    };
    const handleMoveFromMoreToIcons = (iconId) => {
        dispatch(moveFromMoreToIcons(iconId));
    };

    const handleMoveFromIconsToMore = (iconId) => {
        dispatch(moveFromIconsToMore(iconId));
    };
    const iconComponents = {
        BsWhatsapp,
        BsMessenger,
        BsTwitter,
        BsInstagram,
        BsFacebook,
        BsLinkedin,
        BsTiktok,
        BsYoutube,
        BsTelegram,
        FaYoutube,
    };

    return (
        <div className="flex flex-col justify-between">
            <div className="">
                <div className="flex justify-between items-center p-4">
                    <div className="flex items-center gap-2 ">
                        <div className="text-[18px] font-semibold">
                            {t("Logo")}
                        </div>
                        <input
                            type="file"
                            accept="image/*"
                            id="Logo"
                            onChange={handleLogoChange}
                            className="hidden"
                        />
                        <label htmlFor="Logo" className={`cursor-pointer`}>
                            <div className="p-1 bg-[#C0D12325] border-[var(--primary)] text-[var(--primary)] border-[1px] rounded-full">
                                <AiOutlinePlus size={16} />
                            </div>
                        </label>
                    </div>
                    <div className="flex items-center gap-2">
                        <button
                            onClick={() =>
                                handleAlignChange(
                                    Language === "en" ? "Left" : "Right",
                                )
                            }
                            className={`
                            ${
                                selectedAlign === "Left" && Language === "en"
                                    ? "text-[var(--primary)]"
                                    : selectedAlign === "Right" &&
                                        Language === "ar"
                                      ? "text-[var(--primary)]"
                                      : ""
                            }
                            `}
                        >
                            {Language == "en" ? (
                                <MdOutlineAlignHorizontalLeft size={24} />
                            ) : (
                                <MdOutlineAlignHorizontalRight size={24} />
                            )}
                        </button>
                        <button
                            onClick={() => handleAlignChange("Center")}
                            className={`${selectedAlign === "Center" ? "text-[var(--primary)]" : ""}`}
                        >
                            <MdOutlineAlignHorizontalCenter size={24} />
                        </button>
                        <button
                            onClick={() =>
                                handleAlignChange(
                                    Language === "en" ? "Right" : "Left",
                                )
                            }
                            className={`
                            ${
                                selectedAlign === "Right" && Language === "en"
                                    ? "text-[var(--primary)]"
                                    : selectedAlign === "Left" &&
                                        Language === "ar"
                                      ? "text-[var(--primary)]"
                                      : ""
                            }
                            `}
                        >
                            {Language == "en" ? (
                                <MdOutlineAlignHorizontalRight size={24} />
                            ) : (
                                <MdOutlineAlignHorizontalLeft size={24} />
                            )}
                        </button>
                    </div>
                </div>
                <Dropdown
                    title={t("Banner")}
                    options={["Slider", "One Photo"]}
                    selectedValue={selectedBanner}
                    onSelect={(option) => handleBannerChange(option)}
                />
                <Dropdown
                    title={t("Category")}
                    options={["Tabs", "Carousel", "Right", "Left"]}
                    selectedValue={selectedCategory}
                    onSelect={(option) => handleCategoryChange(option)}
                />
            </div>
            <div className="p-4 pt-6">
                <div className="flex justify-between items-center">
                    <div className="text-[18px] font-semibold">
                        {t("Social Media")}
                    </div>
                    {more_icons.length > 0 && (
                        <div className="inline-block">
                            <button
                                className="bg-[#C0D12325] p-1 border-[var(--primary)] text-[var(--primary)] border-[1px] rounded-full h-fit"
                                onClick={() => setShowPopup(!showPopup)}
                            >
                                {showPopup ? (
                                    <AiOutlineMinus size={16} />
                                ) : (
                                    <AiOutlinePlus size={16} />
                                )}
                            </button>
                        </div>
                    )}
                </div>
                {showPopup && more_icons.length > 0 && (
                    <div className="flex items-center mt-3 flex-wrap justify-start bg-white text-black ring-1 ring-[var(--third)] p-2 rounded shadow">
                        {more_icons?.map((icon) => {
                            const IconComponent = iconComponents[icon.icon];
                            return (
                                <div
                                    key={icon.id}
                                    className={` ${icon.id === selectedIconId ? "!bg-transparent !border-0 " : ""} p-2 text-black rounded-full ${icon.id === selectedIconId ? "bg-[#00000080] border-2 border-[var(--primary)]" : ""} cursor-pointer`}
                                    onClick={() =>
                                        handleMoveFromMoreToIcons(icon.id)
                                    }
                                >
                                    <IconComponent size="18px" />
                                </div>
                            );
                        })}
                    </div>
                )}
                <div className="flex w-fit h-fit justify-center items-center gap-1 gap-y-0 mt-4 mb-2 flex-wrap">
                    {icons?.map((icon) => {
                        const IconComponent = iconComponents[icon.icon];
                        return (
                            <div
                                key={icon.id}
                                className={`relative p-[10px] rounded-[6px] ${icon.id === selectedIconId ? "bg-[#C0D12325] text-[var(--primary)] border-[1px] border-[var(--primary)]" : ""} cursor-pointer`}
                                onClick={() => handleIconClick(icon.id)}
                            >
                                <IconComponent size="18px" />
                                {icon.id === selectedIconId && (
                                    <button
                                        key={icon.id}
                                        className="absolute top-[-5px] right-[-4px] text-[10px] text-bold h-fit w-fit rounded-full bg-red-500 p-[3px] text-white"
                                        onClick={() =>
                                            handleMoveFromIconsToMore(icon.id)
                                        }
                                    >
                                        <AiOutlineClose />
                                    </button>
                                )}
                            </div>
                        );
                    })}
                </div>
                {icons?.map((icon) => (
                    <div key={icon.id}>
                        {icon.id === selectedIconId && (
                            <>
                                <input
                                    type="text"
                                    placeholder={
                                        Language == "en"
                                            ? icon.name + ` ${t("Link")}`
                                            : `${t("Link")} ` + icon.name
                                    }
                                    value={icon.Link}
                                    onChange={(e) =>
                                        dispatch(
                                            updateIconInput({
                                                id: icon.id,
                                                Link: e.target.value,
                                            }),
                                        )
                                    }
                                    className="mt-2 ring-1 ring-[var(--third)] text-black rounded-md p-2 text-[16px] w-[100%]"
                                />
                            </>
                        )}
                    </div>
                ))}
            </div>
            <div className="p-4 pt-0">
                <div className="text-[18px] font-semibold">{t("Phone")}</div>
                <input
                    type="tel"
                    value={phoneNumber}
                    onChange={handlePhoneNumberChange}
                    placeholder={t("Phone Number")}
                    className="mt-4 ring-1 ring-[var(--third)] text-black rounded-md p-2 text-[16px] w-[100%]"
                    maxLength={12}
                />
            </div>
        </div>
    );
}

export default Section;
