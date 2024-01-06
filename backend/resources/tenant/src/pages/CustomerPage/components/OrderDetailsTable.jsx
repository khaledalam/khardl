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
          {data.map((order, idx) => (
            <tr key={idx} className='h-[80px] bg-white my-4  cursor-pointer'>
              <td>
                <h3 className='text-sm font-medium'>{idx + 1}</h3>
              </td>
              <td className='h-full'>{order.productName}</td>
              <td>
                <h3 className=''>{order.quantity}</h3>
              </td>
              <td>
                <ul className='list-disc'>
                  {order.additional &&
                    order.additional.map((item) => (
                      <li className=''>{item}</li>
                    ))}
                </ul>
              </td>
              <td>
                <h3 className=''>SAR 650</h3>
              </td>
              <td>
                <h3 className=''>{order.notes}</h3>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  )
}

export default OrderDetailsTable
