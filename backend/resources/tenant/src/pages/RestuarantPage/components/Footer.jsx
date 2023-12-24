import React from "react"
import imgWhatsapp from "../../../assets/whatsappImg.svg"

const FooterRestuarant = () => {
  return (
    <div className='w-full flex flex-col gap-4'>
      <div
        style={{background: "#2A6E4F"}}
        className='w-full b h-[82px] flex items-center justify-center'
      >
        <div className='flex flex-col gap-3 items-center justify-center'>
          <div className='w-[30px] h-[30px]'>
            <img
              src={imgWhatsapp}
              alt='whatsapp'
              className='w-full h-full object-contain'
            />
          </div>
          <h3 className='font-semibold text-white'>+96600000111</h3>
        </div>
      </div>
      <h3 className='pl-16 text-[1rem] text-black font-medium'>
        &copy; All Right Reserved.
      </h3>
    </div>
  )
}

export default FooterRestuarant
