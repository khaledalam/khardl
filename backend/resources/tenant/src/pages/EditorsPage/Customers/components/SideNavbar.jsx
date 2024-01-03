import React from "react"
import NavItem from "./NavItem"
import Dashboard from "../../../../assets/dashboardWhiteIcon.svg"
import DashboardBlack from "../../../../assets/dashboardBlockIcon.svg"
import OrderWhite from "../../../../assets/orderWhite.svg"
import OrderBlack from "../../../../assets/orderBlack.svg"
import ProfileIcon from "../../../../assets/profileIcon.svg"
import ProfileWhiteIcon from "../../../../assets/profileWhiteIcon.svg"
import {useDispatch, useSelector} from "react-redux"
import {setActiveNavItem} from "../../../../redux/NewEditor/customerSlice"

const navItems = [
  {
    id: 1,
    imgUrl: DashboardBlack,
    activeImgUrl: Dashboard,
    title: "Dashboard",
  },
  {
    id: 2,
    imgUrl: OrderBlack,
    activeImgUrl: OrderWhite,
    title: "Order",
  },
  {
    id: 3,
    imgUrl: ProfileIcon,
    activeImgUrl: ProfileWhiteIcon,
    title: "Profile",
  },
]

const SideNavbar = () => {
  const dispatch = useDispatch()
  const activeNavItem = useSelector((state) => state.customerAPI.activeNavItem)

  return (
    <div className='mt-5'>
      <div className='p-4 flex flex-col gap-4'>
        {navItems.map((navItem) => (
          <NavItem
            key={navItem.id}
            active={navItem.title === activeNavItem}
            onClick={() => dispatch(setActiveNavItem(navItem.title))}
            title={navItem.title}
            imgUrl={navItem.imgUrl}
            activeImgUrl={navItem.activeImgUrl}
          />
        ))}
      </div>
    </div>
  )
}

export default SideNavbar
