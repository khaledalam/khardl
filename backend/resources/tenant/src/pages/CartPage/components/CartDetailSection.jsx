import React, { useEffect } from "react";
import { RadioButton } from "primereact/radiobutton";
import { useTranslation } from "react-i18next";
import { useSelector } from "react-redux";

const CartDetailSection = ({
  name,
  onChange,
  isChecked,
  img,
  displayName,
  disabled,
}) => {
  const { t } = useTranslation();

  const restaurantEditorStyle = useSelector(
    (state) => state.restuarantEditorStyle
  );

  useEffect(() => {
    console.log(
      "PRICE_BACKGROUND_COLOR",
      restaurantEditorStyle.price_background_color
    );
  }, [restaurantEditorStyle]);

  return (
    <div key={name} className="flex align-items-center mt-4">
      <style jsx>{`
        .custom-radiobutton.p-highlight .p-radiobutton-box {
          background-color: ${restaurantEditorStyle?.price_background_color ||
          "#e5e7eb"};
        }
      `}</style>
      <RadioButton
        inputId={name}
        name={name}
        value={name}
        onChange={onChange}
        checked={isChecked}
        disabled={disabled}
        className="custom-radiobutton"
      />
      <label htmlFor={name} className="flex mx-2">
        {img && (
          <img
            src={img}
            alt={displayName}
            width={25}
            height={25}
            className="mx-2"
          />
        )}
        {t(displayName)}
      </label>
    </div>
  );
};

export default CartDetailSection;
