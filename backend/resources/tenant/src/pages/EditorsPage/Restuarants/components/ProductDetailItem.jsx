import React from "react"

const ProductDetailItem = ({isChecked, price, onChecked, name}) => {
  return (
    <div>
      <div className='form-control '>
        <label className='label cursor-pointer flex items-center justify-between'>
          <p className='text-sm'>{name}</p>
          <div className='flex flex-row items-center gap-2 '>
            <span className='label-text'>+ SAR {price}</span>
            <input
              type='radio'
              name={"radio-" + name}
              className='radio w-[1.38rem] h-[1.38rem] border-[3px] checked:bg-[#2A6E4F]'
              checked={isChecked}
              onChange={onChecked}
            />
          </div>
        </label>
      </div>
    </div>
  )
}

export default ProductDetailItem
