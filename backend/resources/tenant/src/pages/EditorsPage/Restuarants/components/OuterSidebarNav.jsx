import React, { Fragment, useContext, useEffect, useRef, useState } from "react"
import homeIcon from "../../../../assets/homeIcon.svg"
import LoginIcon from "../../../../assets/login.svg"
import logoutIcon from "../../../../assets/logout.svg"
import shopIcon from "../../../../assets/shopIcon.svg"
import deliveryIcon from "../../../../assets/bikeDeliveryIcon.svg"
import dashboardIcon from "../../../../assets/dashboardIcon.svg"
import worldLangIcon from "../../../../assets/worldLang.svg"
import { IoMenuOutline } from "react-icons/io5"
import { HTTP_NOT_AUTHENTICATED } from "../../../../config"
import { toast } from "react-toastify"
import { useSelector, useDispatch } from "react-redux"
import { useNavigate } from "react-router-dom"
import { logout } from "../../../../redux/auth/authSlice"
import { useAuthContext } from "../../../../components/context/AuthContext"
import { useTranslation } from "react-i18next"
import AxiosInstance from "../../../../axios/axios"
import { changeLanguage } from "../../../../redux/languageSlice"
import { MenuContext } from "react-flexible-sliding-menu"
import PrimarySelectWithIcon from "./PrimarySelectWithIcon"
import { BiSolidUserAccount } from "react-icons/bi"
import {
  selectedCategoryAPI,
  setCategoriesAPI,
} from "../../../../redux/NewEditor/categoryAPISlice"

