import React from "react"

const CartColumn = ({children, headerTitle}) => {
  return (
    <div className=''>
      <div className='h-[43px] bg-[var(--primary)]  border rounded-tr-lg rounded-tl-lg border-[var(--primary)] w-full flex items-center justify-center'>
        <h3 className='relative'>
          {headerTitle}
          <span className='absolute top-0 right-[-0.7rem] font-bold text-xl text-red-500'>
            *
          </span>
        </h3>
      </div>
      {children}
    </div>
  )
}

export default CartColumn
