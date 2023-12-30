import React from "react"

const PrimarySelectWithIcon = ({
  imgUrl,
  text,
  options,
  placeholder,
  onChange,
}) => {
  return (
    <div className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border border-[#C0D123] items-center cursor-pointer '>
      <div className='bg-[#C0D123] flex items-center gap-1  border-r border-[#C0D123]'>
        <div className='w-[50px] h-[50px] rounded-xl flex items-center justify-center'>
          <img src={imgUrl} alt='deliveryIcon' />
        </div>
        <h3 className='capitalize pr-2 w-max'>{text}</h3>
      </div>
      <select
        onChange={onChange}
        className='select select-ghost border-none focus-visible:border-none focus-visible:bg-transparent focus-visible:outline-none focus-within:border-none outline-none w-full max-w-full'
      >
        <option disabled selected>
          {placeholder}
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

export default PrimarySelectWithIcon
