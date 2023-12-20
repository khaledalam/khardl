import React from "react"

const PrimarySelect = ({defaultValue, options, label}) => {
  return (
    <div className='flex flex-col gap-2'>
      {label && (
        <label className='text-[14px] font-normal text-neutral-700'>
          {label}
        </label>
      )}
      <select className='select  w-full max-w-[70%] bg-neutral-200'>
        <option disabled selected>
          {defaultValue}
        </option>
        {options &&
          options.map((option, idx) => (
            <option key={idx} value={option.value}>
              {option.text}
            </option>
          ))}
      </select>
    </div>
  )
}

export default PrimarySelect
