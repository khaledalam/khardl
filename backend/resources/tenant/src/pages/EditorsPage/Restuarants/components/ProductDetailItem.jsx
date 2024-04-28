import React, {
    Fragment,
    useState,
    forwardRef,
    useImperativeHandle,
} from "react";
import { useTranslation } from "react-i18next";

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

    const [selectValue, setSelectValue] = useState("");

    useImperativeHandle(ref, () => ({
        resetDropdown() {
            setSelectValue("");
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
                                className={`w-[16px] h-[16px] accent-[#FFECD6] border-[1px] border-[#e5e7eb] checked:border-[#7D0A0A] rounded-[4px] checked:accent-[#FFECD6] focus:accent-[#FFECD6] checked:ring-1 checked:ring-[#7D0A0A]`}
                                onChange={onChange}
                            />
                            <p className="text-[14px] font-normal">{label}</p>
                        </div>
                        <span className="label-text text-[14px] font-semibold">
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
                                className={`${
                                    isRadio ? "radio" : ""
                                } w-[14px] h-[14px] border-[1px] checked:border-[3px] checked:bg-[#7D0A0A]`}
                                onChange={onChange}
                            />
                            <p className="text-[14px] font-normal">{label}</p>
                        </div>
                        <span className="label-text text-[14px] font-semibold">
                            {/* + {t("SAR")}&nbsp; */}
                            {price}
                        </span>
                    </label>
                </div>
            )}
            {isDropDown && (
                <select
                    ref={ref}
                    className="select w-full select-bordered cursor-pointer"
                    onChange={handleDropdownChange}
                    value={selectValue}
                >
                    <option disabled value="">
                        {t("select option")}
                    </option>
                    {options.map((option, idx) => {
                        console.log('optionsPrice > ' , optionsPrice);
                        let price = optionsPrice ? `(${optionsPrice[idx]} ${t("SAR")})` : null;

                        return (
                            <option key={idx} value={idx}>
                                {`${
                                    language === "en"
                                        ? option?.value[0]
                                        : option?.value[1]
                                } ${price}`}
                            </option>
                        )
                    })}
                </select>
            )}
        </Fragment>
    );
});

export default ProductDetailItem;
