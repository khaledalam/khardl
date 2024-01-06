import React from "react"
import SideNavbar from "./components/SideNavbar"
import NavbarCustomer from "./components/NavbarCustomer"
import {useSelector} from "react-redux"
import CustomerDashboard from "./components/CustomerDashboard"
import CustomerOrder from "./components/CustomerOrder"
import CustomerProfile from "./components/CustomerProfile"
import {useSearchParams} from "react-router-dom"
import CustomerOrderDetail from "./components/CustomerOrderDetail"

const TABS = {
  dashboard: "Dashboard",
  order: "Order",
  profile: "Profile",
}
export const CustomerPage = () => {
  const isSidebarCollapse = false
  const activeNavItem = useSelector((state) => state.customerAPI.activeNavItem)
  const [searchParam] = useSearchParams()
  const orderId = searchParam.get("orderId")

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
          {activeNavItem === TABS.dashboard ? (
            <CustomerDashboard />
          ) : activeNavItem === TABS.order ? (
            <CustomerOrder />
          ) : activeNavItem === TABS.profile ? (
            <CustomerProfile />
          ) : (
            <></>
          )}
          {orderId && <CustomerOrderDetail />}
        </div>
      </div>
    </div>
  )
}
