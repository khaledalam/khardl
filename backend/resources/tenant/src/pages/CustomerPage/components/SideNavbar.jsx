import React, {useEffect} from "react"
import NavItem from "./NavItem"
import Dashboard from "../../../assets/dashboardWhiteIcon.svg"
import DashboardBlack from "../../../assets/dashboardBlockIcon.svg"
import OrderWhite from "../../../assets/orderWhite.svg"
import OrderBlack from "../../../assets/orderBlack.svg"
import ProfileIcon from "../../../assets/profileIcon.svg"
import ProfileWhiteIcon from "../../../assets/profileWhiteIcon.svg"
import CardIcon from "../../../assets/cardProfileIcon.svg"
import CardWhiteIcon from "../../../assets/CardProfileWhite.svg"
import {useDispatch, useSelector} from "react-redux"
import {setActiveNavItem} from "../../../redux/NewEditor/customerSlice"
import {useNavigate} from "react-router-dom"

const navItems = [
  {
    id: 1,
    imgUrl: DashboardBlack,
    activeImgUrl: Dashboard,
    title: "Dashboard",
    link: "/dashboard#Dashboard",
  },
  {
    id: 2,
    imgUrl: OrderBlack,
    activeImgUrl: OrderWhite,
    title: "Orders",
    link: "/dashboard#Orders",
  },
  {
    id: 3,
    imgUrl: ProfileIcon,
    activeImgUrl: ProfileWhiteIcon,
    title: "Profile",
    link: "/dashboard#Profile",
  },
  {
    id: 4,
    imgUrl: CardIcon,
    activeImgUrl: CardWhiteIcon,
    title: "Payment",
    link: "/dashboard#Payment",
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
  } else if (window.location.href.indexOf("#Payment") > -1) {
    dispatch(setActiveNavItem("Payment"))
  }

  // useEffect(() => {
  //   navigate("/dashboard#Dashboard")
  // }, [])

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
