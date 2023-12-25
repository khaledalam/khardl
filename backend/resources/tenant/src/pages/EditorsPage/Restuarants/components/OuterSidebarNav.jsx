import React, {Fragment, useContext} from "react"
import homeIcon from "../../../../assets/homeIcon.svg"
import shopIcon from "../../../../assets/shopIcon.svg"
import deliveryIcon from "../../../../assets/bikeDeliveryIcon.svg"
import {IoMenuOutline} from "react-icons/io5"
import {FaLongArrowAltRight} from "react-icons/fa"
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

const OuterSidebarNav = ({id}) => {
  const {setStatusCode} = useAuthContext()
  const dispatch = useDispatch()
  const navigate = useNavigate()
  const {t} = useTranslation()
  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn)
  const {closeMenu} = useContext(MenuContext)

  const currentLanguage = useSelector(
    (state) => state.languageMode.languageMode
  )

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
    await AxiosInstance.get(`/change-language/${newLanguage}`, {})
    dispatch(changeLanguage(newLanguage))
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
          <h3 className=''>Home</h3>
        </div>
        {/* pick up */}
        <div className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border border-[#C0D123] items-center '>
          <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
            <img src={shopIcon} alt='shopping' />
          </div>
          <h3 className=''>Pick up</h3>
        </div>
        {/* delivery */}
        <div className='w-[90%] mx-auto flex flex-row gap-3 bg-neutral-100 rounded-lg border border-[#C0D123] items-center '>
          <div className='w-[60px] h-[50px] rounded-xl p-2  flex items-center justify-center'>
            <img src={deliveryIcon} alt='deliveryIcon' />
          </div>
          <h3 className=''>Delivery</h3>
        </div>
        {/* login */}
        {isLoggedIn ? (
          <Fragment>
            <div
              role='button'
              onClick={() => navigate("/dashboard")}
              className='w-[90%] mx-auto btn bg-neutral-100 hover:bg-neutral-100 active:bg-neutral-100 font-normal border border-[#C0D123]'
            >
              {t("Dashboard")}
            </div>
          </Fragment>
        ) : (
          <Fragment>
            <div
              role='button'
              onClick={() => navigate("/register")}
              className='w-[90%] mx-auto btn bg-neutral-100 hover:bg-neutral-100 active:bg-neutral-100 font-normal border border-[#C0D123]'
            >
              {t("Create an account")}{" "}
            </div>
            <div
              role='button'
              onClick={() => navigate("/login")}
              className='w-[90%] mx-auto btn bg-neutral-100 hover:bg-neutral-100 active:bg-neutral-100 font-normal border border-[#C0D123]'
            >
              {t("Login as Customer")}{" "}
            </div>

            <div
              role='button'
              onClick={() => navigate("/login-admins")}
              className='w-[90%] mx-auto btn bg-neutral-100 hover:bg-neutral-100 active:bg-neutral-100 font-normal border border-[#C0D123]'
            >
              {t("Management Area")}{" "}
            </div>
          </Fragment>
        )}
        <label
          htmlFor={id}
          aria-label='close sidebar'
          className='w-[90%] mx-auto drawer-button rounded-lg p-1 flex items-center justify-center'
        >
          <div
            role='button'
            onClick={handleLanguageChange}
            className='w-full btn bg-neutral-100 hover:bg-neutral-100 active:bg-neutral-100 font-normal !border !border-[#C0D123]'
          >
            {buttonText}
          </div>{" "}
        </label>
      </div>
      {isLoggedIn ? (
        <div className='w-full mb-20'>
          <div
            onClick={handleLogout}
            role='button'
            className='w-[90%] mx-auto btn bg-neutral-100 hover:bg-neutral-100 active:bg-neutral-100 font-normal border border-[#C0D123] flex items-center gap-3'
          >
            <span className=''>Logout </span>
            <span>
              <FaLongArrowAltRight size={20} />
            </span>
          </div>
        </div>
      ) : (
        <div></div>
      )}
    </div>
  )
}

export default OuterSidebarNav
