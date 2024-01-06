import React from "react"
import imgBurger from "../../../assets/burger.png"
import {BiChevronLeft} from "react-icons/bi"
import {useNavigate} from "react-router-dom"
import OrderDetailsTable from "./OrderDetailsTable"
import {customerOrderData, customerOrderDetailData} from "../DATA"

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
      <div className='w-full bg-[var(--customer)] pt-[150px]  rounded-t-[80px]'>
        <div className='w-full rounded-t-[80px] flex bg-white p-10 flex-col items-center justify-center'>
          <div className='w-[216px] h-[182px] mt-[-6rem] mx-auto bg-neutral-100 rounded-full p-1'>
            <img
              src={customerOrderDetailData.productImgUrl}
              alt='product'
              className='w-full h-full object-cover rounded-full'
            />
          </div>
          <div className='flex items-center gap-5 mt-5'>
            <h3 className=''>{customerOrderDetailData.orderId}</h3>

            <div
              className={`${
                customerOrderDetailData.status.startsWith("Accepted") ||
                customerOrderDetailData.status.startsWith("Ready") ||
                customerOrderDetailData.status.includes("Receive")
                  ? "bg-[var(--accepted)]"
                  : "bg-[var(--rejected)]"
              } rounded-3xl flex items-center justify-center p-2 px-4 w-max`}
            >
              <h3 className=''>{customerOrderDetailData.status}</h3>
            </div>
          </div>
          <div className='self-start border-b border-black w-full my-5'>
            <h3 className='text-[1rem] font-bold mb-4'>
              Product : (
              <span className='text-[var(--customer)]'>
                {customerOrderDetailData.items.length}
              </span>
              )
            </h3>
          </div>
          <div className='w-full border-b border-black mb-2'>
            <OrderDetailsTable data={customerOrderDetailData.items} />
          </div>
          <div className='flex flex-col gap-2 w-full self-start py-5'>
            <h3 className='font-bold text-2xl'>Delivery</h3>
            <p className=''>119 Alexa Valley Cordiabury, ME 78824-9090</p>
          </div>
          <div className='w-full border border-[var(--customer)] rounded-xl'>
            <div className='w-[80%] laptopXL:w-70% mx-auto py-5'>
              <h3 className='font-bold text-lg text-center'>Payment Summary</h3>
              <div className='w-full flex flex-col gap-4 '>
                <div className='flex items-center justify-between border-b border-neutral-200 last:border-none p-2'>
                  <h3 className='text-[1rem]'>Price</h3>
                  <h3 className='text-[1rem]'>SAR {800}</h3>
                </div>
                <div className='flex items-center justify-between border-b border-neutral-200 last:border-none p-2'>
                  <h3 className='text-[1rem]'>Delivery fee</h3>
                  <h3 className='text-[1rem]'>SAR {10}</h3>
                </div>
                <div className='flex items-center justify-between border-b border-neutral-200 last:border-none p-2'>
                  <h3 className='text-[1rem]'>Total payment</h3>
                  <h3 className='text-[1rem] font-bold'>SAR {800}</h3>
                </div>
                <div className='flex items-center justify-between border-b border-neutral-200 last:border-none p-2'>
                  <h3 className='text-[1rem]'>Payment method</h3>
                  <h3 className='text-[1rem]'>Cash on delivery</h3>
                </div>
                <div className='flex items-center justify-between border-b border-neutral-200 last:border-none p-2'>
                  <h3 className='text-[1rem]'>Order notes</h3>
                  <h3 className='text-[1rem]'>Put in the exit gate</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default CustomerOrderDetail
