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
                        <p className="text-[10px] font-normal">{label}</p>
                        <div className="flex flex-row items-center gap-2 ">
                            <span className="label-text text-[10px] font-semibold">
                                + {t("SAR")}
                                {price}
                            </span>
                            <input
                                id={id}
                                type={isCheckbox ? "checkbox" : "text"}
                                name={name}
                                className={`${
                                    isCheckbox ? "" : ""
                                } w-[16px] h-[16px] border-[1px] checked:bg-[#7D0A0A]`}
                                onChange={onChange}
                            />
                        </div>
                    </label>
                </div>
            )}
            {isRadio && (
                <div className="form-control  ">
                    <label className="cursor-pointer flex items-center justify-between ">
                        <p className="text-[10px] font-normal">{label}</p>
                        <div className="flex flex-row items-center gap-2 ">
                            <span className="label-text text-[10px] font-semibold">
                                + {t("SAR")}&nbsp;{price}
                            </span>
                            <input
                                id={id}
                                type={isRadio ? "radio" : "text"}
                                name={name}
                                className={`${
                                    isRadio ? "radio" : ""
                                } w-[12px] h-[12px] border-[1px] checked:border-[3px] checked:bg-[#7D0A0A]`}
                                onChange={onChange}
                            />
                        </div>
                    </label>
                </div>
            )}
            {isDropDown && (
                <select
                    ref={ref}
                    className="select w-full max-w-[90%] select-bordered cursor-pointer"
                    onChange={handleDropdownChange}
                    value={selectValue}
                >
                    <option disabled value="">
                        select option
                    </option>
                    {options.map((option, idx) => (
                        <option key={idx} value={idx}>
                            {`${
                                language === "en"
                                    ? option.value[0]
                                    : option.value[1]
                            } (${optionsPrice[idx]} ${t("SAR")})`}
                        </option>
                    ))}
                </select>
            )}
        </Fragment>
    );
});

export default ProductDetailItem;
