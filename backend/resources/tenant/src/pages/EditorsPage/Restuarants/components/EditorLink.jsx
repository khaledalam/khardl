import React, { useCallback, useState, useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import {
    mediaIconsToSelected,
    moveSelectedIconsToMedia,
    setSelectedSocialMediaId,
    updateSelectedIconInput,
} from "../../../../redux/NewEditor/restuarantEditorSlice";
import { useTranslation } from "react-i18next";
import { use } from "i18next";

const EditorLink = ({ defaultValue, options, handleChange, label }) => {
    const [currentValue, setCurrentValue] = useState(null);
    const dispatch = useDispatch();
    const { t } = useTranslation();

    const Language = useSelector((state) => state.languageMode.languageMode);

    const mediaCollection = useSelector(
        (state) => state.restuarantEditorStyle.mediaCollection
    );
    const selectedMediaId = useSelector(
        (state) => state.restuarantEditorStyle.selectedMediaId
    );

    const selectedSocialIcons = useSelector(
        (state) => state.restuarantEditorStyle.selectedSocialIcons
    );

    const handleMediaToSelected = (iconId) => {
        dispatch(mediaIconsToSelected(iconId));
    };
    const handleSocialMediaSelect = (id) => {
        dispatch(setSelectedSocialMediaId(id));
    };
    const handleRemoveMediaSelect = (id) => {
        dispatch(moveSelectedIconsToMedia(id));
    };
    useEffect(() => {
        selectedSocialIcons.map((socialIcon) => {
            handleMediaToSelected(socialIcon.id);
        });
    }, []);
    return (
        <div className="flex flex-col">
            <div
                className={`flex flex-row items-center w-[208px] xl:w-full justify-between`}
            >
                {label && (
                    <label className="text-[12px] xl:text-[16px] text-[rgba(17,24,39,0.54)] leading-[16px] font-medium ">
                        {label}
                    </label>
                )}
                <div className={`dropdown`}>
                    <div
                        className={`flex items-center h-[32px] w-[154px] rounded-[50px] bg-[#F3F3F3] ${
                            selectedSocialIcons.length == 0 && "pl-[16px]"
                        } relative`}
                    >
                        <div
                            className={`h-[32px] w-[32px] rounded-full border flex justify-center items-center ${
                                selectedSocialIcons.length == 0 && "hidden"
                            }`}
                        >
                            {mediaCollection?.find(
                            (socialIcon) =>
                            socialIcon.id === selectedMediaId
                            )?.imgUrl != null && <img
                                src={
                                    mediaCollection?.find(
                                        (socialIcon) =>
                                            socialIcon.id === selectedMediaId
                                    )?.imgUrl
                                }
                                alt="social media"
                                className="w-[20px] h-[20px] object-cover"
                            />}
                        </div>
                        <input
                            type="text"
                            value={
                                selectedSocialIcons?.find(
                                    (socialIcon) =>
                                        socialIcon.id === selectedMediaId
                                )?.link
                            }
                            onChange={(e) => {
                                dispatch(
                                    updateSelectedIconInput({
                                        id: selectedMediaId,
                                        link: e.target.value,
                                    })
                                );
                            }}
                            placeholder="URL..."
                            className="bg-[#F3F3F3] w-full focus:outline-none text-[12px] xl:text-[16px] leading-[16px] font-light text-[rgba(17,24,39,0.77)]"
                        />
                        <div
                            onClick={() =>
                                handleMediaToSelected(selectedMediaId)
                            }
                            className="h-[32px] w-[32px] rounded-full border flex justify-center items-center bg-white"
                        >
                            ✓
                        </div>
                    </div>
                </div>
            </div>
            <div className="flex flex-row items-center flex-wrap gap-3 w-full p-3 h-full ">
                {mediaCollection
                    .filter((media) => {
                        return selectedSocialIcons.some(
                            (socialIcon) => socialIcon.id != media.id
                        );
                    })
                    .map((media) => (
                        <div
                            className="w-[35px] h-[35px] rounded-full bg-[#F3F3F3] p-1 flex items-center justify-center"
                            key={media.id}
                        >
                            <img
                                src={media.imgUrl}
                                alt={media?.name ?? "social media"}
                                className="cursor-pointer w-[20px] h-[20px] object-cover"
                                onClick={() =>
                                    dispatch(setSelectedSocialMediaId(media.id))
                                }
                            />
                        </div>
                    ))}
            </div>
        </div>
    );
};

export default EditorLink;
