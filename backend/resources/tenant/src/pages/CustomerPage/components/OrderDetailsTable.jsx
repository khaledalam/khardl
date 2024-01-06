import React from "react"
import Eyes from "./Eyes"

const OrderDetailsTable = ({data}) => {
  return (
    <div className='w-full'>
      <table className='w-full table'>
        <thead className='w-full '>
          <tr className='text-black h-[60px]'>
            <th className='font-bold text-[1rem]'>Product</th>
            <th className='font-bold text-[1rem]'>Name</th>
            <th className='font-bold text-[1rem]'>Qty</th>
            <th className='font-bold text-[1rem]'>Additional</th>
            <th className='font-bold text-[1rem]'>Price</th>
            <th className='font-bold text-[1rem]'>Notes</th>
          </tr>
        </thead>
        <tbody>
          {data.map((order) => (
            <tr
              key={order.id}
              className='h-[80px] bg-white my-4  cursor-pointer'
            >
              <td>
                <h3 className='text-sm font-medium'>{order.orderId}</h3>
              </td>
              <td className='h-full'>
                <div className='flex items-center gap-2'>
                  <div className='w-[55px] h-[55px] border border-[var(--customer)] rounded-full p-1'>
                    <img
                      src={order.productImgUrl}
                      alt={order.productName}
                      className='w-full h-full object-contain'
                    />
                  </div>
                  <div className='flex flex-col gap-2'>
                    <h3 className=''>{order.productName}</h3>
                    <h4 className=''>and {order.extraItems} Others</h4>
                  </div>
                </div>
              </td>
              <td>
                <div
                  className={`${
                    order.status.startsWith("Accepted") ||
                    order.status.startsWith("Ready") ||
                    order.status.includes("Receive")
                      ? "bg-[var(--accepted)]"
                      : "bg-[var(--rejected)]"
                  } rounded-xl flex items-center justify-center p-2 px-4 w-max`}
                >
                  <h3 className=''>{order.status}</h3>
                </div>
              </td>
              <td>
                <h3 className='font-normal'>
                  <span className='text-xs mr-1'>SAR</span>
                  <span className='text-[1rem] text-[var(--customer)]'>
                    {order.total}
                  </span>
                </h3>
              </td>
              <td>
                <div className='flex items-center gap-2'>
                  <span className='text-[1rem]'>{order.DateAdded}</span>
                  <span className='text-xs text-[var(--customer)]'>
                    {order.timeAdded}
                  </span>
                </div>
              </td>
              <td>
                <Eyes />
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  )
}

export default OrderDetailsTable
