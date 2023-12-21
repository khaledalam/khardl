import React from "react"

const CategoryItem = ({active, imgSrc, alt, name, onClick}) => {
  return (
    <div className='flex flex-col gap-3 items-center justify-center'>
      <div
        onClick={onClick}
        className={`w-[75px] h-[75px] p-2 rounded-full flex items-center justify-center scale-100 hover:scale-125 transition-all duration-300 ${
          active ? "bg-[#F2FF00]" : "bg-neutral-100"
        } bg-neutral-100 active:bg-[#F2FF00] hover:bg-[#F2FF00] `}
      >
        <div className='w-[50px] h-[50px] flex items-center justify-center'>
          <img src={imgSrc} alt={alt} className='w-full h-full object-cover' />
        </div>
      </div>
      <h3 className='text-sm font-normal'>{name}</h3>
    </div>
  )
}

export default CategoryItem
