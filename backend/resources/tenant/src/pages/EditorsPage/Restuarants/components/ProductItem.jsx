import React, {
  Fragment,
  useCallback,
  useEffect,
  useState,
  useRef,
  useReducer,
} from "react";
import imgCart from "../../../../assets/headerCartIcon.svg";
import imgCartWhite from "../../../../assets/cartWhiteIcon.svg";
import imgHotFire from "../../../../assets/hot-fire.svg";
import { PiNoteFill } from "react-icons/pi";
import { MdSend } from "react-icons/md";
import ProductDetailItem from "./ProductDetailItem";
import { FiMinusCircle } from "react-icons/fi";
import { IoAddCircleOutline, IoLockClosedOutline } from "react-icons/io5";
import AxiosInstance from "../../../../axios/axios";
import { toast } from "react-toastify";
import { addItemToCart } from "../../../../redux/editor/cartSlice";
import { useDispatch, useSelector } from "react-redux";
import { Link, useNavigate } from "react-router-dom";
import { useTranslation } from "react-i18next";
import MainText from "../../../../components/MainText";
import PlusIcon from "../../../../assets/plusIcon.png";
import MinusIcon from "../../../../assets/minusIcon.png";
import {
  changeLogState,
  changeUserState,
} from "../../../../redux/auth/authSlice";
import {
  HTTP_NOT_AUTHENTICATED,
  HTTP_NOT_VERIFIED,
  HTTP_OK,
  PREFIX_KEY,
} from "../../../../config";
import { useAuthContext } from "../../../../components/context/AuthContext";
import { useForm } from "react-hook-form";
import { getCartItemsCount } from "../../../../redux/NewEditor/categoryAPISlice";
import cartImg from "../../../../assets/cartLgIcon.svg";
import Burger from "../../../../assets/burger.png";
import KcalIcon from "../../../../assets/kcalIcon.png";
import GreenDot from "../../../../assets/greenDot.png";

import useWindowSize from "../../../../hooks/useWindowSize";

import {
  SetSideBar,
  SetLoginModal,
  SetRegisterModal,
} from "../../../../redux/NewEditor/restuarantEditorSlice";

