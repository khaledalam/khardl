import React from "react"

const PrimaryOriginSelect = ({
  defaultValue,
  options,
  label,
  handleChange,
  widthStyle,
}) => {
  return (
    <div className={`${widthStyle ? widthStyle : "w-[70%]"}`}>
      {label && (
        <label className='text-[14px] font-normal text-neutral-700'>
          {label}
        </label>
      )}
      <select
        onChange={handleChange}
        value={defaultValue}
        className='select select-ghost w-full max-w-full bg-neutral-100 active:bg-neutral-100 hover:bg-neutral-100 focus-visible:border-none focus-within:border-none outline-none'
      >
        <option disabled selected>
          font weight
        </option>
        {options.map((option, idx) => (
          <option key={idx} value={option.value}>
            {option.text}
          </option>
        ))}
      </select>
    </div>
  )
}

export default PrimaryOriginSelect
