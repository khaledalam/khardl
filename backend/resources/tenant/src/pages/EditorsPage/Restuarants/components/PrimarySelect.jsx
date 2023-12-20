import React, {useCallback, useState} from "react"
import {BiChevronDown} from "react-icons/bi"

const PrimarySelect = ({defaultValue, options, handleChange, label}) => {
  const [isOpen, setisOpen] = useState(false)

  const handleDropdown = useCallback(() => {
    setisOpen((prev) => !prev)
  }, [])
  return (
    <div className='flex flex-col gap-2'>
      {label && (
        <label className='text-[14px] font-normal text-neutral-700'>
          {label}
        </label>
      )}
      <div className='dropdown w-[70%]'>
        <div
          tabIndex={0}
          role='button'
          onClick={() => handleDropdown()}
          className='btn h-[30px] flex items-center justify-between px-2  bg-neutral-200 active:bg-neutral-200 hover:bg-neutral-200'
        >
          <span className=''>{defaultValue}</span>
          <span className=''>
            <BiChevronDown size={22} />
          </span>
        </div>
        {isOpen && (
          <div
            tabIndex={0}
            className='dropdown-content z-[1] menu flex flex-col gap-4 p-2 shadow bg-base-100 rounded-box w-full'
          >
            {options &&
              options?.map((item, i) => (
                <div
                  className='flex w-full gap-3 items-center p-2 hover:bg-[#C0D12330]'
                  key={i}
                  onClick={() => {
                    handleChange(item.text)
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