const ProductItem = ({
  product,
  id,
  imgSrc,
  name,
  description,
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
  valuekey,
  selection_required,
  selection_input_titles,
  selection_input_names,
  selection_input_prices,

  dropdown_required,
  dropdown_input_titles,
  dropdown_input_names,
  dropdown_input_prices,
  checkbox_input_maximum_choices,
  currentSubItem,
}) => {
  const dropdDownRef = useRef([]);
  const modalRef = useRef(null);
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const language = useSelector((state) => state.languageMode.languageMode);
  const { setStatusCode } = useAuthContext();
  const { t } = useTranslation();
  const [feedback, setFeedback] = useState("");
  const [totalPrice, setTotalPrice] = useState(parseFloat(amount));
  const [qtyCount, setQtyCount] = useState(1);
  const [gotoCart, setGotoCart] = useState(false);
  const [checkboxTotalPrice, setCheckboxTotalPrice] = useState(0);
  const [radioTotalPrice, setRadioTotalPrice] = useState(0);
  const [dropdownTotalPrice, setDropdownTotalPrice] = useState(0);
  const [selectedCheckbox, setSelectedCheckbox] = useState([]);
  const [selectedRadio, setSelectedRadio] = useState([]);
  const [selectedDropdown, setSelectedDropdown] = useState([]);
  const [spinner, setSpinner] = useState(false);
  const { width } = useWindowSize();

  const restuarantEditorStyle = useSelector(
    (state) => state.restuarantEditorStyle
  );

  const {
    menu_card_background_color,
    menu_card_radius,
    menu_name_text_font,
    menu_name_text_weight,
    menu_name_text_size,
    menu_name_text_color,
    total_calories_text_font,
    total_calories_text_weight,
    total_calories_text_size,
    total_calories_text_color,
    price_background_color,
    price_text_font,
    price_text_weight,
    price_text_size,
    price_text_color,
  } = restuarantEditorStyle;

  const incrementQty = useCallback(() => {
    // setSpinner(true);
    setQtyCount((prev) => prev + 1);
  }, []);
  const decrementQty = useCallback(() => {
    if (qtyCount > 1) {
      setQtyCount((prev) => prev - 1);
    }
  }, [qtyCount]);

  const branch_id = localStorage.getItem("selected_branch_id");
  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn);
  const categories = useSelector((state) => state.categoryAPI.categories);

  const checkboxItems = Object.keys(checkbox_input_names).map((key) => {
    const namesArray = checkbox_input_names[key];
    const pricesArray = checkbox_input_prices[key];

    return namesArray.map((name, index) => ({
      value: name,
      price: pricesArray[index],
    }));
  });

  const radioItems = Object.keys(selection_input_names).map((key) => {
    const namesArray = selection_input_names[key];
    const pricesArray = selection_input_prices[key];

    return namesArray.map((name, index) => ({
      value: name,
      price: pricesArray[index],
    }));
  });
  const dropdownItems = Object.keys(dropdown_input_names).map((key) => {
    const namesArray = dropdown_input_names[key];

    return namesArray.map((name, index) => ({
      value: name,
    }));
  });
  let selectedcheckboxitems = [];
  let selectedradioitems = [];
  let selecteddropdownitems = [];
  useEffect(() => {
    const handleClickOutside = (event) => {
      if (modalRef.current && !modalRef.current.contains(event.target)) {
        closeModal();
      }
    };

    document.addEventListener("mousedown", handleClickOutside);

    return () => {
      document.removeEventListener("mousedown", handleClickOutside);
    };
  }, [closeModal]);
  useEffect(() => {
    if (checkboxItems.length > 0) {
      selectedcheckboxitems = [];
      for (let i = 0; i < checkboxItems.length; i++) {
        selectedcheckboxitems.push([]);
      }
    }
    if (radioItems.length > 0) {
      selectedradioitems = [];
      for (let i = 0; i < radioItems.length; i++) {
        selectedradioitems.push("");
      }
    }
    if (dropdownItems.length > 0) {
      selecteddropdownitems = [];
      for (let i = 0; i < dropdownItems.length; i++) {
        selecteddropdownitems.push("");
      }
    }
  }, [checkboxItems, radioItems, dropdownItems]);
  useEffect(() => {
    let newTotal = totalPrice;
    selectedCheckbox.map((mainItem, mainIndex) => {
      mainItem.map((item, index) => {
        const price = checkboxItems[mainIndex][item].price;
        newTotal += parseFloat(price);
      });
    });

    const total_new = newTotal;

    setTotalPrice(newTotal - checkboxTotalPrice);
    setCheckboxTotalPrice(total_new - totalPrice);
  }, [selectedCheckbox]);

  useEffect(() => {
    let newTotal = totalPrice;
    let delIndex = null;
    selectedRadio.map((mainItem, mainIndex) => {
      if (mainItem !== "") {
        const price = radioItems[mainIndex][mainItem].price;
        newTotal += parseFloat(price);
      } else {
        delIndex = mainIndex;
      }
    });
    if (delIndex) {
      let temparr = [...selectedRadio];
      temparr.splice(delIndex, 1);
      setSelectedRadio(temparr);
    }

    const total_new = newTotal;

    setTotalPrice(newTotal - radioTotalPrice);
    setRadioTotalPrice(total_new - totalPrice);
  }, [selectedRadio]);

  useEffect(() => {
    let newTotal = totalPrice;
    let delIndexdp = null;
    selectedDropdown.map((mainItem, mainIndex) => {
      if (mainItem !== "") {
        const price = dropdown_input_prices[mainIndex][mainItem];
        newTotal += parseFloat(price);
      } else {
        delIndexdp = mainIndex;
      }
    });
    if (delIndexdp) {
      let temparr = [...selectedDropdown];
      temparr.splice(delIndexdp, 1);
      setSelectedDropdown(temparr);
    }

    const total_new = newTotal;

    setTotalPrice(newTotal - dropdownTotalPrice);
    setDropdownTotalPrice(total_new - totalPrice);
  }, [selectedDropdown]);

  const handleCheckboxChange = (checkbox_index, index, event) => {
    if (
      selectedCheckbox[checkbox_index]?.length >=
        parseInt(checkbox_input_maximum_choices[checkbox_index]) &&
      event.target.checked
    ) {
      event.target.checked = false;
      return;
    }

    let isChecked = event.target.checked;
    let updatedCheckbox = [];
    if (selectedCheckbox.length > 0) {
      updatedCheckbox = [...selectedCheckbox];
    } else {
      updatedCheckbox = [...selectedcheckboxitems];
    }
    if (isChecked) {
      updatedCheckbox[checkbox_index] = [
        ...updatedCheckbox[checkbox_index],
        index,
      ];
    } else {
      let delind = 0;
      updatedCheckbox[checkbox_index].map((item, i) => {
        if (item == index) {
          delind = i;
        }
      });
      updatedCheckbox[checkbox_index].splice(delind, 1);
    }
    setSelectedCheckbox(updatedCheckbox);
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
  };

  const handleRadioChange = (selection_index, index) => {
    let updatedRadio = [];
    if (selectedRadio.length > 0) {
      updatedRadio = [...selectedRadio];
    } else {
      updatedRadio = [...selectedradioitems];
    }
    updatedRadio[selection_index] = index;

    setSelectedRadio(updatedRadio);

    // setSelectedRadio((prevSelectedRadio) => {
    //   const updatedRadio = [...prevSelectedRadio]
    //   updatedRadio[selection_index] = index
    //   return updatedRadio
    // })
  };

  const handleDropdownChange = (dropdown_index, index) => {
    let updatedDropdown = [];
    if (selectedDropdown.length > 0) {
      updatedDropdown = [...selectedDropdown];
    } else {
      updatedDropdown = [...selecteddropdownitems];
    }
    updatedDropdown[dropdown_index] = index;

    setSelectedDropdown(updatedDropdown);
    // setSelectedDropdown((prevSelectedDropdown) => {
    //   const index = parseInt(event.target.value, 10)
    //   const updatedDropdown = [...prevSelectedDropdown]
    //   updatedDropdown[dropdown_index] = {
    //     [index]: [dropdown_index, index],
    //   }
    //   return updatedDropdown
    // })
  };

  const finalPrice = qtyCount * totalPrice;

  function closeModal() {
    handleReset();
    dropdDownRef.current.forEach((value, index) => {
      if (dropdDownRef.current[index] != null) {
        dropdDownRef.current[index].resetDropdown();
      }
    });

    if (document.getElementById(id) !== null) {
      document.getElementById(id).close();
    }
  }

  const handleAddToCart = async () => {
    let passMandatoryDrodowns = true;

    if (
      dropdown_input_titles &&
      dropdown_input_prices?.length > 0 &&
      dropdown_input_titles.length > 0 &&
      dropdownItems[0]?.length > 0
    ) {
      dropdown_input_titles.map((_, index) => {
        if (isNaN(selectedDropdown[index])) {
          passMandatoryDrodowns = false;
        }
      });
    }

    if (
      selection_input_titles &&
      selection_input_prices?.length > 0 &&
      selection_input_titles.length > 0 &&
      radioItems[0]?.length > 0
    ) {
      selection_input_titles.map((_, index) => {
        if (isNaN(selectedRadio[index])) {
          passMandatoryDrodowns = false;
        }
      });
    }

    if (passMandatoryDrodowns) {
      try {
        //setSpinner(true);
        let payload = {
          item_id: id,
          quantity: qtyCount,
          branch_id: branch_id,
          notes: feedback,
          selectedCheckbox: selectedCheckbox,
          selectedRadio: selectedRadio,
          selectedDropdown: selectedDropdown,
        };

        const response = await AxiosInstance.post(`/carts`, payload);
        closeModal();
        if (response?.data) {
          toast.success(`${t("Item added to cart")}`);
          dispatch(getCartItemsCount(response?.data.data.count));
          //setGotoCart(true);
        }
        setSpinner(false);
        setSelectedDropdown([]);
        setSelectedCheckbox([]);
        setSelectedRadio([]);
      } catch (error) {
        setSpinner(false);
        console.log(error);

        toast.error(error.response?.data?.message);
        setSelectedCheckbox([]);
        setSelectedDropdown([]);
        setSelectedRadio([]);
        setGotoCart(false);
      }
      dispatch(addItemToCart("props.name"));
    } else {
      setSpinner(false);
      toast.error("Select all mandatory options");
    }
  };

  // check is logged in or not

  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm();
  const onSubmit = (data) => {
    AxiosInstance.post(`/login`, {
      phone: data.phone,
    })
      .then((response) => {
        if (response?.data?.success) {
          const responseData = response?.data;
          localStorage.setItem(
            "user-info",
            JSON.stringify(responseData?.data?.user)
          );


          if (responseData.data.user.status === "inactive") {
            sessionStorage.setItem(
              PREFIX_KEY + "phone",
              responseData?.data?.user?.phone
            );
            setStatusCode(HTTP_NOT_VERIFIED);
            navigate("/verification-phone");
          } else if (responseData.data.user.status === "active") {
            sessionStorage.setItem(
              PREFIX_KEY + "phone",
              responseData?.data?.user?.phone
            );
            setStatusCode(HTTP_OK);
            navigate("/verification-phone");
          } else {
            navigate("/error");
          }
          dispatch(changeLogState(true));
          dispatch(changeUserState(responseData?.data?.user || null));
          toast.success(`${t("You have been logged in successfully")}`);
        } else {
          throw new Error(`${t("Login failed")}`);
        }
      })
      .catch((error) => {
        console.log("error: ", error);

        dispatch(changeLogState(false));
        dispatch(changeUserState(null));

        setStatusCode(HTTP_NOT_AUTHENTICATED);
        toast.error(`${t(error.response?.data?.message)}`);
      });
  };

  const handleGotoCart = () => {
    navigate("/cart");
  };

  const handleReset = () => {
    const checkboxes = modalRef.current.querySelectorAll(
      'input[type="checkbox"]'
    );
    checkboxes.forEach((checkbox) => (checkbox.checked = false));

    const radios = modalRef.current.querySelectorAll('input[type="radio"]');
    radios.forEach((radio) => (radio.checked = false));

    const selects = modalRef.current.querySelectorAll("select");
    selects.forEach((select) => (select.selectedIndex = 0));

    setSelectedCheckbox([]);
    setSelectedDropdown([]);
    setSelectedRadio([]);
  };

  return (
    <Fragment>
      <div
        style={{
          backgroundColor: menu_card_background_color,
          borderRadius: `${menu_card_radius}px`,
        }}
        className="w-full max-w-32 shadow-md sm:max-w-36 h-44 relative hover:scale-110 transform transition-transform duration-300 ease-in-out hover:cursor-pointer overflow-hidden"
        key={valuekey}
        onClick={() => document.getElementById(id).showModal()}
      >
        <div className="w-full max-w-32 sm:max-w-36 h-44 flex flex-col justify-between items-center">
          <div
            style={{
              backgroundImage: `url(${imgSrc})`,
              backgroundSize: "cover",
              backgroundPosition: "center",
              borderTopLeftRadius: `${menu_card_radius}px`,
              borderTopRightRadius: `${menu_card_radius}px`,
            }}
            className="w-full max-w-32 sm:max-w-36 h-[86px] flex justify-center items-center"
          >
            {/* <img className="w-[60px] h-[60px]" src={imgSrc} /> */}
          </div>
          <div
            style={{
              color: menu_name_text_color,
              fontFamily: menu_name_text_font,
              fontSize: menu_name_text_size,
            }}
            className={`relative font-${menu_name_text_weight}`}
          >
            <span>{name}</span>
            <img
              src={GreenDot}
              alt="green dot"
              className={`${
                currentSubItem == t("Item Text")
                  ? "absolute w-[5px] h-[5px] right-[-8px] top-[-2px]"
                  : "hidden"
              }`}
            />
          </div>
          <div className="w-full h-3">
            <div className="left-[16px] flex justify-center">
              <img className="w-3 h-3" src={KcalIcon} />
              <span
                style={{
                  color: total_calories_text_color,
                  fontFamily: total_calories_text_font,
                  fontSize: total_calories_text_size,
                }}
                className={`relative font-${total_calories_text_weight}`}
              >
                <span>
                  {caloryInfo} {t("Kcal")}
                </span>
                <img
                  src={GreenDot}
                  alt="green dot"
                  className={`${
                    currentSubItem == t("Item Text")
                      ? "absolute w-[5px] h-[5px] right-[-8px] top-[-2px]"
                      : "hidden"
                  }`}
                />
              </span>
            </div>
          </div>
          <div className="w-28 h-6">
            <div
              style={{
                backgroundColor: price_background_color,
                boxShadow: "0px -2px 10px 0px rgba(0, 0, 0, 0.3)",
              }}
              className="w-28 h-6 bg-red-900 rounded-tl-[30px] rounded-tr-[30px] flex justify-center items-center relative"
            >
              <div
                style={{
                  color: price_text_color,
                  fontFamily: price_text_font,
                  fontSize: price_text_size,
                }}
                className={`font-${price_text_weight}`}
              >
                {t("SAR")} {amount}
              </div>
              {/* {product?.allow_buy_with_loyalty_points ? (
                <div className="text-green-900 text-sm font-bold font-['Plus Jakarta Sans'] leading-tight p-2 border">
                  ⛁ {product?.price_using_loyalty_points}
                </div>
              ) : (
                ""
              )} */}
              <img
                src={GreenDot}
                alt="green dot"
                className={`${
                  currentSubItem == t("Price")
                    ? "absolute w-[5px] h-[5px] right-0 top-0"
                    : "hidden"
                }`}
              />
            </div>
          </div>
        </div>
        <img
          src={GreenDot}
          alt="green dot"
          className={`${
            currentSubItem == t("Menu Card")
              ? "absolute w-[5px] h-[5px] right-[10px] top-[10px]"
              : "hidden"
          }`}
        />
      </div>
      <dialog
        id={id}
        className="modal mx-auto overflow-y-auto font-jakarta pt-10 pb-5"
      >
        <div ref={modalRef} className="relative mx-auto">
          <button
            className="btn btn-xs btn-circle bg-white hover:bg-white text-black absolute right-[-10px] top-[-30px]"
            onClick={() => closeModal()}
          >
            ✕
          </button>
          <div className="flex flex-row mx-auto bg-white rounded-[6px]">
            <div
              className={`!p-0 w-[340px] ${
                checkboxItems[0]?.length > 0 ||
                radioItems[0]?.length > 0 ||
                dropdownItems[0]?.length > 0
                  ? "md:h-[700px]"
                  : "md:h-[550px]"
              } flex flex-col justify-end items-center z-[100]`}
            >
              <Fragment>
                {spinner && (
                  <div
                    role="status"
                    className="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-full z-[1000]"
                  >
                    <div className="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                      <svg
                        aria-hidden="true"
                        className="w-8 h-8 mr-2 text-gray-200 animate-spin fill-[var(--primary)]"
                        viewBox="0 0 100 101"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                          fill="currentColor"
                        />
                        <path
                          d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                          fill="currentFill"
                        />
                      </svg>
                      <span className="sr-only">Loading...</span>
                    </div>
                  </div>
                )}

                <div
                  className={`w-full rounded-t-[80px] relative flex flex-col justify-between ${
                    checkboxItems[0]?.length > 0 ||
                    radioItems[0]?.length > 0 ||
                    dropdownItems[0]?.length > 0
                      ? "md:h-[550px]"
                      : "md:h-[430px]"
                  } `}
                >
                  <div className="">
                    <div className="w-[100px] h-[100px] mt-5 md:mt-[-5.8rem] mx-auto">
                      <img
                        src={imgSrc}
                        alt="product"
                        className="w-full h-full object-cover"
                      />
                    </div>
                    <div className="flex flex-col items-center justify-center">
                      <h3 className="text-[18px] text-[#111827C4]/[0.77] font-semibold mt-[16px]">
                        {name}
                      </h3>
                      <h3 className="text-[10px] text-[#111827C4]/[0.77] font-light mt-[9px] max-w-[205px] text-center">
                        {description}
                      </h3>

                      <div className="flex flex-row items-center mt-[13px]">
                        <img
                          src={imgHotFire}
                          alt="hot"
                          className="w-[20px] h-[20px]"
                        />
                        <p className="inline-flex items-baseline ml-1.5">
                          <span className="text-[12px] font-normal">
                            {caloryInfo}
                          </span>
                          <span className="text-[8px] font-normal ml-[2px]">
                            {t("Kcal")}
                          </span>
                        </p>
                      </div>

                      <div className="w-[275px] h-[88px] mt-[18px] relative">
                        <div className="w-[275px] h-[76px] left-0 top-[12px] absolute">
                          <div className="w-[275px] h-[76px] left-0 top-0 absolute bg-white rounded-[14px] border border-orange-100" />
                          <textarea
                            type="text"
                            placeholder={t(
                              "e.g. Please make the meat super tender."
                            )}
                            value={feedback}
                            onChange={(e) => setFeedback(e.target.value)}
                            style={{
                              resize: "none",
                            }}
                            className="outline-none w-[243px] h-[52px] left-[16px] top-[14px] pt-2 absolute text-black text-[12px] font-light placeholder-black/30"
                          />
                        </div>
                        <div className="w-[89px] h-6 left-[92px] top-0 absolute">
                          <div
                            className="w-[89px] h-6 left-0 top-0 absolute bg-red-900 rounded-[14px] text-white text-[8px] font-normal flex justify-center items-center"
                            style={{ backgroundColor: price_background_color }}
                          >
                            {t("Order Notes")}
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      className={`px-6 w-full flex items-center justify-between mt-[16px] ${
                        checkboxItems[0]?.length > 0 ||
                        radioItems[0]?.length > 0 ||
                        dropdownItems[0]?.length > 0
                          ? ""
                          : "mt-5"
                      } `}
                    >
                      <div className="flex flex-col gap-2">
                        <div className="font-inter text-[#ff3d00]">
                          <span className="text-[13px] font-light">
                            {t("SAR")}
                          </span>{" "}
                          <span className="text-base font-medium">
                            {totalPrice && finalPrice.toFixed(2)}
                          </span>
                        </div>
                        {product?.allow_buy_with_loyalty_points ? (
                          <div className="text-green-900 text-sm font-bold font-['Plus Jakarta Sans'] leading-tight p-1">
                            <span className="text-[13px] font-light">
                              {t("points-price")}
                            </span>
                            &nbsp;
                            <span className="text-base font-medium">
                              {product?.price_using_loyalty_points * qtyCount}
                            </span>
                          </div>
                        ) : (
                          ""
                        )}
                      </div>
                      <div className="flex items-center justify-between cursor-pointer w-[120px] h-8 bg-orange-100 bg-opacity-20 rounded-lg px-[7.89px]">
                        <div
                          onClick={decrementQty}
                          className="w-[22.11px] h-[22.40px] bg-orange-100 bg-opacity-30 rounded-md flex justify-center items-center"
                          style={{
                            backgroundColor: price_background_color + "50",
                          }}
                        >
                          <img
                            src={MinusIcon}
                            alt="minus icon"
                            className="w-[7.89px] h-2 left-[15px]"
                          />
                        </div>
                        <h3 className="text-black text-sm font-medium">
                          {qtyCount}
                        </h3>
                        <div
                          onClick={incrementQty}
                          className="w-[22.11px] h-[22.40px] bg-orange-100 rounded-md flex justify-center items-center"
                          style={{
                            backgroundColor: price_background_color + "50",
                          }}
                        >
                          <img
                            src={PlusIcon}
                            alt="plus icon"
                            width="8.9"
                            height="9.1"
                          />
                        </div>
                      </div>
                    </div>
                    {width < 768 && (
                      <div>
                        {(checkboxItems[0]?.length > 0 ||
                          radioItems[0]?.length > 0 ||
                          dropdownItems[0]?.length > 0) && (
                          <div className="px-6 my-4 md:h-[550px]">
                            <div className="product-items flex flex-col gap-5 py-4 divide-y">
                              {/* checkbox */}
                              {Array.isArray(checkbox_input_titles) &&
                                checkbox_input_titles.length > 0 &&
                                checkboxItems[0]?.length > 0 &&
                                checkbox_input_titles.map(
                                  (title, checkbox_idx) => (
                                    <div
                                      id={"checkbox"}
                                      className=""
                                      key={checkbox_idx}
                                    >
                                      {title[0] && (
                                        <>
                                          <h3 className="text-[16px] font-medium mb-1 mt-[16px]">
                                            {language === "en"
                                              ? title[0]
                                              : title[1]}
                                            {checkbox_required[checkbox_idx] ===
                                              "true" && (
                                              <span className="text-red-500">
                                                *
                                              </span>
                                            )}
                                          </h3>
                                          {checkbox_input_maximum_choices[
                                            checkbox_idx
                                          ] <
                                            checkboxItems[checkbox_idx]
                                              .length && (
                                            <span className="text-[12px] mb-[8px]">
                                              {t("Maximum number of choises: ")}
                                              {
                                                checkbox_input_maximum_choices[
                                                  checkbox_idx
                                                ]
                                              }
                                            </span>
                                          )}
                                        </>
                                      )}
                                      <div className="flex flex-col gap-2">
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
                                                  item?.price == 0
                                                    ? t("Free")
                                                    : `${Number(
                                                        item?.price
                                                      )} ${t("SAR")}`
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
                                  )
                                )}

                              {/* selection  */}
                              {Array.isArray(selection_input_titles) &&
                                selection_input_titles.length > 0 &&
                                radioItems[0]?.length > 0 &&
                                selection_input_titles.map(
                                  (title, selection_idx) => (
                                    <div
                                      id={"radio"}
                                      className=""
                                      key={selection_idx}
                                    >
                                      {title[0] && (
                                        <h3 className="text-[16px] font-medium mb-1 mt-[16px]">
                                          {language === "en"
                                            ? title[0]
                                            : title[1]}
                                          <span className="text-red-500">
                                            *
                                          </span>
                                        </h3>
                                      )}
                                      <div className="flex flex-col gap-2">
                                        {radioItems &&
                                          radioItems.length > 0 &&
                                          radioItems[selection_idx]?.map(
                                            (item, idx) => (
                                              <ProductDetailItem
                                                key={idx}
                                                label={
                                                  language === "en"
                                                    ? item?.value[0]
                                                    : item?.value[1]
                                                }
                                                name={`radio_item_${selection_idx}`}
                                                price={
                                                  item.price == 0
                                                    ? t("Free")
                                                    : `${Number(
                                                        item?.price
                                                      )} ${t("SAR")}`
                                                }
                                                isRadio
                                                onChange={(e) =>
                                                  handleRadioChange(
                                                    selection_idx,
                                                    idx,
                                                    e
                                                  )
                                                }
                                              />
                                            )
                                          )}
                                      </div>
                                    </div>
                                  )
                                )}

                              {/* dropdown */}
                              {Array.isArray(dropdown_input_titles) &&
                                dropdown_input_prices?.length > 0 &&
                                dropdown_input_titles.length > 0 &&
                                dropdownItems[0]?.length > 0 &&
                                dropdown_input_titles.map(
                                  (title, dropdown_idx) => (
                                    <div
                                      id={"dropdown"}
                                      className=""
                                      key={dropdown_idx}
                                    >
                                      {title[0] && (
                                        <h3 className="text-[16px] font-medium mb-[8px] mt-[16px]">
                                          {language === "en"
                                            ? title[0]
                                            : title[1]}
                                          <span className="text-red-500">
                                            *
                                          </span>
                                        </h3>
                                      )}
                                      <div className="flex flex-col gap-2 mb-3">
                                        {dropdownItems &&
                                          dropdownItems.length > 0 &&
                                          dropdownItems[dropdown_idx].length >
                                            0 &&
                                          dropdownItems[dropdown_idx][0]
                                            ?.value[0] &&
                                          dropdownItems[dropdown_idx]?.map(
                                            (item, idx) => {
                                              if (idx === 0) {
                                                return (
                                                  <ProductDetailItem
                                                    ref={(el) =>
                                                      (dropdDownRef.current[
                                                        dropdown_idx
                                                      ] = el)
                                                    }
                                                    key={idx}
                                                    isDropDown
                                                    language={language}
                                                    options={
                                                      dropdownItems[
                                                        dropdown_idx
                                                      ]
                                                    }
                                                    optionsPrice={
                                                      dropdown_input_prices[
                                                        dropdown_idx
                                                      ]
                                                    }
                                                    onChange={(e) =>
                                                      handleDropdownChange(
                                                        dropdown_idx,
                                                        Number(e.target.value)
                                                      )
                                                    }
                                                  />
                                                );
                                              }
                                            }
                                          )}
                                      </div>
                                    </div>
                                  )
                                )}
                            </div>
                          </div>
                        )}
                      </div>
                    )}
                  </div>
                  <div className="w-full mt-[20px]">
                    <div
                      className="w-[308px] mx-auto h-10"
                      onClick={() => {
                        if (isLoggedIn) {
                          setSpinner(true);
                          handleAddToCart();
                        } else {
                          closeModal();
                          dispatch(SetLoginModal(true));
                        }
                      }}
                    >
                      <div
                        className="w-[308px] h-10 bg-[#7d0a0a] rounded-tl-[30px] rounded-tr-[30px] flex justify-center items-center hover:cursor-pointer"
                        style={{ backgroundColor: price_background_color }}
                      >
                        <div className="text-center text-white text-[14px] font-medium">
                          {t("Add to cart")}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </Fragment>
            </div>
            {width > 768 && (
              <div
                className={`border-l border-solid border-black/55 !p-0 w-[340px] ${
                  checkboxItems[0]?.length > 0 ||
                  radioItems[0]?.length > 0 ||
                  dropdownItems[0]?.length > 0
                    ? "sm:h-[700px]"
                    : "hidden"
                } flex flex-col justify-start items-center hide-scroll`}
              >
                {(checkboxItems[0]?.length > 0 ||
                  radioItems[0]?.length > 0 ||
                  dropdownItems[0]?.length > 0) && (
                  <div className="px-6 sm:pl-[30px] sm:pr-10 my-4 sm:h-[550px] w-full overflow-auto">
                    <div className="product-items flex flex-col gap-5 py-4 divide-y">
                      {/* checkbox */}
                      {Array.isArray(checkbox_input_titles) &&
                        checkbox_input_titles.length > 0 &&
                        checkboxItems[0]?.length > 0 &&
                        checkbox_input_titles.map((title, checkbox_idx) => (
                          <div id={"checkbox"} className="" key={checkbox_idx}>
                            {title[0] && (
                              <>
                                <h3 className="text-[12px] font-medium mt-[16px] mb-1">
                                  {language === "en" ? title[0] : title[1]}
                                  {checkbox_required[checkbox_idx] ===
                                    "true" && (
                                    <span className="text-red-500">*</span>
                                  )}
                                </h3>
                                {checkbox_input_maximum_choices[checkbox_idx] <
                                  checkboxItems[checkbox_idx].length && (
                                  <span className="text-[10px] mb-2 inline-block">
                                    {t("Maximum number of choises: ")}
                                    {
                                      checkbox_input_maximum_choices[
                                        checkbox_idx
                                      ]
                                    }
                                  </span>
                                )}
                              </>
                            )}
                            <div className="flex flex-col gap-2">
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
                                        item.price == 0
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
                        radioItems[0]?.length > 0 &&
                        selection_input_titles.map((title, selection_idx) => (
                          <div id={"radio"} className="" key={selection_idx}>
                            {title[0] && (
                              <h3 className="text-[12px] font-medium mb-1 mt-[16px]">
                                {language === "en" ? title[0] : title[1]}
                                <span className="text-red-500">*</span>
                              </h3>
                            )}
                            <div className="flex flex-col gap-2">
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
                                    name={`radio_item_${selection_idx}`}
                                    price={
                                      item.price == 0
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
                        dropdown_input_prices?.length > 0 &&
                        dropdown_input_titles.length > 0 &&
                        dropdownItems[0]?.length > 0 &&
                        dropdown_input_titles.map((title, dropdown_idx) => (
                          <div id={"dropdown"} className="" key={dropdown_idx}>
                            {title[0] && (
                              <h3 className="text-[12px] font-medium mb-[8px] mt-[16px]">
                                {language === "en" ? title[0] : title[1]}
                                <span className="text-red-500">*</span>
                              </h3>
                            )}
                            <div className="flex flex-col gap-2 mb-3">
                              {dropdownItems &&
                                dropdownItems.length > 0 &&
                                dropdownItems[dropdown_idx][0]?.value[0] &&
                                dropdownItems[dropdown_idx]?.map(
                                  (item, idx) => {
                                    if (idx === 0) {
                                      return (
                                        <ProductDetailItem
                                          ref={(el) =>
                                            (dropdDownRef.current[
                                              dropdown_idx
                                            ] = el)
                                          }
                                          key={idx}
                                          isDropDown
                                          language={language}
                                          options={dropdownItems[dropdown_idx]}
                                          optionsPrice={
                                            dropdown_input_prices[dropdown_idx]
                                          }
                                          onChange={(e) =>
                                            handleDropdownChange(
                                              dropdown_idx,
                                              Number(e.target.value)
                                            )
                                          }
                                        />
                                      );
                                    }
                                  }
                                )}
                            </div>
                          </div>
                        ))}
                    </div>
                  </div>
                )}
              </div>
            )}
          </div>
        </div>
      </dialog>
    </Fragment>
  );
};

export default ProductItem;
