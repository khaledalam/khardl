import React, {Fragment, useCallback, useEffect, useState} from "react"
import imgCart from "../../../../assets/headerCartIcon.svg"
import imgCartWhite from "../../../../assets/cartWhiteIcon.svg"
import imgHotFire from "../../../../assets/hot-fire.svg"
import {PiNoteFill} from "react-icons/pi"
import {MdSend} from "react-icons/md"
import ProductDetailItem from "./ProductDetailItem"
import {FiMinusCircle} from "react-icons/fi"
import {IoAddCircleOutline} from "react-icons/io5"

const ProductItem = ({
  id,
  imgSrc,
  name,
  caloryInfo,
  amount,
  cartBgcolor,
  amountColor,
  fontSize,
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
  const [checkboxItems, setCheckboxItems] = useState(
    Object.keys(checkbox_input_names).map((key) => {
      const namesArray = checkbox_input_names[key]
      const pricesArray = checkbox_input_prices[key]

      return namesArray.map((name, index) => ({
        value: name,
        price: pricesArray[index],
      }))
    })
  )
  const [radioItems, setRadioItems] = useState(
    Object.keys(selection_input_names).map((key) => {
      const namesArray = selection_input_names[key]
      const pricesArray = selection_input_prices[key]

      return namesArray.map((name, index) => ({
        value: name,
        price: pricesArray[index],
      }))
    })
  )
  const [dropdownItems, setDropdownItems] = useState(
    Object.keys(dropdown_input_names).map((key) => {
      const namesArray = dropdown_input_names[key]

      return namesArray.map((name, index) => ({
        value: name,
      }))
    })
  )

  const [totalPrice, setTotalPrice] = useState(parseFloat(amount))
  const [qtyCount, setQtyCount] = useState(1)
  const [selectedCheckbox, setSelectedCheckbox] = useState([])
  const [selectedRadio, setSelectedRadio] = useState([])
  const [selectedDropdown, setSelectedDropdown] = useState([])
  const [productExtrasCheckbox, setproductExtrasCheckbox] = useState([
    {name: "extra_cheese", label: "Extra Cheese", price: 50, isChecked: false},
    {name: "extra_source", label: "Extra Source", price: 100, isChecked: false},
    {name: "extra_spicy", label: "Extra Spicy", price: 150, isChecked: false},
  ])

  const handleProductExtra = useCallback(
    (event, idx) => {
      let data = [...productExtrasCheckbox]

      data[idx].isChecked = event.target.checked

      setproductExtrasCheckbox(data)
    },
    [productExtrasCheckbox]
  )
  const incrementQty = useCallback(() => {
    setQtyCount((prev) => prev + 1)
  }, [])
  const decrementQty = useCallback(() => {
    if (qtyCount > 1) {
      setQtyCount((prev) => prev - 1)
    }
  }, [qtyCount])

  useEffect(() => {
    let newPrice = 0
    const extraPrice = productExtrasCheckbox
      ?.filter((extra) => extra.isChecked === true)
      .map((extra) => extra.price)

    if (extraPrice && extraPrice.length > 0) {
      newPrice = newPrice + extraPrice.reduce((acc, extra) => acc + extra)
      setTotalPrice(parseFloat(amount) + newPrice)
    } else {
      setTotalPrice(parseFloat(amount))
    }
  }, [productExtrasCheckbox])

  console.log("dropdownItems", dropdownItems)
  console.log("checkboxItems", checkboxItems)
  console.log("radioItems", radioItems)

  console.log("selectedCheckbox", selectedCheckbox)
  console.log("selectedRadio", selectedRadio)
  console.log("selectedDropdown", selectedDropdown)

  const handleCheckboxChange = (checkbox_index, index, event) => {
    let isChecked = event.target.checked

    setSelectedCheckbox((prevSelectedCheckbox) => {
      if (isChecked) {
        const updatedCheckbox = [...prevSelectedCheckbox]
        updatedCheckbox[checkbox_index] = {
          ...(updatedCheckbox[checkbox_index] || {}),
          [index]: [checkbox_index, index],
        }
        return updatedCheckbox
      } else {
        const updatedCheckbox = [...prevSelectedCheckbox]
        const {[index]: removedIndex, ...rest} =
          updatedCheckbox[checkbox_index] || {}
        if (Object.keys(rest).length === 0) {
          delete updatedCheckbox[checkbox_index]
        } else {
          updatedCheckbox[checkbox_index] = rest
        }
        return updatedCheckbox
      }
    })
  }

  const handleRadioChange = (selection_index, index) => {
    setSelectedRadio((prevSelectedRadio) => {
      const updatedRadio = [...prevSelectedRadio]
      updatedRadio[selection_index] = {
        [index]: [selection_index, index],
      }
      return updatedRadio
    })
  }
  const handleDropdownChange = (dropdown_index, event) => {
    setSelectedDropdown((prevSelectedDropdown) => {
      const index = parseInt(event.target.value, 10)
      const updatedDropdown = [...prevSelectedDropdown]
      updatedDropdown[dropdown_index] = {
        [index]: [dropdown_index, index],
      }
      return updatedDropdown
    })
  }

  const finalPrice = qtyCount * totalPrice

  return (
    <Fragment>
      <div
        style={{
          boxShadow: "4px 0px 10px 0px rgba(0, 0, 0, 0.25)",
          borderRadius: shape === "sharp" ? 0 : 16,
        }}
        className='w-[250px] min-h-[138px]'
        onClick={() => document.getElementById(id).showModal()}
      >
        <div className='flex items-center justify-between pt-2'>
          <div className='flex flex-col gap-2 pl-4'>
            <h3
              style={{fontSize: fontSize ? fontSize : 16}}
              className='font-bold text-[1rem]'
            >
              {name}
            </h3>
            <p
              style={{
                fontSize:
                  fontSize &&
                  typeof fontSize == "string" &&
                  fontSize.includes("px")
                    ? Number(fontSize.slice(0, 2)) - 3
                    : typeof fontSize == "number"
                    ? fontSize - 3
                    : 13,
              }}
              className='font-normal'
            >
              {caloryInfo} Kcal
            </p>
          </div>
          <div className='w-[100px] h-[100px] mr-[-1.8rem] rtl:mr-[1.8rem] bg-neutral-100 rounded-full p-1'>
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
              style={{backgroundColor: cartBgcolor ? cartBgcolor : "#F2FF00"}}
              className='w-[70px] h-[30px] p-1 rounded-tr-lg rounded-bl-2xl  flex items-center justify-center'
            >
              <img
                src={cartBgcolor ? imgCartWhite : imgCart}
                alt='product'
                className='w-full h-full object-contain '
              />
            </div>
            <h3
              style={{color: amountColor ? amountColor : "red"}}
              className=' font-bold'
            >
              SAR {amount}
            </h3>
          </div>
        </div>
      </div>
      {/* You can open the modal using document.getElementById('ID').showModal() method */}
      <dialog id={id} className='modal'>
        <div
          style={{backgroundColor: cartBgcolor ? cartBgcolor : "#F2FF00"}}
          className='modal-box !p-0 rounded-[46px] w-[440px] h-[650px] flex flex-col justify-end'
        >
          <form method='dialog'>
            {/* if there is a button in form, it will close the modal */}
            <button className='btn btn-xs btn-circle bg-white hover:bg-white text-black absolute right-6 top-6'>
              ✕
            </button>
            {/* <IoCloseCircleOutline size={22}/> */}
          </form>
          <div className='bg-white w-full rounded-t-[80px] h-[500px] '>
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
                  style={{color: amountColor ? amountColor : "red"}}
                  className='text-[13px] font-bold'
                >
                  SAR
                </span>
                <span
                  style={{color: amountColor ? amountColor : "red"}}
                  className='text-[17px] font-bold'
                >
                  {totalPrice && finalPrice}
                </span>
              </div>
            </div>
            <div className='w-[90%] mx-auto'>
              <h3 className='text-[1rem] font-bold mb-4'>Feedback</h3>
              <div className='w-full flex items-center gap-4'>
                <div className='border border-neutral-200 rounded-lg w-[85%] h-[48px] flex items-center gap-2 px-2'>
                  <PiNoteFill
                    size={28}
                    className='border-r border-neutral-100'
                  />
                  <input
                    type='text'
                    placeholder='Say something nice...'
                    className='input w-full  h-full rounded-none outline-none border-none focus-visible:border-none focus-within:border-none focus-within:outline-none'
                  />
                </div>
                <div className='w-[40px] h-[48px] border border-neutral-200 rounded-lg flex items-center justify-center'>
                  <MdSend size={22} />
                </div>
              </div>
            </div>
            <div className='border border-neutral-400 px-6 my-4 h-[130px] overflow-x-hidden overflow-y-scroll hide-scroll'>
              <div className='flex flex-col gap-5'>
                {/* checkbox */}
                {checkbox_input_titles &&
                  checkbox_input_titles.length > 0 &&
                  checkbox_input_titles.map((title, checkbox_idx) => (
                    <div id={"checkbox"} className=''>
                      <h3 className='text-[15px] font-bold mb-1'>{title[0]}</h3>
                      <div className='flex flex-col gap-2'>
                        {checkboxItems &&
                          checkboxItems.length > 0 &&
                          checkboxItems[checkbox_idx]?.map((item, idx) => (
                            <ProductDetailItem
                              key={idx}
                              label={item?.value[0]}
                              name={item?.value[0]}
                              price={Number(item.price)}
                              isCheckbox
                              onChange={(e) =>
                                handleCheckboxChange(checkbox_idx, idx, e)
                              }
                            />
                          ))}
                      </div>
                    </div>
                  ))}

                {/* selection  */}
                {selection_input_titles &&
                  selection_input_titles.length > 0 &&
                  selection_input_titles.map((title, selection_idx) => (
                    <div id={"radio"} className=''>
                      <h3 className='text-[15px] font-bold mb-1'>{title[0]}</h3>
                      <div className='flex flex-col gap-2'>
                        {radioItems &&
                          radioItems.length > 0 &&
                          radioItems[selection_idx]?.map((item, idx) => (
                            <ProductDetailItem
                              key={idx}
                              label={item?.value[0]}
                              name={"radio_item"}
                              price={Number(item?.price)}
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
                    <div id={"dropdown"} className=''>
                      <h3 className='text-[15px] font-bold mb-1'>{title[0]}</h3>
                      <div className='flex flex-col gap-2'>
                        {dropdownItems &&
                          dropdownItems.length > 0 &&
                          dropdownItems?.map((item, idx) => (
                            <ProductDetailItem
                              key={idx}
                              isDropDown
                              options={item}
                              onChange={(e) =>
                                handleDropdownChange(dropdown_idx, e)
                              }
                            />
                          ))}
                      </div>
                    </div>
                  ))}
              </div>
            </div>
            <div className='px-6 w-full flex items-center justify-between'>
              <div className='flex items-center justify-between w-1/3'>
                <FiMinusCircle size={28} onClick={decrementQty} />
                <h3 className='text-[16px] font-bold'>{qtyCount}</h3>
                <IoAddCircleOutline size={28} onClick={incrementQty} />
              </div>
              <div
                style={{backgroundColor: cartBgcolor ? cartBgcolor : "#F2FF00"}}
                className='w-[45%] flex items-end justify-center gap-5  p-2 rounded-lg'
              >
                <div className='w-[30px] h-[30px] '>
                  <img
                    src={cartBgcolor ? imgCartWhite : imgCart}
                    alt='product'
                    className='w-full h-full object-contain '
                  />
                </div>
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
                  SAR {totalPrice && finalPrice}
                </h3>
              </div>
            </div>
          </div>
        </div>
      </dialog>
    </Fragment>
  )
}

export default ProductItem
