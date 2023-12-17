import React, { useState, useEffect } from "react";
import { motion } from "framer-motion";
import { FiX } from "react-icons/fi";
import {useDispatch, useSelector} from 'react-redux';
import { useTranslation } from "react-i18next";
import { addItemToCart } from '../../../../redux/editor/cartSlice';
import { MdKeyboardArrowDown } from 'react-icons/md';
import AxiosInstance from "../../../../axios/axios";
import {toast} from "react-toastify";
import { useForm } from 'react-hook-form'
import MainText from "../../../MainText";
import { Link  , useNavigate} from "react-router-dom";
import { PREFIX_KEY ,HTTP_NOT_AUTHENTICATED, HTTP_NOT_VERIFIED, HTTP_OK} from "../../../../config";

import { changeLogState, changeUserState } from "../../../../redux/auth/authSlice";
import { useAuthContext } from "../../../context/AuthContext";
import {setIsOpen} from "../../../../redux/features/drawerSlice";
const DetailesItem = ({
  itemId,
  onClose,
  description,
  image,
  calories,
  price,

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
  const shapeImageShape = sessionStorage.getItem('shapeImageShape');
  const GlobalColor = sessionStorage.getItem('globalColor');
  const GlobalShape = sessionStorage.getItem('globalShape');
  const Language = sessionStorage.getItem('Language');
  const { setStatusCode } = useAuthContext()
  const [total, setTotal] = useState(parseFloat(price));
  const [spinner, setSpinner] = useState(false)

  const dispatch = useDispatch();
  const navigate = useNavigate()

  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn)
  const {
      register,
      handleSubmit,
      formState: { errors },
   } = useForm()
   const onSubmit = async (data) => {
    try {
       setSpinner(true)
       const response = await AxiosInstance.post(`/login`, {
         phone: data.phone,

         // remember_me: data.remember_me, // used only in API token-based
       });

        console.log("response: ", response)


        if (response?.data?.success) {

          const responseData = await response?.data;
          console.log(responseData)
           localStorage.setItem(
             'user-info',
             JSON.stringify(responseData.data)
          );

          console.log('>>> herer ', responseData.data.user.status);

          if (responseData.data.user.status === 'inactive') {
             sessionStorage.setItem(PREFIX_KEY + 'phone', responseData?.data?.user?.phone)
             setStatusCode(HTTP_NOT_VERIFIED)
             navigate('/verification-phone')
          }else if (
             responseData.data.user.status === 'active'
          ) {
              sessionStorage.setItem(PREFIX_KEY + 'phone', responseData?.data?.user?.phone)
             setStatusCode(HTTP_OK);
              navigate('/verification-phone')
          } else {
             navigate('/error')
          }
           dispatch(changeLogState(true))
           dispatch(changeUserState(responseData?.data?.user || null))

          dispatch(setIsOpen(false))
          toast.success(`${t('You have been logged in successfully')}`)
       } else {
           console.log("response?.data?.success false")
          setSpinner(false)
          throw new Error(`${t('Login failed')}`)
       }
    } catch (error) {
        console.log("error: ", error);

       setSpinner(false)
       dispatch(changeLogState(false))
        dispatch(changeUserState(null))

        setStatusCode(HTTP_NOT_AUTHENTICATED)
        toast.error(`${t(error.response?.data?.message)}`);
    }
 }
  const { t } = useTranslation();
  const [count, setCount] = useState(1);
  const [checkboxTotalPrice,setCheckboxTotalPrice] = useState(0);
  const [radioTotalPrice,setRadioTotalPrice] = useState(0);
  const [selectedCheckbox,setSelectedCheckbox] = useState([]);
  const [selectedRadio,setSelectedRadio] = useState([]);
  const [selectedDropdown,setSelectedDropdown] = useState([]);

  const [checkboxItems, setCheckboxItems] = useState(
    Object.keys(checkbox_input_names).map((key) => {
      const namesArray = checkbox_input_names[key];
      const pricesArray = checkbox_input_prices[key];

      return namesArray.map((name, index) => ({
        value: name,
        price: pricesArray[index]
      }));
    })
  );
  const [radioItems, setRadioItems] = useState(
    Object.keys(selection_input_names).map((key) => {
      const namesArray = selection_input_names[key];
      const pricesArray = selection_input_prices[key];

      return namesArray.map((name, index) => ({
        value: name,
        price: pricesArray[index]
      }));
    })
  );
  const [dropdownItems, setDropdownItems] = useState(
    Object.keys(dropdown_input_names).map((key) => {
      const namesArray = dropdown_input_names[key];

      return namesArray.map((name, index) => ({
        value: name,
      }));
    })
  );
  const [notes, setNotes] = useState("");
  const [goToCart, setGoToCart] = useState(false);



  // useEffect(() => {
  //   const requiredCheckboxes = Math.max(checkbox_required, 0);
  //   const updatedItems = [...items];

  //   for (let i = 0; i < requiredCheckboxes; i++) {
  //     if (i < updatedItems.length) {
  //       updatedItems[i].isChecked = true;
  //     }
  //   }
  //   setItems(updatedItems);
  // }, [checkbox_required]);


    const branch_id = localStorage.getItem('selected_branch_id');

  const handleCheckboxChange = (checkbox_index,index,event) => {

    let isChecked = event.target.checked;

    setSelectedCheckbox((prevSelectedCheckbox) => {

      if (isChecked) {
        const updatedCheckbox = [...prevSelectedCheckbox];
        updatedCheckbox[checkbox_index] = {
          ...(updatedCheckbox[checkbox_index] || {}),
          [index]: [checkbox_index, index],
        };
        return updatedCheckbox;
      } else {

        const updatedCheckbox = [...prevSelectedCheckbox];
        const { [index]: removedIndex, ...rest } = updatedCheckbox[checkbox_index] || {};
        if (Object.keys(rest).length === 0) {
          delete updatedCheckbox[checkbox_index];
        } else {
          updatedCheckbox[checkbox_index] = rest;
        }
        return updatedCheckbox;
      }
    });
  };

  const handleRadioChange = (selection_index,index) => {
      setSelectedRadio((prevSelectedRadio) => {
        const updatedRadio = [...prevSelectedRadio];
        updatedRadio[selection_index] = {
          [index]: [selection_index, index],
        };
        return updatedRadio;
      });
  };
  const handleDropdownChange =  (dropdown_index,event) => {
    setSelectedDropdown((prevSelectedDropdown) => {
      const index = parseInt(event.target.value,10);
      const updatedDropdown = [...prevSelectedDropdown];
      updatedDropdown[dropdown_index] = {
        [index]: [dropdown_index, index],
      };
      return updatedDropdown;
    });
};

  // const totalCheckbox = checkboxItems.reduce((accumulator, currentItem) => {
  //   if (currentItem.isChecked) {
  //     return accumulator + currentItem.price;
  //   }
  //   return accumulator;
  // }, 0);

  // const selectedRadioItem = radioItems.find((item) => item.isChecked);
  // const totalRadio = selectedRadioItem ? selectedRadioItem.price : 0;

   // + totalCheckbox + totalRadio;

   useEffect(() => {
    // Calculate the total based on selectedCheckbox changes



    let newTotal = total;
    for (const i in selectedCheckbox) {
      for (const j in selectedCheckbox[i]) {
        const [checkbox_index, index] = selectedCheckbox[i][j];
        const price = checkboxItems[checkbox_index][index].price;
        newTotal += parseFloat(price);
      }
    }
    const total_new = newTotal;

    setTotal(newTotal - checkboxTotalPrice);
    setCheckboxTotalPrice(total_new - total);


    // Update the total state

  }, [selectedCheckbox]);

  useEffect(() => {
    // Calculate the total based on selectedCheckbox changes
    let newTotal = total;
    for (const i in selectedRadio) {
      for (const j in selectedRadio[i]) {
        const [selection_index, index] = selectedRadio[i][j];
        const price = radioItems[selection_index][index].price;
        newTotal += parseFloat(price);
      }
    }
    const total_new = newTotal;

    setTotal(newTotal - radioTotalPrice);
    setRadioTotalPrice(total_new - total);

  }, [selectedRadio]);

  const increment = (e) => {
    e.preventDefault();
    setCount(count + 1);
  };

  const decrement = (e) => {
    e.preventDefault();
    if (count > 1) {
      setCount(count - 1);
    }
  };


    const handleAddToCart = async () => {
        try {
            // check required options
          console.log("results");
          console.log(selectedCheckbox);
          console.log(selectedRadio);
          console.log(selectedDropdown);

            const response = await AxiosInstance.post(`/carts`, {
                item_id : itemId,
                quantity : count,
                branch_id: branch_id,
                notes: notes,
                selectedCheckbox: selectedCheckbox,
                selectedRadio: selectedRadio,
                selectedDropdown: selectedDropdown
            });

            console.log("response " , response)

            if (response?.data) {
                toast.success(`${t('Item added to cart')}`);
                setGoToCart(true);
            }
        } catch (error) {
            console.log(error);

          toast.error(error.response?.data?.message);
          setGoToCart(false);
        }
        dispatch(addItemToCart("props.description"));
    };


    return (
    <>
    { isLoggedIn ?
      <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        exit={{ opacity: 0 }}
        className="font-general-medium fixed inset-0 z-[99] transition-all duration-500"
      >
        <button
    onClick={onClose}
    className="w-full h-full fixed inset-0 z-30 transition-all duration-500"
    />
        <div className="bg-[#000000]  bg-opacity-50 fixed inset-0 w-full h-full z-20"/>
        <main className="flex  flex-col items-center justify-center h-full w-full">
          <div className="modal-wrapper flex items-center z-[50]">
            <div className="modal max-w-md min-w-[480px]  bg-white overflow-y-auto mx-5 xl:max-w-xl lg:max-w-xl md:max-w-xl max-h-screen shadow-lg flex-row rounded-lg">
              <div className="modal-header grid grid-cols-2 p-5 items-center border-b border-ternary-light">
                <div className="text-center">
                  <h5
                    className="text-center text-black font-bold text-lg">
                    {t("View product details")}
                  </h5>
                </div>
                <button
                  onClick={onClose}
                  className="font-bold col-end-7"
                >
                  <FiX className="text-2xl" />
                </button>
              </div>
              <div className="modal-body p-5 w-full h-full">
                <div className="w-full h-[150px] bg-center bg-cover"
    style={shapeImageShape === "14px" ? {
        padding: "5px",
        borderRadius: shapeImageShape,
        backgroundImage: `url(${image})`
    } : {borderRadius: shapeImageShape, backgroundImage: `url(${image})`}}
    />
                <div className="flex justify-between items-center my-3">
                  <div className="text-[18px] font-semibold">{description}</div>
                  <div className="text-[18px] font-semibold">{calories} {t("calories")} </div>
                </div>
                <div className="my-2 text-[15px]">{description}</div>
                <div className="max-w-xl m-4 text-start">
                  <div className="flex flex-col text-black font-bold items-center justify-center">
                    <div className="text-[16px] w-fit p-1 px-4 my-2"
                      style={{ borderRadius: GlobalShape, backgroundColor: GlobalColor }}
                    >{price} {t("SAR")}</div>
                  </div>
                  {checkbox_input_titles.map((title,checkbox_index)=> (
                    <div key={`checkboxTitle ${checkbox_index}`} className="border-b border-ternary-light my-2 mx-10 p-4">
                    <div className="text-[16px] font-semibold">
                    {title}{ checkbox_required[checkbox_index] == 'true' && <span className="text-red-500">*</span>}
                    </div>
                    <div className="flex justify-between items-center">
                      <div>
                        {checkboxItems[checkbox_index].map((item, index) => (
                          <div key={`checkbox ${checkbox_index} ${index}`} className="flex justify-start items-center gap-2">
                            <input
                              id={`checkbox-${index}`}
                              type="checkbox"
                              value=""

                              onChange={(e) => handleCheckboxChange(checkbox_index,index,e)}
                              className="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500  focus:ring-2"
                            />
                            <label
                              htmlFor={`checkbox-${index}`}
                              className="text-sm font-medium text-gray-900"
                            >
                              {item.value}
                            </label>
                          </div>
                        ))}
                      </div>
                      <div className="flex  flex-col items-center">
                        {checkboxItems[checkbox_index].map((item, index) => (
                          <div key={`checkboxPrice ${checkbox_index} ${index}`} className="text-[14px]">

                            {item.price == 0 ? t("Free") : `${item.price} ${t("SAR")}`}
                            </div>
                        ))}
                      </div>
                    </div>
                  </div>
                  ))}

                    {selection_input_titles.map((title,selection_index)=> (
                  <div   key={`selectionTitle ${selection_index}`}  className="border-b border-ternary-light mx-10 p-4">
                    <div className="text-[16px] font-semibold ">
                    {title}{ selection_required[selection_index] == 'true' && <span className="text-red-500">*</span>}
                    </div>
                    <div className="flex justify-between items-center">
                      <div>
                        {radioItems[selection_index]?.map((item, index) => (
                          <div key={`selection ${selection_index} ${index}`} className="flex justify-start items-center gap-2">
                            <input
                              id={`radio-${index}`}
                              type="radio"
                              name={`radio${selection_index}`}
                              onChange={(e) => handleRadioChange(selection_index,index,e)}
                              className="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                            />
                            <label
                              htmlFor={`radio-${index}`}
                              className="text-sm font-medium text-gray-900"
                            >
                              {item.value}
                            </label>
                          </div>
                        ))}
                      </div>
                      <div className="flex  flex-col items-center">
                        {radioItems[selection_index]?.map((item, index) => (
                          <div key={`selectionPrice ${selection_index} ${index}`} className="text-[14px]">
                              {item.price == 0 ? t("Free") : `${item.price} ${t("SAR")}`}
                          </div>
                        ))}
                      </div>
                    </div>
                  </div>))}

                  {dropdown_input_titles.map((title,dropdown_index)=> (
                  <div  key={`dropdownTitle ${dropdown_index}`}   className="border-b border-ternary-light mx-10 p-3 ">
                    <div className="">
                    <div className="text-[16px] font-semibold ">
                    {title}{ selection_required[dropdown_index] == 'true' && <span className="text-red-500">*</span>}
                    </div>
                      <div className='relative w-[100%] my-2'>
                        <select  onChange={(e) => handleDropdownChange(dropdown_index,e)}  className='text-[14px] bg-[var(--secondary)]  w-[100%] p-1 rounded-full px-4 appearance-none'>
                        <option className="bg-white text-black"
                            key={`dropdown default`} defaultValue></option>
                          {dropdownItems[dropdown_index]?.map((item, index) => (
                            <option className="bg-white text-black"
                            key={`dropdown ${dropdown_index} ${index}`} value={index}>{item.value}</option>
                          ))}
                        </select>
                        <MdKeyboardArrowDown className={`absolute top-1/2 ${Language == "en" ? "right-4" : "left-4"} transform -translate-y-1/2 text-black`} />
                      </div>
                    </div>
                  </div>))}

                  <div className="border-b border-ternary-light my-2 mx-10 p-4">
                    <div className="">
                      <div className="text-[15px] font-semibold mb-2">{t("feedback")}</div>
                      <textarea className="w-[100%] bg-[var(--secondary)] p-1" placeholder={t("feedback")} value={notes} onChange={e => setNotes(e.target.value)}/>
                    </div>
                  </div>
                  <div className="flex justify-between items-center my-2 mx-10 p-4">
                    <div className="text-[15px] font-semibold">{t("Quantity")}</div>
                    <div className="flex justify-center items-center rounded-[80px]">
                      <button
                        onClick={decrement}
                        className="w-[30px] h-[30px] text-black font-bold flex items-center "
                        style={{ borderRadius: GlobalShape, backgroundColor: GlobalColor }}
                      >-</button>
                      <div className={`w-[40px] bg-[var(--third)] text-center ${GlobalShape == "20px" ? "mx-1" : ""}`}
                        style={{ borderRadius: GlobalShape }}
                      >
                        <span>{count}</span>
                      </div>
                      <button
                        onClick={increment}
                        className="w-[30px] h-[30px] text-black font-bold flex items-center "
                        style={{ borderRadius: GlobalShape, backgroundColor: GlobalColor }}
                      >+</button>
                    </div>
                  </div>
                  <div className="flex justify-center items-center my-4 pb-8">
                    <button
                      className={"p-1 px-10 text-[16px] text-black font-bold " + isLoggedIn ? ' bg-[var(--primary)] ' : ' bg-[var(--secondary)] '}
                      style={{ borderRadius: GlobalShape, backgroundColor: GlobalColor }}
                      onClick={() => isLoggedIn ? handleAddToCart() : navigate('/login')}
                    >
                      {isLoggedIn && <>{t("Add to cart")} ({total * count} {t("SAR")})</>}
                        {!isLoggedIn && <>{t("login first")}</>}
                    </button>
                      {goToCart && <button onClick={() => navigate('/cart')} className={"p-1 px-3 bg-[var(--secondary)] text-[16px] text-black font-bold"}>{t('go to cart')}</button>}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </motion.div>
      :
      <motion.div
      initial={{ opacity: 0 }}
      animate={{ opacity: 1 }}
      exit={{ opacity: 0 }}
      className="font-general-medium fixed inset-0 z-[99] transition-all duration-500"
    >
      <button
  onClick={onClose}
  className="w-full  fixed inset-0 z-30 transition-all duration-500"
  />
      <div className="bg-[#000000]  bg-opacity-50 fixed inset-0 w-full  z-20"/>
      <main className="flex  flex-col items-center justify-center  w-full">
        <div className="modal-wrapper flex items-center z-[50] mt-[60px]">
          <div className="modal max-w-md min-w-[480px]  bg-white overflow-y-auto mx-5 xl:max-w-xl lg:max-w-xl md:max-w-xl max-h-screen shadow-lg flex-row rounded-lg">
            <div className="modal-header grid grid-cols-2 p-5 items-center border-b border-ternary-light">
              <div className="text-center">
                <h5
                  className="text-center text-black font-bold text-lg">
                 {t('Login')}
                </h5>
              </div>
              <button
                onClick={onClose}
                className="font-bold col-end-7"
              >
                <FiX className="text-2xl" />
              </button>
            </div>
            <div className="modal-body p-5 w-full ">
            <MainText
                        Title={t('Login')}
                        classTitle='!text-[28px] !w-[50px] !h-[8px] bottom-[-10px] max-[1000px]:bottom-[0px] max-[500px]:bottom-[5px]'
                    />
            <div className='w-[100%] flex items-center justify-center mt-4'>
                <form
                  onSubmit={handleSubmit(onSubmit)}
                  className='w-[100%] flex flex-col gap-[14px] px-[15px]'
                >
                  {/* Input 1 */}


                  <div>
                      <h4 className='mb-2 ms-2 text-[13px] font-semibold'>
                        {t('Phone')}
                      </h4>
                      <input
                        type='tel'
                        className={`w-[100%] mt-0 p-[10px] px-[16px] max-[540px]:py-[15px] border-none rounded-full bg-[var(--third)]`}
                        placeholder={'e.g. +966 582936628'}
                        {...register('phone', {
                            required: true,
                        })}
                        minLength={9}
                        maxLength={13}
                      />
                      {errors.phone && (
                        <span className='text-red-500 text-xs mt-1 ms-2'>
                            { t('Phone Error') }
                        </span>
                      )}

                  </div>

                    <div className='flex flex-col justify-center items-center mt-4 mb-10'>
                                 <button
                            type='submit'
                            className={`font-bold bg-[var(--primary)] flex justify-center items-center gap-[3px] rounded-full transition-all delay-100  py-2 px-6 text-[18px] leading-6`}
                          >
                            {t('Login')}
                          </button>
                          <p className='text-sm font-semibold  mt-1'>
                            {t("Don't have an account?")}
                            <Link to='/register'>
                                <input
                                  type='submit'
                                  className='hover:bg-[#d6eb16] text-[var(--primary)] cursor-pointer hover:text-blue-300 py-2 px-2 text-md '
                                  value={t('Create an account')}
                                />
                            </Link>
                          </p>
                      </div>
                </form>

                </div>
            </div>
          </div>
        </div>
      </main>
    </motion.div>
      }
    </>
  );
};
export default DetailesItem;


