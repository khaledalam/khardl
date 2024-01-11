import React, {useCallback, useEffect, useState} from "react"
import orderIcon from "../../../assets/orderBlack.svg"
import PrimaryOrderSearch from "./PrimaryOrderSearch"
import PrimaryOrderSelect from "./PrimaryOrderSelect"
import OrderTable from "./OrderTable"
import {MdKeyboardArrowLeft, MdKeyboardArrowRight} from "react-icons/md"
import {
  updateOrderList,
  updatePageLinks,
} from "../../../redux/NewEditor/customerSlice"
import {useDispatch, useSelector} from "react-redux"
import {useTranslation} from "react-i18next"
import AxiosInstance from "../../../axios/axios"

const CustomerOrder = () => {
  const {t} = useTranslation()
  const dispatch = useDispatch()
  const [pageNumber, setpageNumber] = useState(1)
  const [orderPerPage, setOrderPerPage] = useState(5)
  const [dateAdded, setDateAdded] = useState("")
  const [search, setsearch] = useState("")
  const [orderStatus, setOrderStatus] = useState("")
  const ordersList = useSelector((state) => state.customerAPI.ordersList)
  const pagelinks = useSelector((state) => state.customerAPI.pagelinks)

  const fetchOrderPerpage = async () => {
    try {
      const ordersResponse = await AxiosInstance.get(
        `orders?items&item&per_page=${orderPerPage}&page=${pageNumber}&search=${search}&status=${orderStatus}`
      )

      console.log("orders per page >>>", ordersResponse?.data?.data)
      if (ordersResponse.data) {
        dispatch(updateOrderList(Object.values(ordersResponse?.data?.data)))
        dispatch(updatePageLinks(Object.values(ordersResponse?.data.links)))
      }
    } catch (error) {
      console.log(error)
    } finally {
    }
  }

  useEffect(() => {
    fetchOrderPerpage().then(() => {})
  }, [])

  useEffect(() => {
    fetchOrderPerpage().then(() => {})
  }, [pageNumber, orderPerPage, search, orderStatus])

  const prevPage = useCallback(() => {
    if (pageNumber > 1) {
      setpageNumber((prevPage) => pageNumber - 1)
    }
  }, [pageNumber])

  const nextPage = useCallback(() => {
    setpageNumber((prevPage) => prevPage + 1)
  }, [])

  console.log("pageliks", pagelinks)

  return (
    <div className='p-6'>
      <div className='flex items-center gap-3'>
        <img src={orderIcon} alt='dashboard' className='' />
        <h3 className='text-lg font-medium'>{t("Orders")}</h3>
      </div>
      <div className='my-5 flex flex-col md:flex-row w-full lg:w-[60%] items-center gap-4'>
        <div className='w-full md:w-2/3'>
          <PrimaryOrderSearch
            value={search}
            onChange={(e) => setsearch(e.target.value)}
          />
        </div>
        <div className='w-full gap-4 flex items-center'>
          <div className='w-1/2'>
            <PrimaryOrderSelect
              defaultValue={orderStatus ? orderStatus : t("Status")}
              handleChange={(value) => setOrderStatus(value)}
              options={[
                {
                  value: "receivedByRestaurant",
                  text: "Received by Restaurant",
                },
                {value: "pending", text: "Pending"},
                {value: "accepted", text: "Accepted"},
                {value: "rejected", text: "Rejected"},
                {value: "completed", text: "Completed"},
                {value: "ready", text: "Ready"},
                {value: "cancelled", text: "Cancelled"},
              ]}
            />
          </div>
          <div className='w-1/2'>
            <PrimaryOrderSelect
              defaultValue={dateAdded ? dateAdded : t("Date Added")}
              handleChange={(value) => setDateAdded(value)}
              options={[
                {
                  value: "today",
                  text: "Today",
                },
                {value: "last_day", text: "Last Day"},
                {value: "last_week", text: "Last Week"},
                {value: "last_month", text: "Last Month"},
                {value: "last_year", text: "Last Year"},
              ]}
            />
          </div>
        </div>
      </div>
      <div className='mb-5 overflow-x-scroll hide-scroll'>
        <OrderTable data={ordersList} />
      </div>
      <div className='flex flex-col  xl:flex-row items-center gap-4 justify-between mb-5'>
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
          <h3 className=''>
            {t("page")} {pageNumber} of 1
          </h3>
        </div>
        <div className='flex items-center gap-3'>
          <button
            onClick={prevPage}
            disabled={pagelinks?.prev === null}
            className={`w-8 h-8 border ${
              pagelinks?.prev
                ? "bg-[var(--customer)] cursor-pointer"
                : "border-neutral-800 disabled:bg-neutral-500 cursor-not-allowed border-solid"
            }  rounded-full flex items-center justify-center `}
          >
            <MdKeyboardArrowLeft
              size={20}
              className={pagelinks?.prev ? "text-white" : "text-black"}
            />
          </button>
          <button
            disabled={pagelinks?.next === null}
            onClick={nextPage}
            className={`w-8 h-8 border ${
              pagelinks?.next
                ? "bg-[var(--customer)] cursor-pointer"
                : "border-neutral-800 disabled:bg-neutral-500 cursor-not-allowed border-solid"
            }  rounded-full flex items-center justify-center `}
          >
            <MdKeyboardArrowRight
              size={20}
              className={pagelinks?.next ? "text-white" : "text-black"}
            />
          </button>
        </div>
      </div>
    </div>
  )
}

export default CustomerOrder
