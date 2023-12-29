import React, {Fragment, useContext, useState} from "react"
import homeIcon from "../../../../assets/homeIcon.svg"
import LoginIcon from "../../../../assets/login.svg"
import logoutIcon from "../../../../assets/logout.svg"
import shopIcon from "../../../../assets/shopIcon.svg"
import deliveryIcon from "../../../../assets/bikeDeliveryIcon.svg"
import dashboardIcon from "../../../../assets/dashboardIcon.svg"
import worldLangIcon from "../../../../assets/worldLang.svg"
import {IoMenuOutline} from "react-icons/io5"
import {HTTP_NOT_AUTHENTICATED} from "../../../../config"
import {toast} from "react-toastify"
import {useSelector, useDispatch} from "react-redux"
import {useNavigate} from "react-router-dom"
import {logout} from "../../../../redux/auth/authSlice"
import {useAuthContext} from "../../../../components/context/AuthContext"
import {useTranslation} from "react-i18next"
import AxiosInstance from "../../../../axios/axios"
import {changeLanguage} from "../../../../redux/languageSlice"
import {MenuContext} from "react-flexible-sliding-menu"
import PrimarySelectWithIcon from "./PrimarySelectWithIcon"
import {BiSolidUserAccount} from "react-icons/bi"
import {setCategoriesAPI} from "../../../../redux/NewEditor/categoryAPISlice"

const OuterSidebarNav = ({id}) => {
  const {setStatusCode} = useAuthContext()
  const [branch, setBranch] = useState("Branch A")
  const [pickUp, setPickUp] = useState("Pick A")
  const dispatch = useDispatch()
  const navigate = useNavigate()
  const {t} = useTranslation()
  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn)
  const {closeMenu} = useContext(MenuContext)

  const currentLanguage = useSelector(
    (state) => state.languageMode.languageMode
  )

  let branch_id = localStorage.getItem("selected_branch_id")
  // let branch_id = 2

  const fetchCategoriesData = async () => {
    try {
      const restaurantCategoriesResponse = await AxiosInstance.get(
        `categories?items&user&branch&selected_branch_id=${branch_id}`
      )

      console.log(
        "editor rest restaurantCategoriesResponse >>>",
        restaurantCategoriesResponse.data
      )
      if (restaurantCategoriesResponse.data) {
        dispatch(setCategoriesAPI(restaurantCategoriesResponse.data?.data))

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
      await dispatch(logout({method: "POST"}))
        .unwrap()
        .then((res) => {
          setStatusCode(HTTP_NOT_AUTHENTICATED)
          navigate("/login", {replace: true})
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
      fetchCategoriesData()
    })
  }

  return (
    <div className='w-full bg-white h-[100vh] flex flex-col items-center justify-between'>
      <div onClick={closeMenu}>
        <IoMenuOutline size={42} className='text-neutral-400' />
      </div>
      <div className='w-full h-full flex flex-col items-center justify-center gap-6'>
        <div
          onClick={() => navigate("/")}
          className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border border-[#C0D123] items-center '
        >
          <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
            <img src={homeIcon} alt='home' />
          </div>
          <h3 className=''>{t("Homepage")}</h3>
        </div>
        {/* pick up */}
        <PrimarySelectWithIcon
          imgUrl={shopIcon}
          text={"Pick up"}
          placeholder={`Khardl Pick-Up - Jeddah`}
          onChange={(e) => setPickUp(e.target.value)}
          options={[
            {
              value: 1,
              text: "Pick-Up A",
            },
            {
              value: 2,
              text: "Pick-Up B",
            },
          ]}
        />
        <PrimarySelectWithIcon
          imgUrl={deliveryIcon}
          text={"delivery"}
          placeholder={`Khardl Branch - Jeddah`}
          onChange={(e) => setBranch(e.target.value)}
          options={[
            {
              value: 1,
              text: "Branch A",
            },
            {
              value: 2,
              text: "Branch B",
            },
          ]}
        />
        {/* login */}
        {isLoggedIn ? (
          <Fragment>
            <div
              onClick={() => navigate("/dashboard")}
              className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border border-[#C0D123] items-center cursor-pointer '
            >
              <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
                <img src={dashboardIcon} alt='home' />
              </div>
              <h3 className=''> {t("Dashboard")}</h3>
            </div>
          </Fragment>
        ) : (
          <Fragment>
            <div
              onClick={() => navigate("/register")}
              className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border border-[#C0D123] items-center '
            >
              <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
                <BiSolidUserAccount size={25} />
              </div>
              <h3 className=''> {t("Create an account")} </h3>
            </div>

            <div
              onClick={() => navigate("/login")}
              className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border border-[#C0D123] items-center '
            >
              <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
                <img src={LoginIcon} alt='home' />
              </div>
              <h3 className=''> {t("Login as Customer")} </h3>
            </div>

            <div
              onClick={() => navigate("/login-admins")}
              className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border border-[#C0D123] items-center '
            >
              <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
                <img src={LoginIcon} alt='home' />
              </div>
              <h3 className=''> {t("Management Area")} </h3>
            </div>
          </Fragment>
        )}
        <label
          htmlFor={id}
          aria-label='close sidebar'
          className='w-[90%] mx-auto drawer-button rounded-lg p-1 flex items-center justify-center cursor-pointer'
        >
          <div
            onClick={handleLanguageChange}
            className='w-full mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border border-[#C0D123] items-center '
          >
            <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
              <img src={worldLangIcon} alt='language' />
            </div>
            <h3 className=''> {buttonText}</h3>
          </div>
        </label>
      </div>
      {isLoggedIn ? (
        <div className='w-full mb-20'>
          <div
            onClick={handleLogout}
            className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border border-[#C0D123] items-center '
          >
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
