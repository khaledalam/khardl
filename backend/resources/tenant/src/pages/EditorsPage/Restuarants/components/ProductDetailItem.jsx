import React, {Fragment} from "react"
import { useTranslation } from "react-i18next";


const ProductDetailItem = ({
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
}) => {
  const { t } = useTranslation();

  return (
    <Fragment>
      {isCheckbox && (
        <div className='form-control ' key={id}>
          <label className='label cursor-pointer flex items-center justify-between'>
            <p className='text-sm'>{label}</p>
            <div className='flex flex-row items-center gap-2 '>
              <span className='label-text'>+ {t('SAR')}{price}</span>
              <input
                id={id}
                type={isCheckbox ? "checkbox" : "text"}
                name={name}
                className={`${
                  isCheckbox ? "checkbox" : ""
                } w-[1.38rem] h-[1.38rem] border-[3px] checked:bg-[#2A6E4F]`}
                onChange={onChange}
              />
            </div>
          </label>
        </div>
      )}
      {isRadio && (
        <div className='form-control  '>
          <label className='label cursor-pointer flex items-center justify-between '>
            <p className='text-sm'>{label}</p>
            <div className='flex flex-row items-center gap-2 '>
              <span className='label-text'>+ {t('SAR')}&nbsp;{price}</span>
              <input
                id={id}
                type={isRadio ? "radio" : "text"}
                name={name}
                className={`${
                  isRadio ? "radio" : ""
                } w-[1.38rem] h-[1.38rem] border-[3px] checked:bg-[#2A6E4F]`}
                onChange={onChange}
              />
            </div>
          </label>
        </div>
      )}
      {isDropDown && (
        <select
          className='select w-full max-w-[90%] select-bordered cursor-pointer'
          onChange={onChange}
          defaultValue=""
        >
          <option disabled value="">
            select option
          </option>
          {options.map((option, idx) => (
            <option key={idx} value={idx}>
              {language === "en" ? option.value[0] : option.value[1]}
            </option>
          ))}
        </select>
      )}
    </Fragment>
  )
}

export default ProductDetailItem
