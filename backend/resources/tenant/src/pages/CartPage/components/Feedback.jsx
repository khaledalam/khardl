import React from "react";
import { PiNoteFill } from "react-icons/pi";
import { useTranslation } from "react-i18next";

const Feedback = ({
  value,
  onChange,
  placeholder,
  imgUrl,
  defaultValue,
  isDisabled = false,
  isReadOnly = false,
}) => {
  const { t } = useTranslation();
  return (
    <div className="border border-neutral-200 rounded-lg w-full h-[48px] flex items-center gap-2 px-2">
      {imgUrl ? (
        <div className="w-7 h-7">
          <img src={imgUrl} alt="" className="w-full h-full object-contain" />
        </div>
      ) : (
        <PiNoteFill size={28} className="border-r border-neutral-100" />
      )}
      <input
        type="text"
        disabled={isDisabled}
        readOnly={isReadOnly}
        placeholder={placeholder || t("Say something nice...")}
        value={value}
        defaultValue={defaultValue}
        onChange={onChange}
        className="input w-full disabled:bg-transparent h-full rounded-none outline-none border-none focus-visible:border-none focus-within:border-none focus-within:outline-none"
      />
    </div>
  );
};

export default Feedback;
