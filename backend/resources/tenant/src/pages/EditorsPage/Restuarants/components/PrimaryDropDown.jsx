import React from "react"
import {BiChevronDown} from "react-icons/bi"
import tempImg from "../../../../assets/imageIcon.svg"

const PrimaryDropDown = ({dropdownList, defaultValue}) => {
  return (
    <div className='dropdown w-full'>
      <div
        tabIndex={0}
        role='button'
        className='btn h-[30px] flex items-center  bg-white active:bg-white hover:bg-white'
      >
        <span className=''>{defaultValue}</span>
        <span className=''>
          <BiChevronDown size={22} />
        </span>
      </div>
      <div
        tabIndex={0}
        className='dropdown-content z-[1] menu flex flex-col gap-4 p-2 shadow bg-base-100 rounded-box w-52'
      >
        {dropdownList &&
          dropdownList?.map((item, i) => (
            <div
              className='flex w-full gap-3 items-center p-2 hover:bg-[#C0D12330]'
              key={i}
            >
              <div className='w-[20px] h-[20px]'>
                <img
                  src={tempImg}
                  alt='images'
                  className='object-contain w-full h-full'
                />
              </div>
              <span className='inline'>{item.text}</span>
            </div>
          ))}
      </div>
    </div>
  )
}

export default PrimaryDropDown
