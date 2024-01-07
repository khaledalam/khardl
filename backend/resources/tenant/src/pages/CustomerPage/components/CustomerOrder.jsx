import React, {useState} from "react"
import orderIcon from "../../../assets/orderBlack.svg"
import PrimaryOrderSearch from "./PrimaryOrderSearch"
import PrimaryOrderSelect from "./PrimaryOrderSelect"
import OrderTable from "./OrderTable"
import {
  MdKeyboardArrowLeft,
  MdKeyboardArrowRight,
  MdKeyboardDoubleArrowLeft,
  MdKeyboardDoubleArrowRight,
} from "react-icons/md"

import {useSelector} from "react-redux"

const CustomerOrder = () => {
  const [pageNumber, setpageNumber] = useState(1)
  const [orderPerPage, setOrderPerPage] = useState(5)
  const [dateAdded, setDateAdded] = useState("")
  const [orderStatus, setOrderStatus] = useState("")
  const ordersList = useSelector((state) => state.customerAPI.ordersList)

  const slicedOrderData = ordersList.slice(0, orderPerPage)

  return (
    <div className='p-6'>
      <div className='flex items-center gap-3'>
        <img src={orderIcon} alt='dashboard' className='' />
        <h3 className='text-lg font-medium'>Order</h3>
      </div>
      <div className='my-5 flex w-[60%] items-center gap-4'>
        <div className='w-2/3'>
          <PrimaryOrderSearch />
        </div>
        <div className='w-full gap-4 flex items-center'>
          <div className='w-1/2'>
            <PrimaryOrderSelect
              defaultValue={orderStatus ? orderStatus : "Status"}
              handleChange={(value) => setOrderStatus(value)}
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
            <PrimaryOrderSelect
              defaultValue={dateAdded ? dateAdded : "Date Added"}
              handleChange={(value) => setDateAdded(value)}
              options={[
                {
                  value: "Today",
                  text: "Today",
                },
                {value: "Last Day", text: "Last Day"},
                {value: "Last Week", text: "Last Week"},
                {value: "Last Month", text: "Last Month"},
                {value: "Last Year", text: "Last Year"},
              ]}
            />
          </div>
        </div>
      </div>
      <div className='mb-5'>
        <OrderTable data={slicedOrderData} />
      </div>
      <div className='flex items-center justify-between mb-5'>
        <div className='flex items-center gap-3'>
          <div className='w-[200px]'>
            <PrimaryOrderSelect
              background
              defaultValue={`Show ${orderPerPage}`}
              handleChange={(value) => setOrderPerPage(value)}
              options={[
                {
                  value: 5,
                  text: 5,
                },
                {
                  value: 10,
                  text: 10,
                },
                {
                  value: 15,
                  text: 15,
                },
                {
                  value: 20,
                  text: 20,
                },
              ]}
            />
          </div>
          <h3 className=''>Page {pageNumber} of 1</h3>
        </div>
        <div className='flex items-center gap-3'>
          <div className='w-8 h-8 border border-neutral-800 rounded-full flex items-center justify-center cursor-pointer'>
            <MdKeyboardDoubleArrowLeft size={20} />
          </div>
          <div className='w-8 h-8 border border-neutral-800 rounded-full flex items-center justify-center cursor-pointer'>
            <MdKeyboardArrowLeft size={20} />
          </div>
          <div
            className={`w-8 h-8 border ${
              true ? "bg-[var(--customer)]" : "border-neutral-800"
            }  rounded-full flex items-center justify-center cursor-pointer`}
          >
            <MdKeyboardArrowRight
              size={20}
              className={true ? "text-white" : ""}
            />
          </div>
          <div className='w-8 h-8 border border-neutral-800 rounded-full flex items-center justify-center cursor-pointer'>
            <MdKeyboardDoubleArrowRight size={20} />
          </div>
        </div>
      </div>
    </div>
  )
}

export default CustomerOrder
