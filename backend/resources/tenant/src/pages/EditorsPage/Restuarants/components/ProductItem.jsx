import React, { Fragment, useCallback, useEffect, useState } from "react"
import imgCart from "../../../../assets/headerCartIcon.svg"
import imgCartWhite from "../../../../assets/cartWhiteIcon.svg"
import imgHotFire from "../../../../assets/hot-fire.svg"
import { PiNoteFill } from "react-icons/pi"
import { MdSend } from "react-icons/md"
import ProductDetailItem from "./ProductDetailItem"
import { FiMinusCircle } from "react-icons/fi"
import { IoAddCircleOutline, IoLockClosedOutline } from "react-icons/io5"
import AxiosInstance from "../../../../axios/axios"
import { toast } from "react-toastify"
import { addItemToCart } from "../../../../redux/editor/cartSlice"
import { useDispatch, useSelector } from "react-redux"
import { Link, useNavigate } from "react-router-dom"
import { useTranslation } from "react-i18next"
import MainText from "../../../../components/MainText"
import { changeLogState, changeUserState } from "../../../../redux/auth/authSlice"
import {
  HTTP_NOT_AUTHENTICATED,
  HTTP_NOT_VERIFIED,
  HTTP_OK,
  PREFIX_KEY,
} from "../../../../config"
import { useAuthContext } from "../../../../components/context/AuthContext"
import { useForm } from "react-hook-form"
import { getCartItemsCount } from "../../../../redux/NewEditor/categoryAPISlice"

