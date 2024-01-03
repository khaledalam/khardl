import React, {useState} from "react"
import orderIcon from "../../../assets/orderBlack.svg"
import PrimaryOrderSearch from "./PrimaryOrderSearch"
import PrimaryOrderSelect from "./PrimaryOrderSelect"
import OrderTable from "./OrderTable"
import {customerOrderData} from "../DATA"

const CustomerOrder = () => {
  const [pageNumber, setpageNumber] = useState(1)
  const [orderPerPage, setOrderPerPage] = useState(10)

  const slicedOrderData = customerOrderData.slice(0, orderPerPage)

  return (
    <div className='p-4'>
      <div className='flex items-center gap-3'>
        <img src={orderIcon} alt='dashboard' className='' />
        <h3 className='text-lg font-medium'>Order</h3>
      </div>
      <div className='my-5 flex w-2/3 items-center gap-4'>
        <div className='w-2/3'>
          <PrimaryOrderSearch />
        </div>
        <div className='w-full gap-4 flex items-center'>
          <div className='w-1/2'>
            <PrimaryOrderSelect
              defaultValue={"Status"}
              options={[
                {
                  value: "Received by Restaurant",
                  text: "Received by Restaurant",
                },
                {value: "Accepted", text: "Accepted"},
                {value: "Rejected", text: "Rejected"},
                {value: "Ready", text: "Ready"},
                {value: "Cancelled", text: "Cancelled"},
              ]}
            />
          </div>
          <div className='w-1/2'>
            <PrimaryOrderSelect defaultValue={"Date Added"} />
          </div>
        </div>
      </div>
      <div className=''>
        <OrderTable data={slicedOrderData} />
      </div>
      <div className=''></div>
    </div>
  )
}

export default CustomerOrder
