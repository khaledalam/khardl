import {BsChevronDoubleDown, BsChevronDoubleUp} from "react-icons/bs"
import DashboardIcon from "../../../assets/dashboardBlockIcon.svg"
import OrderTable from "./OrderTable"
import {customerOrderData} from "../DATA"
import React, {useCallback, useEffect, useState} from "react"
import AxiosInstance from "../../../axios/axios"
import {useNavigate} from "react-router-dom"
import {useDispatch, useSelector} from "react-redux"
import {useTranslation} from "react-i18next"

const CustomerDashboard = () => {
  const navigate = useNavigate()
  const {t} = useTranslation()
    const ordersList = useSelector((state) => state.customerAPI.ordersList)
  const [orderLength, setOrderLength] = useState(6)
  const [isViewMore, setIsViewMore] = useState(false)
    const [isLoading, setIsLoading] = useState(false)
    const [cashback, setCashback] = useState(0)
    const [loyaltyPoints, setLoyaltyPoints] = useState(0)

    useEffect(() => {
        fetchProfileData().then((r) => null)
    }, [])

    const fetchProfileData = async () => {
        if (isLoading) return;
        setIsLoading(true);

        try {
            const profileResponse = await AxiosInstance.get(`user`)

            if (profileResponse.data) {
                setCashback(profileResponse.data?.data?.cashback);
                setLoyaltyPoints(profileResponse.data?.data?.loyalty_points);
            }
        } catch (error) {
            console.log(error)
        } finally {
            setIsLoading(false)
        }
    }

  const overviewInfo = [
      // @TODO: add wallet after handle pay with point and cashback
    // {
    //   id: 1,
    //   title: t("Wallet"),
    //   amount: 700,
    // },
    {
      id: 2,
      title: t("Loyalty Point"),
      amount: loyaltyPoints || 0,
    },
    {
      id: 3,
      title: t("Total CashBack"),
      amount: cashback || 0,
    },
  ]



  // const onViewMore = useCallback(() => {
  //   setOrderLength((prev) => prev + 6)
  //   setIsViewMore(true)
  // }, [])

  // const hideMore = useCallback(() => {
  //   setOrderLength((prev) => prev - 6)
  //   setIsViewMore(false)
  // }, [])

  const slicedOrderData = ordersList ? ordersList.slice(0, orderLength) : []
  return (
    <div className='p-6'>
      <div className='flex items-center gap-3'>
        <img src={DashboardIcon} alt='dashboard' className='' />
        <h3 className='text-lg font-medium'>{t("Dashboard")}</h3>
      </div>
      <div className='w-full md:w-[80%] laptopXL:w-[70%] mx-auto flex items-center justify-around my-5'>
        {overviewInfo.map((overview) => (
          <div
            key={overview.id}
            className='w-[30%] md:w-[25%] h-[80px] md:h-[110px] rounded-2xl bg-[var(--customer)] p-3 text-white flex flex-col gap-3'
          >
            <h4 className='text-xs md:text-sm line-clamp-1 truncate'>
              {overview.title}
            </h4>
            <h2 className='font-bold text-white text-center text-sm md:text-2xl'>
              {t("SAR")} {!isLoading ? overview.amount :
                <span className="loading loading-spinner text-secondary"/>}
            </h2>
          </div>
        ))}
      </div>
      <div className='w-full'>
        <h3 className='my-4'>{t("Last Orders")}</h3>
        <div className='overflow-x-scroll hide-scroll'>
          <OrderTable data={slicedOrderData} />
        </div>
      </div>
      <div className='w-full p-5 flex items-center justify-center cursor-pointer'>
        <div
          onClick={() => navigate("/dashboard#Orders")}
          className='flex items-center gap-2 w-36 rounded-2xl bg-[var(--customer)] p-3 text-white'
        >
          <BsChevronDoubleDown size={20} color={"#fff"} />
          <h3 className=''>{"View More"}</h3>
        </div>
      </div>
    </div>
  )
}

export default CustomerDashboard
