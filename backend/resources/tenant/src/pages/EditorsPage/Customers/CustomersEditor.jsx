import React from "react"
import SideNavbar from "./components/SideNavbar"
import NavbarCustomer from "./components/NavbarCustomer"
import {useSelector} from "react-redux"

export const CustomersEditor = () => {
  const isSidebarCollapse = false
  const activeNavItem = useSelector((state) => state.customerAPI.activeNavItem)

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
          } xl:flex-[80%] laptopXL:flex-[83%] overflow-x-hidden bg-neutral-200 h-full overflow-y-scroll hide-scroll`}
        >
          hello dashboard
        </div>
      </div>
    </div>
  )
}
