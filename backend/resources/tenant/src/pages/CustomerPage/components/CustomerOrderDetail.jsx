import React from "react"
import imgBurger from "../../../assets/burger.png"
import {BiChevronLeft} from "react-icons/bi"
import {useNavigate} from "react-router-dom"
import OrderDetailsTable from "./OrderDetailsTable"
import {customerOrderData} from "../DATA"

const CustomerOrderDetail = () => {
  const navigate = useNavigate()
  return (
    <div className='p-5'>
      <div
        onClick={() => navigate(-1)}
        className='flex items-center gap-2 mb-5 cursor-pointer'
      >
        <BiChevronLeft size={30} />
        <h3 className=''>Display Order</h3>
      </div>
      <div className='w-full bg-[var(--customer)] pt-[200px]  rounded-t-[80px]'>
        <div className='w-full rounded-t-[80px] flex bg-white px-10 flex-col items-center justify-center'>
          <div className='w-[216px] h-[182px] mt-[-5.8rem] mx-auto bg-neutral-100 rounded-full p-1'>
            <img
              src={imgBurger}
              alt='product'
              className='w-full h-full object-cover rounded-full'
            />
          </div>
          <div className='flex items-center gap-5 mt-5'>
            <h3 className=''>#04</h3>
            <div
              className={` bg-[var(--accepted)] rounded-3xl flex items-center justify-center p-2 px-4 w-max`}
            >
              <h3 className='text-sm'>{"Accepted"}</h3>
            </div>
          </div>
          <div className='self-start border-b border-black w-full my-5'>
            <h3 className='text-[1rem] font-bold mb-4'>
              Product : (<span className='text-[var(--customer)]'>{3}</span>)
            </h3>
          </div>
          <div className='w-full'>
            <OrderDetailsTable data={customerOrderData} />
          </div>
        </div>
      </div>
    </div>
  )
}

export default CustomerOrderDetail
