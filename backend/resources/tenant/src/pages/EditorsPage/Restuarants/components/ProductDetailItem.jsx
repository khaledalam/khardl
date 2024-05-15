import React, {
  Fragment,
  useState,
  forwardRef,
  useImperativeHandle,
  useEffect,
  useRef,
} from "react";
import { useTranslation } from "react-i18next";
import ReactDOM from "react-dom";

const ProductDetailItem = forwardRef(function ProductDetailItem(
  {
    price,
    label,
    onChange,
    language,
    id,
    name,
    isCheckbox,
    isRadio,
    isDropDown,
    options,
    optionsPrice,
  },
  ref
) {
  const { t } = useTranslation();

  const [selectValue, setSelectValue] = useState(null);

  useImperativeHandle(ref, () => ({
    resetDropdown() {
      setSelectValue(null);
    },
  }));

  const handleDropdownChange = (e) => {
    setSelectValue(e.target.value);
    onChange(e);
  };

  return (
    <Fragment>
      {isCheckbox && (
        <div className="form-control " key={id}>
          <label className="cursor-pointer flex items-center justify-between">
            <div className="flex flex-row items-center gap-2 ">
              <input
                id={id}
                type="checkbox"
                name={name}
                className={`custom-checkbox w-[16px] h-[16px] border-[1px]  checked:ring-1 rounded-[4px] accent-[#FFFFFF] border-[#FFFFFF] checked:border-[#7D0A0A] checked:accent-[#FFFFFF] focus:accent-[#FFFFFF] checked:ring-[#7D0A0A]`}
                onChange={onChange}
              />
              <p className="text-[10px] font-normal">{label}</p>
            </div>
            <span className="label-text text-[10px] font-semibold">
              {/* + {t("SAR")} */}
              {price}
            </span>
          </label>
        </div>
      )}
      {isRadio && (
        <div className="form-control  ">
          <label className="cursor-pointer flex items-center justify-between ">
            <div className="flex flex-row items-center gap-2 ">
              <input
                id={id}
                type={isRadio ? "radio" : "text"}
                name={name}
                className={`custom-radio ${
                  isRadio ? "radio" : ""
                } w-[14px] h-[14px] border-[1px] checked:border-[3px] checked:bg-[#7D0A0A]`}
                onChange={onChange}
              />
              <p className="text-[10px] font-normal">{label}</p>
            </div>
            <span className="label-text text-[10px] font-semibold">
              {/* + {t("SAR")}&nbsp; */}
              {price}
            </span>
          </label>
        </div>
      )}
      {isDropDown && (
        <select
          ref={ref}
          className="select w-full select-bordered cursor-pointer text-[10px] h-8"
          onChange={handleDropdownChange}
          value={selectValue}
        >
          <option disabled value="">
            {t("select option")}
          </option>
          {options.map((option, idx) => {
            console.log("optionsPrice > ", optionsPrice);
            let optionPrice = optionsPrice
              ? optionsPrice[idx] == 0
                ? "(Free)"
                : `(${optionsPrice[idx]} ${t("SAR")})`
              : null;

            return (
              <option key={idx} value={idx}>
                {`${
                  language === "en" ? option?.value[0] : option?.value[1]
                } ${optionPrice}`}
              </option>
            );
          })}
        </select>
      )}
    </Fragment>
  );
});

export default ProductDetailItem;
