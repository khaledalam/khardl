import React, {useEffect} from "react"
import NavItem from "./NavItem"
import Dashboard from "../../../assets/dashboardWhiteIcon.svg"
import DashboardBlack from "../../../assets/dashboardBlockIcon.svg"
import OrderWhite from "../../../assets/orderWhite.svg"
import OrderBlack from "../../../assets/orderBlack.svg"
import ProfileIcon from "../../../assets/profileIcon.svg"
import ProfileWhiteIcon from "../../../assets/profileWhiteIcon.svg"
import {useDispatch, useSelector} from "react-redux"
import {setActiveNavItem} from "../../../redux/NewEditor/customerSlice"
import {useNavigate} from "react-router-dom"

const navItems = [
  {
    id: 1,
    imgUrl: DashboardBlack,
    activeImgUrl: Dashboard,
    title: "Dashboard",
    link: "/site-editor/customers/#Dashboard",
  },
  {
    id: 2,
    imgUrl: OrderBlack,
    activeImgUrl: OrderWhite,
    title: "Orders",
    link: "/site-editor/customers/#Orders",
  },
  {
    id: 3,
    imgUrl: ProfileIcon,
    activeImgUrl: ProfileWhiteIcon,
    title: "Profile",
    link: "/site-editor/customers/#Profile",
  },
]

const SideNavbar = () => {
  const dispatch = useDispatch()
  const navigate = useNavigate()
  const activeNavItem = useSelector((state) => state.customerAPI.activeNavItem)

  if (window.location.href.indexOf("#Profile") > -1) {
    dispatch(setActiveNavItem("Profile"))
  } else if (window.location.href.indexOf("#Dashboard") > -1) {
    dispatch(setActiveNavItem("Dashboard"))
  } else if (window.location.href.indexOf("#Orders") > -1) {
    dispatch(setActiveNavItem("Orders"))
  }

  useEffect(() => {
    navigate("/site-editor/customers/#Dashboard")
  }, [])

  return (
    <div className='mt-5'>
      <div className='p-4 flex flex-col gap-4'>
        {navItems.map((navItem) => (
          <NavItem
            key={navItem.id}
            active={navItem.title === activeNavItem}
            onClick={() => navigate(navItem.link)}
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
