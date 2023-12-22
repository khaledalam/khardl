import React from "react"
import imgCart from "../../../../assets/headerCartIcon.svg"

const ProductItem = ({imgSrc, name, caloryInfo, amount}) => {
  return (
    <div>
      <div
        style={{boxShadow: "4px 0px 10px 0px rgba(0, 0, 0, 0.25)"}}
        className='w-[250px] min-h-[138px] rounded-2xl'
      >
        <div className='flex items-center justify-between pt-2'>
          <div className='flex flex-col gap-2 pl-4'>
            <h3 className='font-bold text-[1rem]'>{name}</h3>
            <p className='font-normal text-[12px]'>{caloryInfo}</p>
          </div>
          <div className='w-[100px] h-[100px] mr-[-1.8rem]'>
            <img
              src={imgSrc}
              alt='product'
              className='w-full h-full object-contain'
            />
          </div>
        </div>
        <div className='flex-1 h-full'>
          <div className='flex gap-4 w-full'>
            <div className='w-[70px] h-[30px] p-1 rounded-tr-lg rounded-bl-2xl bg-[#F2FF00] flex items-center justify-center'>
              <img
                src={imgCart}
                alt='product'
                className='w-full h-full object-contain'
              />
            </div>
            <h3 className='text-red-500 font-bold'>SAR {amount}</h3>
          </div>
        </div>
      </div>
    </div>
  )
}

export default ProductItem
