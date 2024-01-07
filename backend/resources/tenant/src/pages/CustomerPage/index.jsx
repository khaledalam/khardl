import React, {useContext, useEffect, useState} from "react"
import SideNavbar from "./components/SideNavbar"
import NavbarCustomer from "./components/NavbarCustomer"
import {useSelector} from "react-redux"
import CustomerDashboard from "./components/CustomerDashboard"
import CustomerOrder from "./components/CustomerOrder"
import CustomerProfile from "./components/CustomerProfile"
import {useSearchParams} from "react-router-dom"
import CustomerOrderDetail from "./components/CustomerOrderDetail"
import {MenuContext} from "react-flexible-sliding-menu"
import CustomerPayment from "./components/CustomerPayment"

const TABS = {
  dashboard: "Dashboard",
  orders: "Orders",
  profile: "Profile",
  payment: "Payment",
}
export const CustomerPage = () => {
  const isSidebarCollapse = false
  const activeNavItem = useSelector((state) => state.customerAPI.activeNavItem)
  const [searchParam] = useSearchParams()
  const [showOrderDetail, setShowOrderDetail] = useState(false)
  const {toggleMenu} = useContext(MenuContext)

  const orderId = searchParam.get("orderId")
  console.log("orderId", orderId)

  useEffect(() => {
    if (orderId) {
      setShowOrderDetail(true)
    } else {
      setShowOrderDetail(false)
    }
  }, [orderId])

  return (
    <div>
      <NavbarCustomer />
      <div className='flex bg-white h-[calc(100vh-75px)] w-full transition-all'>
        <div
          className={`transition-all ${
            isSidebarCollapse ? "flex-[0] hidden w-0" : "flex-[20%]"
          } xl:flex-[20%] laptopXL:flex-[17%] overflow--hidden bg-white h-full `}
        >
          <SideNavbar />
        </div>
        <div
          className={` transition-all ${
            isSidebarCollapse ? "flex-[100%] w-full" : "flex-[80%]"
          } xl:flex-[80%] laptopXL:flex-[83%] overflow-x-hidden bg-neutral-100 h-full overflow-y-scroll hide-scroll`}
        >
          {activeNavItem === TABS.dashboard && !showOrderDetail ? (
            <CustomerDashboard />
          ) : activeNavItem === TABS.orders && !showOrderDetail ? (
            <CustomerOrder />
          ) : activeNavItem === TABS.profile && !showOrderDetail ? (
            <CustomerProfile />
          ) : activeNavItem === TABS.payment && !showOrderDetail ? (
            <CustomerPayment />
          ) : (
            <></>
          )}
          {showOrderDetail && <CustomerOrderDetail orderId={orderId} />}
        </div>
      </div>
    </div>
  )
}