const ProductItem = ({
  id,
  imgSrc,
  name,
  caloryInfo,
  amount,
  cartBgcolor,
  textColor,
  textAlign,
  amountColor,
  fontSize,
  fontWeight,
  shape,
  checkbox_required,
  checkbox_input_titles,
  checkbox_input_names,
  checkbox_input_prices,

  selection_required,
  selection_input_titles,
  selection_input_names,
  selection_input_prices,

  dropdown_required,
  dropdown_input_titles,
  dropdown_input_names,
}) => {
  const dispatch = useDispatch()
  const navigate = useNavigate()
  const language = useSelector((state) => state.languageMode.languageMode)
  const { setStatusCode } = useAuthContext()
  const { t } = useTranslation()
  const [feedback, setFeedback] = useState("")
  const [totalPrice, setTotalPrice] = useState(parseFloat(amount))
  const [qtyCount, setQtyCount] = useState(1)
  const [gotoCart, setGotoCart] = useState(false)
  const [checkboxTotalPrice, setCheckboxTotalPrice] = useState(0)
  const [radioTotalPrice, setRadioTotalPrice] = useState(0)
  const [selectedCheckbox, setSelectedCheckbox] = useState([])
  const [selectedRadio, setSelectedRadio] = useState([])
  const [selectedDropdown, setSelectedDropdown] = useState([])
  const incrementQty = useCallback(() => {
    setQtyCount((prev) => prev + 1)
  }, [])
  const decrementQty = useCallback(() => {
    if (qtyCount > 1) {
      setQtyCount((prev) => prev - 1)
    }
  }, [qtyCount])
  const branch_id = localStorage.getItem("selected_branch_id")
  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn)
  const categories = useSelector((state) => state.categoryAPI.categories)

  const checkboxItems = Object.keys(checkbox_input_names).map((key) => {
    const namesArray = checkbox_input_names[key]
    const pricesArray = checkbox_input_prices[key]

    return namesArray.map((name, index) => ({
      value: name,
      price: pricesArray[index],
    }))
  })



  const radioItems = Object.keys(selection_input_names).map((key) => {
    const namesArray = selection_input_names[key]
    const pricesArray = selection_input_prices[key]

    return namesArray.map((name, index) => ({
      value: name,
      price: pricesArray[index],
    }))
  })
  const dropdownItems = Object.keys(dropdown_input_names).map((key) => {
    const namesArray = dropdown_input_names[key]

    return namesArray.map((name, index) => ({
      value: name,
    }))
  })
  let selectedcheckboxitems = [];
  let selectedradioitems = [];
  let selecteddropdownitems = [];
  useEffect(() => {

    if (checkboxItems.length > 0) {
      selectedcheckboxitems = [];
      for (let i = 0; i < checkboxItems.length; i++) {
        selectedcheckboxitems.push([])
      }
    }
    if (radioItems.length > 0) {
      selectedradioitems = [];
      for (let i = 0; i < radioItems.length; i++) {
        selectedradioitems.push('')
      }
    }
    if (dropdownItems.length > 0) {
      selecteddropdownitems = [];
      for (let i = 0; i < dropdownItems.length; i++) {
        selecteddropdownitems.push('')
      }
    }
  }, [checkboxItems, radioItems, dropdownItems])
  useEffect(() => {
    let newTotal = totalPrice
    selectedCheckbox.map((mainItem, mainIndex) => {
      mainItem.map((item, index) => {
        const price = checkboxItems[mainIndex][item].price
        newTotal += parseFloat(price)
      })
    })

    const total_new = newTotal

    setTotalPrice(newTotal - checkboxTotalPrice)
    setCheckboxTotalPrice(total_new - totalPrice)
  }, [selectedCheckbox])

  useEffect(() => {
    let newTotal = totalPrice
    let delIndex = null
    selectedRadio.map((mainItem, mainIndex) => {
      if (mainItem !== '') {
        const price = radioItems[mainIndex][mainItem].price
        newTotal += parseFloat(price)
      } else {
        delIndex = mainIndex
      }

    })
    if (delIndex) {
      let temparr = [...selectedRadio];
      temparr.splice(delIndex,1)
      setSelectedRadio(temparr)
    }
    let delIndexdp = null
    selectedDropdown.map((mainItem, mainIndex) => {
      if (mainItem !== '') {
       console.log(mainItem)
      } else {
        delIndexdp = mainIndex
      }

    })
    if (delIndexdp) {
      let temparr = [...selectedDropdown];
      temparr.splice(delIndexdp,1)
      setSelectedDropdown(temparr)
    }
    
    const total_new = newTotal

    setTotalPrice(newTotal - radioTotalPrice)
    setRadioTotalPrice(total_new - totalPrice)
  }, [selectedRadio, selectedDropdown])

  const handleCheckboxChange = (checkbox_index, index, event) => {

    let isChecked = event.target.checked
    let updatedCheckbox = []
    if (selectedCheckbox.length > 0) {
      updatedCheckbox = [...selectedCheckbox]
    } else {
      updatedCheckbox = [...selectedcheckboxitems]
    }
    if (isChecked) {
      updatedCheckbox[checkbox_index] = [...updatedCheckbox[checkbox_index], index]
    } else {
      let delind = 0
      updatedCheckbox[checkbox_index].map((item, i) => {
        if (item == index) {
          delind = i;
        }
      })
      updatedCheckbox[checkbox_index].splice(delind, 1)
    }
    setSelectedCheckbox(updatedCheckbox)
    // setSelectedCheckbox((prevSelectedCheckbox) => {
    //   if (isChecked) {
    //     const updatedCheckbox = [...prevSelectedCheckbox]
    //     updatedCheckbox[checkbox_index] = {
    //       ...(updatedCheckbox[checkbox_index] || {}),
    //       [index]: [checkbox_index, index],
    //     }
    //     return updatedCheckbox
    //   } else {
    //     const updatedCheckbox = [...prevSelectedCheckbox]
    //     const {[index]: removedIndex, ...rest} =
    //       updatedCheckbox[checkbox_index] || {}
    //     if (Object.keys(rest).length === 0) {
    //       delete updatedCheckbox[checkbox_index]
    //     } else {
    //       updatedCheckbox[checkbox_index] = rest
    //     }
    //     return updatedCheckbox
    //   }
    // })
  }

  const handleRadioChange = (selection_index, index) => {
    let updatedRadio = []
    if (selectedRadio.length > 0) {
      updatedRadio = [...selectedRadio]
    } else {
      updatedRadio = [...selectedradioitems]
    }
    updatedRadio[selection_index] = index

    setSelectedRadio(updatedRadio)

    // setSelectedRadio((prevSelectedRadio) => {
    //   const updatedRadio = [...prevSelectedRadio]
    //   updatedRadio[selection_index] = index
    //   return updatedRadio
    // })
  }
  const handleDropdownChange = (dropdown_index, index) => {
    let updatedDropdown = []
    if (selectedDropdown.length > 0) {
      updatedDropdown = [...selectedDropdown]
    } else {
      updatedDropdown = [...selecteddropdownitems]
    }
    updatedDropdown[dropdown_index] = index

    setSelectedDropdown(updatedDropdown)
    // setSelectedDropdown((prevSelectedDropdown) => {
    //   const index = parseInt(event.target.value, 10)
    //   const updatedDropdown = [...prevSelectedDropdown]
    //   updatedDropdown[dropdown_index] = {
    //     [index]: [dropdown_index, index],
    //   }
    //   return updatedDropdown
    // })
  }

  const finalPrice = qtyCount * totalPrice

  const fetchCartData = async () => {
    try {
      const cartResponse = await AxiosInstance.get(`carts`)
      if (cartResponse.data) {
        dispatch(getCartItemsCount(cartResponse.data?.data?.items?.length))
      }
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error)
    }
  }

  const handleAddToCart = async () => {
    try {
      let payload = {
        item_id: id,
        quantity: qtyCount,
        branch_id: branch_id,
        notes: feedback,
        selectedCheckbox: selectedCheckbox,
        selectedRadio: selectedRadio,
        selectedDropdown: selectedDropdown,
      }
    
      const response = await AxiosInstance.post(`/carts`, payload)

      console.log("response ", response)

      if (response?.data) {
        toast.success(`${t("Item added to cart")}`)
        setGotoCart(true)
        fetchCartData()
      }
    } catch (error) {
      console.log(error)

      toast.error(error.response?.data?.message)
      setGotoCart(false)
    }
    dispatch(addItemToCart("props.name"))
  }

  // check is logged in or not

  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm()
  const onSubmit = (data) => {
    AxiosInstance.post(`/login`, {
      phone: data.phone,
    })
      .then((response) => {
        if (response?.data?.success) {
          const responseData = response?.data
          console.log(responseData)
          localStorage.setItem("user-info", JSON.stringify(responseData.data))

          console.log(">>> herer ", responseData.data.user.status)

          if (responseData.data.user.status === "inactive") {
            sessionStorage.setItem(
              PREFIX_KEY + "phone",
              responseData?.data?.user?.phone
            )
            setStatusCode(HTTP_NOT_VERIFIED)
            navigate("/verification-phone")
          } else if (responseData.data.user.status === "active") {
            sessionStorage.setItem(
              PREFIX_KEY + "phone",
              responseData?.data?.user?.phone
            )
            setStatusCode(HTTP_OK)
            navigate("/verification-phone")
          } else {
            navigate("/error")
          }
          dispatch(changeLogState(true))
          dispatch(changeUserState(responseData?.data?.user || null))
          toast.success(`${t("You have been logged in successfully")}`)
        } else {
          console.log("response?.data?.success false")
          throw new Error(`${t("Login failed")}`)
        }
      })
      .catch((error) => {
        console.log("error: ", error)

        dispatch(changeLogState(false))
        dispatch(changeUserState(null))

        setStatusCode(HTTP_NOT_AUTHENTICATED)
        toast.error(`${t(error.response?.data?.message)}`)
      })
  }

  const handleGotoCart = () => {
    navigate("/cart")
  }

  console.log("checboxItem", checkboxItems)
  console.log("radioItems", radioItems)
  console.log("selectionItems", dropdownItems)

  return (
    <Fragment>
      <div
        style={{
          boxShadow: "4px 0px  10px 0px rgba(0, 0, 0, 0.25)",
          borderRadius: shape === "sharp" ? 0 : 16,
        }}
        className='w-[250px] min-h-[138px] cursor-pointer'
        onClick={() => document.getElementById(id).showModal()}
      >
        <div className='flex items-center justify-between pt-2'>
          <div
            className={`flex flex-col gap-2 ${language === "en" ? "pl-4" : "pr-4"
              }`}
          >
            <h3
              style={{
                fontSize: fontSize ? fontSize : 16,
                color: textColor,
                fontWeight: fontWeight ? fontWeight : 700,
              }}
              className='text-[1rem]'
            >
              {name}
            </h3>
            <p
              style={{
                color: textColor,
                fontSize:
                  fontSize &&
                    typeof fontSize == "string" &&
                    fontSize.includes("px")
                    ? Number(fontSize.slice(0, 2)) - 3
                    : typeof fontSize == "number"
                      ? fontSize - 3
                      : 13,
              }}
              className={`${textAlign === t("Center")
                ? "text-center"
                : textAlign === t("Left")
                  ? "text-left"
                  : textAlign === t("Right")
                    ? "text-right"
                    : ""
                }`}
            >
              {caloryInfo} Kcal
            </p>
          </div>
          <div
            className={`w-[100px] h-[100px] ${language === "en" ? "mr-[-1.8rem]" : "ml-[-1.8rem]"
              }   bg-neutral-100 rounded-full p-1`}
          >
            <img
              src={imgSrc}
              alt='product'
              className='w-full h-full object-cover rounded-full'
            />
          </div>
        </div>
        <div className='flex-1 h-full'>
          <div className='flex gap-6 w-full'>
            <div
              style={{ backgroundColor: cartBgcolor ? cartBgcolor : "#F2FF00" }}
              className={`w-[70px] h-[30px] p-1 ${language === "en"
                ? "rounded-tr-lg rounded-bl-2xl "
                : "rounded-tl-lg rounded-br-2xl"
                } ${shape === "sharp" ? "!rounded-none" : ""
                }  flex items-center justify-center`}
            >
              <img
                src={cartBgcolor ? imgCartWhite : imgCart}
                alt='product'
                className='w-full h-full object-contain '
              />
            </div>
            <h3
              style={{ color: amountColor ? amountColor : "red" }}
              className='font-bold'
            >
              SAR {amount}
            </h3>
          </div>
        </div>
      </div>
      {/* You can open the modal using document.getElementById('ID').showModal() method */}
      <dialog id={id} className='modal'>
        <div
          style={{ backgroundColor: cartBgcolor ? cartBgcolor : "#F2FF00" }}
          className={`modal-box !p-0 rounded-[46px] w-[98%] mx-auto md:w-[440px] ${checkboxItems[0]?.length > 0 ||
            radioItems[0]?.length > 0 ||
            dropdownItems[0]?.length > 0
            ? "h-[650px]"
            : "h-[500px]"
            } flex flex-col justify-end`}
        >
          <form method='dialog'>
            {/* if there is a button in form, it will close the modal */}
            <button className='btn btn-xs btn-circle bg-white hover:bg-white text-black absolute right-6 top-6'>
              ✕
            </button>
            {/* <IoCloseCircleOutline size={22}/> */}
          </form>
          {isLoggedIn ? (
            <Fragment>
              <div
                className={`bg-white w-full rounded-t-[80px]   ${checkboxItems[0]?.length > 0 ||
                  radioItems[0]?.length > 0 ||
                  dropdownItems[0]?.length > 0
                  ? "h-[500px]"
                  : "h-[380px]"
                  } `}
              >
                <div className='w-[216px] h-[182px] mt-[-5.8rem] mx-auto bg-neutral-100 rounded-full p-1'>
                  <img
                    src={imgSrc}
                    alt='product'
                    className='w-full h-full object-cover rounded-full'
                  />
                </div>
                <div className='flex flex-col items-center justify-center gap-2'>
                  <h3 className='text-[17px] font-bold'>{name}</h3>
                  <div className='flex flex-row items-center gap-2'>
                    <img src={imgHotFire} alt='hot' className='' />
                    <span className='text-[11px]'>{caloryInfo}</span>
                  </div>
                  <div className='flex flex-row gap-1 items-end'>
                    <span
                      style={{ color: amountColor ? amountColor : "red" }}
                      className='text-[13px] font-bold'
                    >
                      {t("SAR")}{" "}
                    </span>
                    <span
                      style={{ color: amountColor ? amountColor : "red" }}
                      className='text-[17px] font-bold'
                    >
                      {totalPrice && finalPrice}
                    </span>
                  </div>
                </div>
                <div className='w-[90%] mx-auto'>
                  <h3 className='text-[1rem] font-bold mb-4'>Feedback</h3>
                  <div className='w-full flex items-center gap-4'>
                    <div className='border border-neutral-200 rounded-lg w-full h-[48px] flex items-center gap-2 px-2'>
                      <PiNoteFill
                        size={28}
                        className='border-r border-neutral-100'
                      />
                      <input
                        type='text'
                        placeholder='Say something nice...'
                        value={feedback}
                        onChange={(e) => setFeedback(e.target.value)}
                        className='input w-full  h-full rounded-none outline-none border-none focus-visible:border-none focus-within:border-none focus-within:outline-none'
                      />
                    </div>
                    {/* <div className='w-[40px] h-[48px] border border-neutral-200 rounded-lg flex items-center justify-center'>
                    <MdSend size={22} />
                  </div> */}
                  </div>
                </div>
                {(checkboxItems[0]?.length > 0 ||
                  radioItems[0]?.length > 0 ||
                  dropdownItems[0]?.length > 0) && (
                    <div className='border border-neutral-400 px-6 my-4 h-[130px] overflow-x-hidden overflow-y-scroll hide-scroll'>
                      <div className='flex flex-col gap-5 py-4'>
                        {/* checkbox */}
                        {checkbox_input_titles &&
                          checkbox_input_titles.length > 0 &&
                          checkbox_input_titles.map((title, checkbox_idx) => (
                            <div id={"checkbox"} className='' key={checkbox_idx}>
                              {title[0] && (
                                <h3 className='text-[15px] font-bold mb-1'>
                                  {language === "en" ? title[0] : title[1]}
                                  {checkbox_required[checkbox_idx] === "true" && (
                                    <span className='text-red-500'>*</span>
                                  )}
                                </h3>
                              )}
                              <div className='flex flex-col gap-2'>

                                {checkboxItems &&
                                  checkboxItems.length > 0 &&
                                  checkboxItems[checkbox_idx]?.map(
                                    (item, idx) => (
                                      <ProductDetailItem
                                        key={idx}
                                        label={
                                          language === "en"
                                            ? item?.value[0]
                                            : item?.value[1]
                                        }
                                        name={
                                          "checkbox" + language === "en"
                                            ? item?.value[0]
                                            : item?.value[1]
                                        }
                                        price={
                                          item.price === 0
                                            ? t("Free")
                                            : `${Number(item?.price)} ${t("SAR")}`
                                        }
                                        isCheckbox
                                        onChange={(e) =>
                                          handleCheckboxChange(
                                            checkbox_idx,
                                            idx,
                                            e
                                          )
                                        }
                                      />
                                    )
                                  )}
                              </div>
                            </div>
                          ))}

                        {/* selection  */}
                        {selection_input_titles &&
                          selection_input_titles.length > 0 &&
                          selection_input_titles.map((title, selection_idx) => (
                            <div id={"radio"} className='' key={selection_idx}>
                              {title[0] && (
                                <h3 className='text-[15px] font-bold mb-1'>
                                  {language === "en" ? title[0] : title[1]}
                                  {selection_required[selection_idx] ===
                                    "true" && (
                                      <span className='text-red-500'>*</span>
                                    )}
                                </h3>
                              )}
                              <div className='flex flex-col gap-2'>
                                {radioItems &&
                                  radioItems.length > 0 &&
                                  radioItems[selection_idx]?.map((item, idx) => (
                                    <ProductDetailItem
                                      key={idx}
                                      label={
                                        language === "en"
                                          ? item?.value[0]
                                          : item?.value[1]
                                      }
                                      name={"radio_item"}
                                      price={
                                        item.price === 0
                                          ? t("Free")
                                          : `${Number(item?.price)} ${t("SAR")}`
                                      }
                                      isRadio
                                      onChange={(e) =>
                                        handleRadioChange(selection_idx, idx, e)
                                      }
                                    />
                                  ))}
                              </div>
                            </div>
                          ))}

                        {/* dropdown */}
                        {dropdown_input_titles &&
                          dropdown_input_titles.length > 0 &&
                          dropdown_input_titles.map((title, dropdown_idx) => (
                            <div id={"dropdown"} className='' key={dropdown_idx}>
                              {title[0] && (
                                <h3 className='text-[15px] font-bold mb-1'>
                                  {language === "en" ? title[0] : title[1]}
                                  {dropdown_required[dropdown_idx] === "true" && (
                                    <span className='text-red-500'>*</span>
                                  )}
                                </h3>
                              )}
                              <div className='flex flex-col gap-2 mb-3'>
                                {dropdownItems &&
                                  dropdownItems.length > 0 &&
                                  dropdownItems[dropdown_idx][0]?.value[0] &&
                                  dropdownItems?.map((item, idx) => (
                                    <ProductDetailItem
                                      key={idx}
                                      isDropDown
                                      language={language}
                                      options={item}
                                      onChange={(e) =>
                                        handleDropdownChange(dropdown_idx, idx)
                                      }
                                    />
                                  ))}
                              </div>
                            </div>
                          ))}
                      </div>
                    </div>
                  )}
                <div
                  className={`px-6 w-full flex items-center justify-between    ${checkboxItems[0]?.length > 0 ||
                    radioItems[0]?.length > 0 ||
                    dropdownItems[0]?.length > 0
                    ? ""
                    : "mt-5"
                    } `}
                >
                  <div className='flex items-center justify-between w-1/3 cursor-pointer'>
                    <FiMinusCircle size={28} onClick={decrementQty} />
                    <h3 className='text-[16px] font-bold'>{qtyCount}</h3>
                    <IoAddCircleOutline size={28} onClick={incrementQty} />
                  </div>
                  {categories?.length > 0 ? (
                    <div
                      style={{
                        backgroundColor: cartBgcolor ? cartBgcolor : "#F2FF00",
                      }}
                      className='w-[45%] flex items-center justify-center gap-5  p-2 rounded-lg cursor-pointer'
                      onClick={
                        gotoCart ? () => navigate("/cart") : handleAddToCart
                      }
                    >
                      <div className='w-[30px] h-[30px] cursor-pointer '>
                        <img
                          src={cartBgcolor ? imgCartWhite : imgCart}
                          alt='product'
                          className='w-full h-full object-contain '
                        />
                      </div>
                      {gotoCart ? (
                        <h3
                          style={{
                            color: amountColor
                              ? amountColor
                              : cartBgcolor
                                ? "white"
                                : "red",
                          }}
                          className='text-xs line-clamp-1 md:text-[14px] font-bold'
                        >
                          Check Cart
                        </h3>
                      ) : (
                        <h3
                          style={{
                            color: amountColor
                              ? amountColor
                              : cartBgcolor
                                ? "white"
                                : "red",
                          }}
                          className='text-[14px] font-bold'
                        >
                          {t("SAR")} {totalPrice && finalPrice}
                        </h3>
                      )}
                    </div>
                  ) : (
                    <div
                      style={{
                        backgroundColor: cartBgcolor ? cartBgcolor : "#F2FF00",
                      }}
                      className='w-[45%] flex items-center justify-center gap-5  p-2 rounded-lg cursor-pointer'
                    >
                      <IoLockClosedOutline size={26} />
                    </div>
                  )}
                </div>
              </div>
            </Fragment>
          ) : (
            <div className='bg-white w-full h-full flex flex-col items-center justify-center'>
              <div className=''>
                <MainText
                  Title={t("Login")}
                  classTitle='!text-[28px] !w-[50px] !h-[8px] bottom-[-10px] max-[1000px]:bottom-[0px] max-[500px]:bottom-[5px]'
                />
                <div className='w-full flex items-center justify-center mt-8'>
                  <form
                    onSubmit={handleSubmit(onSubmit)}
                    className='w-[100%] flex flex-col gap-8 px-[15px]'
                  >
                    {/* Input 1 */}

                    <div>
                      <h4 className='mb-2 ms-2 text-[13px] font-semibold'>
                        {t("Phone")}
                      </h4>
                      <input
                        type='tel'
                        className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] border-none rounded-full bg-[var(--third)]`}
                        placeholder={t("e.g.") + " +966 123456789"}
                        {...register("phone", {
                          required: true,
                        })}
                        style={{ direction: "ltr" }}
                        minLength={9}
                        maxLength={13}
                      />
                      {errors.phone && (
                        <span className='text-red-500 text-xs mt-1 ms-2'>
                          {t("Phone Error")}
                        </span>
                      )}
                    </div>

                    <div className='flex flex-col justify-center items-center mt-4 mb-10'>
                      <button
                        type='submit'
                        className={`font-bold bg-[var(--primary)] flex justify-center items-center gap-[3px] rounded-full transition-all delay-100  py-2 px-6 text-[18px] leading-6`}
                      >
                        {t("Login")}
                      </button>
                      <p className='text-sm font-semibold  mt-1'>
                        {t("Don't have an account?")}
                        <Link to='/register'>
                          <input
                            type='submit'
                            className='hover:bg-[#d6eb16] text-[var(--primary)] cursor-pointer hover:text-blue-300 py-2 px-2 text-md '
                            value={t("Create an account")}
                          />
                        </Link>
                      </p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          )}
        </div>
      </dialog>
    </Fragment>
  )
}

export default ProductItem
