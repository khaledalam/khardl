import React, {useEffect, useState} from "react"
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
import {
  setActiveNavItem,
  updateProfileSaveStatus,
} from "../../../redux/NewEditor/customerSlice"
import {useNavigate} from "react-router-dom"
import {useTranslation} from "react-i18next"

const SideNavbar = () => {
  const dispatch = useDispatch()
  const {t} = useTranslation()
  const navigate = useNavigate()
  const [status, setStatus] = useState(true)
  const activeNavItem = useSelector((state) => state.customerAPI.activeNavItem)
  const saveProfileChange = useSelector(
    (state) => state.customerAPI.saveProfileChanges
  )

  const navItems = [
    {
      id: 1,
      imgUrl: DashboardBlack,
      activeImgUrl: Dashboard,
      title: t("Dashboard"),
      link: "/dashboard#Dashboard",
    },
    {
      id: 2,
      imgUrl: OrderBlack,
      activeImgUrl: OrderWhite,
      title: t("Orders"),
      link: "/dashboard#Orders",
    },
    {
      id: 3,
      imgUrl: ProfileIcon,
      activeImgUrl: ProfileWhiteIcon,
      title: t("Profile"),
      link: "/dashboard#Profile",
    },
    {
      id: 4,
      imgUrl: CardIcon,
      activeImgUrl: CardWhiteIcon,
      title: t("Payment"),
      link: "/dashboard#Payment",
    },
  ]

  if (window.location.href.indexOf("#Profile") > -1) {
    dispatch(setActiveNavItem(t("Profile")))
  } else if (window.location.href.indexOf("#Dashboard") > -1) {
    dispatch(setActiveNavItem(t("Dashboard")))
  } else if (window.location.href.indexOf("#Orders") > -1) {
    dispatch(setActiveNavItem(t("Orders")))
  } else if (window.location.href.indexOf("#Payment") > -1) {
    dispatch(setActiveNavItem(t("Payment")))
  }

  const handleNavigate = (navItem) => {
    navigate(navItem.link)
  }
  const handleWindowAlert = () => {
    const stat = window.confirm(
      "Are you sure you want to navigate to another page"
    )
    console.log("stat", stat)
    setStatus(stat)
    stat && dispatch(updateProfileSaveStatus(true))
  }

  useEffect(() => {
    if (!status) {
      dispatch(updateProfileSaveStatus(false))
    }
  }, [status])

  console.log("status updated", status)
  console.log("saveProfile", saveProfileChange)

  return (
    <div className='mt-5'>
      <div className='p-4 flex flex-col gap-4'>
        {navItems.map((navItem) => (
          <NavItem
            key={navItem.id}
            active={navItem.title === activeNavItem}
            onClick={
              saveProfileChange
                ? () => handleNavigate(navItem)
                : handleWindowAlert
            }
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
