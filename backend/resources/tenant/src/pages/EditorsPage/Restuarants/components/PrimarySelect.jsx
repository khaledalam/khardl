import React, {useCallback, useState} from "react"
import {BiChevronDown} from "react-icons/bi"

const PrimarySelect = ({
  defaultValue,
  options,
  handleChange,
  label,
  widthStyle,
}) => {
  const [isOpen, setisOpen] = useState(false)

  const handleDropdown = useCallback(() => {
    setisOpen((prev) => !prev)
  }, [])
  return (
    <div
      className={`flex flex-col gap-2 ${widthStyle ? widthStyle : "w-[70%]"}`}
    >
      {label && (
        <label className='text-[14px] font-normal text-neutral-700'>
          {label}
        </label>
      )}
      <div className={`dropdown w-full`}>
        <div
          tabIndex={0}
          role='button'
          onClick={() => handleDropdown()}
          className='btn h-[30px] flex items-center justify-between px-2  bg-neutral-100 active:bg-neutral-100 hover:bg-neutral-100'
        >
          <span className=''>{defaultValue}</span>
          <span className=''>
            <BiChevronDown size={22} />
          </span>
        </div>
        {isOpen && (
          <div
            tabIndex={0}
            className='dropdown-content z-[1] menu flex flex-col gap-4 p-2 shadow bg-base-100 rounded-box w-full max-h-[150px] overflow-x-hidden overflow-y-scroll !flex-nowrap hide-scroll'
          >
            {options &&
              options?.map((item, i) => (
                <div
                  className='flex w-full gap-3 items-center p-2 hover:bg-[#C0D12330]'
                  key={i}
                  onClick={() => {
                    handleChange(item.value)
                    handleDropdown()
                  }}
                >
                  <h3 className='text-[14px]'>{item.text}</h3>
                </div>
              ))}
          </div>
        )}
      </div>
    </div>
  )
}

export default PrimarySelect
