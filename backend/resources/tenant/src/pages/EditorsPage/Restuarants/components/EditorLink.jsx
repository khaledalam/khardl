import React, { useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import {
  mediaIconsToSelected,
  updateSelectedIconInput,
} from "../../../../redux/NewEditor/restuarantEditorSlice";
import { cn } from "../../../../utils/styles";
import {useTranslation} from "react-i18next";

const EditorLink = ({ label }) => {

  const { t } = useTranslation();

  const dispatch = useDispatch();
  const { mediaCollection, selectedSocialIcons } = useSelector(
    (state) => state.restuarantEditorStyle,
  );



  const usedMediaIds = selectedSocialIcons.map((socialIcon) =>
    parseInt(socialIcon.id),
  );

  const availableMedias = mediaCollection.filter(
    (media) => !usedMediaIds.includes(media.id),
  );

  const [currentValue, setCurrentValue] = useState("");
  const [selectedMediaId, setSelectedMediaId] = useState(
    availableMedias[0]?.id,
  );

  const hasNoSelected = !setSelectedMediaId;
  const selectedMedia = mediaCollection?.find(
    (socialIcon) => socialIcon.id === selectedMediaId,
  );

  const handleInputKeyDown = (e) => {
    if (e.key === "Enter") {
      handleMediaToSelected();
    }
  };

  const handleMediaToSelected = () => {
    dispatch(mediaIconsToSelected(selectedMediaId));
    dispatch(
      updateSelectedIconInput({ id: selectedMediaId, link: currentValue }),
    );

    setCurrentValue("");
    setSelectedMediaId(availableMedias[1]?.id);
  };

  return (
    <div className="flex flex-col">
      <div className="flex items-center max-w-full gap-4">
        {label && (
          <label className="text-xs xl:text-base text-[rgba(17,24,39,0.54)] font-medium shrink-0">
            {label}
          </label>
        )}

        {/* Link Input */}
        <div
          className={cn(
            `flex flex-auto items-center h-8 rounded-full bg-[#F3F3F3] relative`,
            { "pl-4": hasNoSelected },
          )}
        >
          <div
            className={cn(
              "h-8 w-8 rounded-full border inline-flex justify-center items-center shrink-0",
              { hidden: hasNoSelected },
            )}
          >
            {selectedMedia?.imgUrl && (
              <img
                src={selectedMedia.imgUrl}
                alt="social media"
                className="w-5 h-5 object-cover"
              />
            )}
          </div>
          <input
            className="bg-transparent outline-none text-xs flex-grow pl-1 xl:text-base font-light text-[rgba(17,24,39,0.77)]"
            type="url"
            size={10}
            placeholder={t("URL") + '...'}
            value={currentValue}
            onKeyDown={handleInputKeyDown}
            onChange={(e) => setCurrentValue(e.target.value)}
          />
          <button
            onClick={() => handleMediaToSelected()}
            className="h-8 w-8 rounded-full border inline-flex justify-center items-center bg-white shrink-0"
          >
            ✓
          </button>
        </div>
      </div>

      {/* Social Media Icons List */}
      <div className="flex flex-row items-center flex-wrap gap-3 w-full p-3 h-full ">
        {availableMedias.map((media) => (
          <div
            className="w-9 h-9 rounded-full bg-[#F3F3F3] p-1 flex items-center justify-center"
            key={media.id}
          >
            <img
              src={media.imgUrl}
              alt={media?.name ?? "social media"}
              className="cursor-pointer w-5 h-5 object-cover"
              onClick={() => setSelectedMediaId(media.id)}
            />
          </div>
        ))}
      </div>
    </div>
  );
};

export default EditorLink;