const OuterSidebarNav = ({ id }) => {
  const { setStatusCode } = useAuthContext()
  const restuarantStyle = useSelector((state) => state.restuarantEditorStyle)
  const branches = restuarantStyle.branches
  let branch_id = localStorage.getItem("selected_branch_id")

  const [branch, setBranch] = useState(null)
  const [pickUp, setPickUp] = useState(null)
  const dispatch = useDispatch()
  const navigate = useNavigate()
  const { t } = useTranslation()
  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn)
  const { closeMenu } = useContext(MenuContext)

  const currentLanguage = useSelector(
    (state) => state.languageMode.languageMode
  )

  const refOuterNav = useRef(null)

  useEffect(() => {
    document.addEventListener("keydown", hideOnEscape, true)
    document.addEventListener("click", hideOnClickOutside, true)
  }, [])

  // hide on ESC press
  const hideOnEscape = (e) => {
    if (e.key === "Escape") {
      closeMenu()
    }
  }

  // Hide on outside click
  const hideOnClickOutside = (e) => {
    if (refOuterNav.current && !refOuterNav.current?.contains(e.target)) {
      closeMenu()
    }
  }

  // let branch_id = 2

  const fetchCategoriesData = async (id) => {
    try {
      const restaurantCategoriesResponse = await AxiosInstance.get(
        `categories?items&user&branch${id ? `&selected_branch_id=${id}` : ''}`
      )

      console.log(
        "editor rest restaurantCategoriesResponse OuterSidebarNav",
        restaurantCategoriesResponse.data
      )
      if (restaurantCategoriesResponse.data) {
        dispatch(setCategoriesAPI(restaurantCategoriesResponse.data?.data))
        dispatch(
          selectedCategoryAPI({
            name: restaurantCategoriesResponse.data?.data[0].name,
            id: restaurantCategoriesResponse.data?.data[0].id,
          })
        )

        console.log(">> branch_id >>", branch_id)

        if (!branch_id) {
          branch_id = restaurantCategoriesResponse.data?.data[0]?.branch?.id
          localStorage.setItem("selected_branch_id", branch_id)
        }
      }
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error)
    }
  }
  const handleLogout = async (e) => {
    e.preventDefault()

    try {
      await dispatch(logout({ method: "POST" }))
        .unwrap()
        .then((res) => {
          setStatusCode(HTTP_NOT_AUTHENTICATED)
          navigate("/", { replace: true })
          closeMenu()
          toast.success("Logged out successfully")
        })
    } catch (err) {
      console.error(err.message)
      toast.error(`${t("Logout failed")}`)
    }
  }

  const newLanguage = currentLanguage === "en" ? "ar" : "en"
  const buttonText =
    currentLanguage === "en" ? (
      <span title='Arabic'>AR</span>
    ) : (
      <span title='English'>EN</span>
    )

  const handleLanguageChange = async () => {
    AxiosInstance.get(`/change-language/${newLanguage}`, {}).then(() => {
      dispatch(changeLanguage(newLanguage))
      fetchCategoriesData(branch_id)
      closeMenu()
    })
  }

  useEffect(() => {
    if (pickUp?.id) {
      fetchCategoriesData(pickUp.id)
      localStorage.setItem("selected_branch_id", pickUp.id)
    }

    if (branch?.id) {
      fetchCategoriesData(branch?.id)
      localStorage.setItem("selected_branch_id", branch.id)
    }
  }, [pickUp, branch])
  const handleRedirect = () => {
    console.log(window.location.href)
    window.open(window.location.href+'dashboard');
  }
  console.log("branches", branches)
  return (
    <div
      ref={refOuterNav}
      className='w-full bg-white h-[100vh] flex flex-col items-center justify-between cursor-pointer'
    >
      <div onClick={closeMenu}>
        <IoMenuOutline size={42} className='text-neutral-400 cursor-pointer' />
      </div>
      <div className='w-full h-full flex flex-col items-center justify-center gap-6 cursor-pointer'>
        <div
          onClick={() => {
            navigate("/")
            closeMenu()
          }}
          className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border  items-center cursor-pointer ' style={{borderColor: restuarantStyle?.categoryDetail_cart_color }}
        >
          <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
            <img src={homeIcon} alt='home' />
          </div>
          <h3 className=''>{t("Homepage")}</h3>
        </div>
        {/* pick up */}
        <PrimarySelectWithIcon
          imgUrl={shopIcon}
          text={t("PICKUP")}
          defaultValue={
            pickUp?.name
              ? `${pickUp.name}`
              : branches &&
                branches?.filter(
                  (branch) => branch.pickup_availability === 1
                )[0]
                ? `Branch ${branch_id}`
                : ""
          }
          onChange={(value) => setPickUp(value)}
          options={
            branches
              ? branches?.filter((branch) => branch.pickup_availability === 1)
              : []
          }
        />
        <PrimarySelectWithIcon
          imgUrl={deliveryIcon}
          text={t("Delivery")}
          defaultValue={
            branch?.name
              ? `${branch.name}`
              : branches &&
                branches?.filter(
                  (branch) => branch.delivery_availability === 1
                )[0]
                ? `Branch ${branch_id}`
                : ""
          }
          onChange={(value) => setBranch(value)}
          options={
            branches
              ? branches?.filter((branch) => branch.delivery_availability === 1)
              : []
          }
        />
        {/* login */}
        {isLoggedIn ? (
          <Fragment>
            <div
              onClick={() => {
                handleRedirect()

                closeMenu()
              }}
              className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border  items-center cursor-pointer ' style={{borderColor: restuarantStyle?.categoryDetail_cart_color }}
            >
              <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
                <img src={dashboardIcon} alt='home' />
              </div>
              <h3 className=''> {t("Dashboard")}</h3>
            </div>
          </Fragment>
        ) : (
          <Fragment>
            {/* <div
              onClick={() => navigate("/register")}
              className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border cursor-pointer  items-center '
            >
  style={{borderColor: restuarantStyle?.categoryDetail_cart_color }}             <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
                <BiSolidUserAccount size={25} />
              </div>
              <h3 className=''> {t("Create an account")} </h3>
            </div> */}

            <div
              onClick={() => {
                navigate("/login")
                closeMenu()
              }}
              className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg cursor-pointer border  items-center '
              style={{borderColor: restuarantStyle?.categoryDetail_cart_color }}  >
             <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
                <img src={LoginIcon} alt='home' />
              </div>
              <h3 className=''> {t("Login as Customer")} </h3>
            </div>

            {/* <div
              onClick={() => navigate("/login-admins")}
              className='w-[90%] mx-auto flex flex-row gap-3 cursor-pointer bg-neutral-100 rounded-lg border  items-center '
            >
  style={{borderColor: restuarantStyle?.categoryDetail_cart_color }}             <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
                <img src={LoginIcon} alt='home' />
              </div>
              <h3 className=''> {t("Management Area")} </h3>
            </div> */}
          </Fragment>
        )}
        <label
          htmlFor={id}
          aria-label='close sidebar'
          className='w-[90%] mx-auto drawer-button rounded-lg p-1 flex items-center justify-center cursor-pointer'
        >
          <div
            onClick={handleLanguageChange}
            className='w-full mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border  items-center '  style={{borderColor: restuarantStyle?.categoryDetail_cart_color }}  
          >
          <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
              <img src={worldLangIcon} alt='language' />
            </div>
            <h3 className=''> {buttonText}</h3>
          </div>
        </label>
      </div>
      {isLoggedIn ? (
        <div className='w-full mb-20 cursor-pointer'>
          <div
            onClick={handleLogout}
            className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border  items-center cursor-pointer'
 style={{borderColor: restuarantStyle?.categoryDetail_cart_color }}          >
            <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
              <img src={logoutIcon} alt='home' />
            </div>
            <h3 className=''>{t("Logout")}</h3>
          </div>
        </div>
      ) : (
        <div></div>
      )}
    </div>
  )
}

export default OuterSidebarNav
