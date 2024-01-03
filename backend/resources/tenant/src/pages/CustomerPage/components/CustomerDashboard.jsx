import {BsChevronDoubleDown, BsChevronDoubleUp} from "react-icons/bs"
import DashboardIcon from "../../../assets/dashboardBlockIcon.svg"
import OrderTable from "./OrderTable"
import {customerOrderData} from "../DATA"
import {useCallback, useState} from "react"

const CustomerDashboard = () => {
  const [orderLength, setOrderLength] = useState(6)
  const [isViewMore, setIsViewMore] = useState(false)
  const overviewInfo = [
    {
      id: 1,
      title: "Wallet",
      amount: 700,
    },
    {
      id: 2,
      title: "Loyalty Point",
      amount: 700,
    },
    {
      id: 3,
      title: "Total Cashback",
      amount: 700,
    },
  ]

  const onViewMore = useCallback(() => {
    setOrderLength((prev) => prev + 6)
    setIsViewMore(true)
  }, [])

  const hideMore = useCallback(() => {
    setOrderLength((prev) => prev - 6)
    setIsViewMore(false)
  }, [])

  const slicedOrderData = customerOrderData.slice(0, orderLength)
  return (
    <div className=' p-4'>
      <div className='flex items-center gap-3'>
        <img src={DashboardIcon} alt='dashboard' className='' />
        <h3 className='text-lg font-medium'>Dashboard</h3>
      </div>
      <div className='w-[80%] laptopXL:w-[70%] mx-auto flex items-center justify-between  my-5'>
        {overviewInfo.map((overview) => (
          <div
            key={overview.id}
            className='w-[25%] h-[110px] rounded-2xl bg-[var(--customer)] p-3 text-white flex flex-col gap-3'
          >
            <h4 className='text-sm'>{overview.title}</h4>
            <h2 className='font-bold text-white text-center text-2xl'>
              SAR {overview.amount}
            </h2>
          </div>
        ))}
      </div>
      <div className='w-full'>
        <h3 className='my-4'>Last Orders</h3>
        <div className=''>
          <OrderTable data={slicedOrderData} />
        </div>
      </div>
      <div className='w-full p-5 flex items-center justify-center cursor-pointer'>
        <div
          onClick={isViewMore ? hideMore : onViewMore}
          className='flex items-center gap-2 w-36 rounded-2xl bg-[var(--customer)] p-3 text-white'
        >
          {isViewMore ? (
            <BsChevronDoubleUp size={20} color={"#fff"} />
          ) : (
            <BsChevronDoubleDown size={20} color={"#fff"} />
          )}
          <h3 className=''>{isViewMore ? "Hide" : "View More"}</h3>
        </div>
      </div>
    </div>
  )
}

export default CustomerDashboard
