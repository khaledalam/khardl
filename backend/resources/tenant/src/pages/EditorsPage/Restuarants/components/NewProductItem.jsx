import { useDispatch, useSelector } from "react-redux";
import GreenDot from "../../../../assets/greenDot.png";
import { useTranslation } from "react-i18next";
import KcalIcon from "../../../../assets/kcalIcon.png";
import imgHotFire from "../../../../assets/hot-fire.svg";
import PlusIcon from "../../../../assets/plusIcon.png";
import MinusIcon from "../../../../assets/minusIcon.png";
import { useEffect, useReducer, useRef, useState } from "react";
import { FiMinus, FiPlus } from "react-icons/fi";
import { SetLoginModal } from "../../../../redux/NewEditor/restuarantEditorSlice";
import { getCartItemsCount } from "../../../../redux/NewEditor/categoryAPISlice";
import AxiosInstance from "../../../../axios/axios";
import { toast } from "react-toastify";

const ProductItem = ({
  id,
  imgSrc,
  name,
  description,
  caloryInfo,
  amount,
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
  const { t } = useTranslation();
  const [openModal, setOpenModal] = useState();
  const [feedback, setFeedback] = useState("");
  const [qtyCount, setQtyCount] = useState(1);
  const language = useSelector((state) => state.languageMode.languageMode);

  const [checkBoxItems, setCheckBoxItems] = useState([]);
  const [checkedStatus, setCheckedStatus] = useState([]);
  const [selectionItems, setSelectionItems] = useState([]);
  const [selectedStatus, setSelectedStatus] = useState([]);
  const [dropdownItems, setDropdownItems] = useState([]);
  const [dropdownStatus, setDropdownStatus] = useState([]);
  const [totalPrice, setTotalPrice] = useState(0);
  const [spinner, setSpinner] = useState(false);
  const modalRef = useRef(null);

  const dispatch = useDispatch();
  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn);
  const handleAddToCart = async () => {
    try {
      let checkedResult = [];
      checkedStatus.map((row) => {
        let array = [];
        for (let i = 0; i < row.length; i += 1) {
          if (row[i] == "1") {
            array.push(i);
          }
        }
        checkedResult.push(array);
      });

      setSpinner(true);
      const branch_id = localStorage.getItem("selected_branch_id");
      let payload = {
        item_id: id,
        quantity: qtyCount,
        branch_id: branch_id,
        notes: feedback,
        selectedCheckbox: checkedResult,
        selectedRadio: selectedStatus,
        selectedDropdown: dropdownStatus,
      };
      const response = await AxiosInstance.post(`/carts`, payload);
      if (response?.data) {
        toast.success(t("Item added to cart"));
        dispatch(getCartItemsCount(response?.data.data.count));
      }
      setOpenModal(false);
      setSpinner(false);
      setFeedback();
      setQtyCount(1);
    } catch (error) {
      console.error(error);
      setSpinner(false);
      toast.error(error.response?.data?.message);
      setOpenModal(false);
      setFeedback();
      setQtyCount(1);
    }
  };

  useEffect(() => {
    let tempArray = [],
      statusArray = [];
    checkbox_input_titles.map((title, index) => {
      if (!title?.length) {
        return;
      }
      let temp = {
        required: checkbox_required[index],
        title: checkbox_input_titles[index],
        items: [],
        maximumCounts: checkbox_input_maximum_choices[index],
      };
      let status = null;
      checkbox_input_names[index]?.map((name, id) => {
        temp.items.push({
          name,
          price: checkbox_input_prices[index][id],
        });
        status += "0";
      });
      tempArray.push(temp);
      statusArray.push(status);
    });

    setCheckBoxItems(tempArray);
    setCheckedStatus(statusArray);
  }, [
    openModal,
    checkbox_required,
    checkbox_input_titles,
    checkbox_input_names,
    checkbox_input_prices,
    checkbox_input_maximum_choices,
  ]);

  useEffect(() => {
    let tempArray = [],
      statusArray = [];
    selection_input_titles.map((title, index) => {
      if (!title?.length) {
        return;
      }
      let temp = {
        required: selection_required[index],
        title: selection_input_titles[index],
        items: [],
      };
      selection_input_names[index]?.map((name, id) => {
        temp.items.push({
          name,
          price: selection_input_prices[index][id],
        });
      });
      tempArray.push(temp);
      statusArray.push(null);
    });

    setSelectedStatus(statusArray);
    setSelectionItems(tempArray);
  }, [
    openModal,
    selection_required,
    selection_input_titles,
    selection_input_names,
    selection_input_prices,
  ]);

  useEffect(() => {
    let tempArray = [],
      statusArray = [];
    dropdown_input_titles.map((title, index) => {
      if (!title?.length) {
        return;
      }
      let temp = {
        required: dropdown_required[index],
        title: dropdown_input_titles[index],
        items: [],
      };
      dropdown_input_names[index]?.map((name, id) => {
        temp.items.push({
          name,
          price: dropdown_input_prices[index][id],
        });
      });
      tempArray.push(temp);
      statusArray.push(null);
    });

    setDropdownStatus(statusArray);
    setDropdownItems(tempArray);
  }, [
    openModal,
    dropdown_required,
    dropdown_input_titles,
    dropdown_input_names,
    dropdown_input_prices,
  ]);

  useEffect(() => {
    const handleClickOutside = (event) => {
      if (modalRef.current && !modalRef.current.contains(event.target)) {
        setOpenModal(false);
      }
    };

    document.addEventListener("mousedown", handleClickOutside);

    return () => {
      document.removeEventListener("mousedown", handleClickOutside);
    };
  }, []);

  useEffect(() => {
    let total = qtyCount * amount;
    checkedStatus.map((row, index) => {
      for (let i = 0; i < row.length; i += 1) {
        if (row[i] == "1") {
          total += parseFloat(checkbox_input_prices[index][i]);
        }
      }
    });
    selectedStatus.map((value, index) => {
      if (value != null) {
        total += parseFloat(selection_input_prices[index][value]);
      }
    });
    dropdownStatus.map((value, index) => {
      if (value != null) {
        total += parseFloat(dropdown_input_prices[index][value]);
      }
    });
    setTotalPrice(total);
  }, [qtyCount, checkedStatus, selectedStatus, dropdownStatus]);

  return (
    <>
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
        style={{
          backgroundColor: menu_card_background_color,
          borderRadius: menu_card_radius + "px",
        }}
        className="w-full max-w-32 shadow-md sm:max-w-36 h-44 hover:scale-110 transform transition-all cursor-pointer overflow-hidden duration-300 ease-in-out"
        onClick={() => setOpenModal(true)}
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
              fontWeight: menu_name_text_weight,
              fontSize: menu_name_text_size,
            }}
            className="relative"
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
                  fontWeight: total_calories_text_weight,
                  fontSize: total_calories_text_size,
                }}
                className="relative"
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
                  fontWeight: price_text_weight,
                  fontSize: price_text_size,
                }}
                className=""
              >
                {t("SAR")} {amount}
              </div>
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
        className="modal mx-auto overflow-y-auto font-jakarta pt-10 pb-5 z-[1001]"
        open={openModal}
      >
        <div className="relative mx-auto" ref={modalRef}>
          <button
            className="btn btn-xs btn-circle bg-white text-black absolute -right-2 -top-2 hover:rotate-90 hover:bg-gray-100"
            onClick={() => setOpenModal(false)}
          >
            ✕
          </button>
          <div className="flex flex-col px-4 pt-4 pb-[70px] bg-white rounded-md w-[390px] h-[500px] sm:h-[700px] gap-4 shadow-lg border-gray-100 border overflow-y-scroll scrollbar-custom">
            <div className="flex flex-row gap-4 border border-orange-100 rounded-xl p-2.5">
              <img
                src={imgSrc}
                alt="product"
                className="w-20 h-20 rounded-md min-w-20 max-w-20"
              />
              <div className="flex flex-col gap-2.5 min-h-[68px]">
                <div className="flex flex-col gap-2 justify-center">
                  <div className="text-neutral-700 font-semibold font-['Plus Jakarta Sans'] text-base leading-[18px]">
                    {name}
                  </div>
                  <div className="w-[248px] text-neutral-700 text-xs font-normal font-['Plus Jakarta Sans'] leading-none min-h-8">
                    {description}
                  </div>
                </div>
                <div className="h-8 px-4 py-2 bg-orange-100/opacity-10 rounded-2xl border border-orange-10 items-center gap-[5px] inline-flex w-fit">
                  <img src={imgHotFire} alt="hot" className="w-3 h-3" />
                  <span className="text-neutral-700 text-[10px] font-semibold font-['Plus Jakarta Sans'] leading-none">
                    {caloryInfo}
                  </span>
                  <span className="text-neutral-700 text-[10px] font-light font-['Plus Jakarta Sans'] leading-non">
                    {t("Kcal")}
                  </span>
                </div>
              </div>
            </div>
            <div className="flex flex-row justify-between items-center">
              <div className="text-neutral-700 font-bold font-['Plus Jakarta Sans']">
                {t("TOTAL")}
              </div>
              <div className="flex flex-row gap-2.5 items-center">
                <div className="text-red-900 text-sm font-bold font-['Plus Jakarta Sans'] leading-tight">
                  {t("SAR")}&nbsp;{totalPrice.toFixed(2)}
                </div>
                <div className="flex gap-2 rounded-[30px] border border-orange-100 justify-between items-center min-w-32 select-none">
                  <FiMinus
                    className={`flex w-[29px] h-[29px] ${
                      qtyCount > 1
                        ? "bg-red-900 border-red-900 text-white cursor-pointer hover:bg-white hover:text-red-900"
                        : "bg-neutral-50 border-gray-200 text-gray-200"
                    } rounded-[32px] border p-1.5 gap-2.5 transition-all`}
                    onClick={() => qtyCount > 1 && setQtyCount(qtyCount - 1)}
                  />
                  {qtyCount}
                  <FiPlus
                    className="flex w-[29px] h-[29px] bg-red-900 border-red-900 rounded-[32px] border p-1.5 gap-2.5 text-white cursor-pointer hover:bg-white hover:text-red-900"
                    onClick={() => setQtyCount(qtyCount + 1)}
                  />
                </div>
              </div>
            </div>
            {checkBoxItems.map((checkBoxItem, index) => (
              <div
                key={index}
                className="pb-4 border-b border-gray-200 flex-col gap-2"
              >
                <div className="text-neutral-700 font-medium font-['Plus Jakarta Sans'] leading-[18px]">
                  {language == "en"
                    ? checkBoxItem.title[0]
                    : checkBoxItem.title[1]}
                  {checkBoxItem.required === "true" && (
                    <span className="text-red-500">*</span>
                  )}
                </div>
                {checkBoxItem.maximumCounts < checkBoxItems.length && (
                  <div className="text-xs flex justify-end -mt-3">
                    {t("Maximum number of choises: ") +
                      checkBoxItem.maximumCounts}
                  </div>
                )}
                <div>
                  {checkBoxItem.items?.map((item, id) => (
                    <div
                      key={id}
                      className="flex flex-row items-center justify-between"
                    >
                      <div className="flex flex-row gap-2 items-center">
                        <input
                          className="w-[16px] h-[16px] accent-[#FFECD6] border border-[#e5e7eb] checked:border-[#7D0A0A] rounded-[4px] checked:accent-[#FFECD6] focus:accent-[#FFECD6] checked:ring-1 checked:ring-[#7D0A0A]"
                          type="checkbox"
                          disabled={
                            checkedStatus[index][id] == "0" &&
                            checkBoxItem.maximumCounts <=
                              (() => {
                                const matches =
                                  checkedStatus[index].match(/1/g);
                                return matches ? matches.length : 0;
                              })()
                          }
                          checked={checkedStatus[index][id] == "1"}
                          onChange={() =>
                            setCheckedStatus((currentStatus) =>
                              currentStatus.map((row, idx) => {
                                if (idx === index) {
                                  return (
                                    row.substring(0, id) +
                                    (row[id] === "0" ? "1" : "0") +
                                    row.substring(id + 1)
                                  );
                                }
                                return row;
                              })
                            )
                          }
                        />
                        <p className="text-[10px] font-normal">
                          {language == "en" ? item.name[0] : item.name[1]}
                        </p>
                      </div>
                      <span className="label-text text-[10px] font-semibold">
                        {item.price}
                      </span>
                    </div>
                  ))}
                </div>
              </div>
            ))}
            {selectionItems.map((selectionItem, index) => (
              <div
                key={index}
                className="pb-4 border-b border-gray-200 flex-col gap-2"
              >
                <div className="text-neutral-700 font-medium font-['Plus Jakarta Sans'] leading-[18px]">
                  {language == "en"
                    ? selectionItem.title[0]
                    : selectionItem.title[1]}
                  {selectionItem.required === "true" && (
                    <span className="text-red-500">*</span>
                  )}
                </div>
                <div>
                  {selectionItem.items?.map((item, id) => (
                    <div
                      key={id}
                      className="cursor-pointer flex items-center justify-between"
                    >
                      <div className="flex flex-row items-center gap-2">
                        <input
                          className="w-[14px] h-[14px] border checked:border-[3px] checked:bg-[#7D0A0A]"
                          type="radio"
                          checked={selectedStatus[index] == id}
                          onChange={() =>
                            setSelectedStatus((currentStatus) =>
                              currentStatus.map((status, idx) =>
                                idx == index ? id : status
                              )
                            )
                          }
                        />
                        {language == "en" ? item.name[0] : item.name[1]}
                      </div>
                      <span className="label-text text-[10px] font-semibold">
                        {item.price}
                      </span>
                    </div>
                  ))}
                </div>
              </div>
            ))}
            {dropdownItems.map((dropdownItem, index) => (
              <div
                key={index}
                className="pb-4 border-b border-gray-200 flex-col gap-2"
              >
                <div className="text-neutral-700 font-medium font-['Plus Jakarta Sans'] leading-[18px]">
                  {language == "en"
                    ? dropdownItem.title[0]
                    : dropdownItem.title[1]}
                  {dropdownItem.required === "true" && (
                    <span className="text-red-500">*</span>
                  )}
                </div>
                <select
                  className="w-full cursor-pointer text-xs h-8 min-h-5 bg-white select select-bordered"
                  key={id}
                  value={dropdownStatus[index]}
                  onChange={(event) =>
                    setDropdownStatus((currentStatus) =>
                      currentStatus.map((status, idx) =>
                        idx == index ? parseInt(event.target.value) : status
                      )
                    )
                  }
                >
                  <option disabled value={null}>
                    {t("select option")}
                  </option>
                  {dropdownItem.items?.map((item, id) => (
                    <option
                      key={id}
                      value={id}
                      className="bg-white p-2 py-4 border-b border-gray-300"
                    >
                      {(language == "en" ? item.name[0] : item.name[1]) +
                        " " +
                        item.price +
                        " " +
                        t("SAR")}
                    </option>
                  ))}
                </select>
              </div>
            ))}
            <div className="relative mt-2 h-full">
              <div className="text-zinc-700 text-xs font-normal font-['Plus Jakarta Sans'] absolute -top-2 bg-white rounded-md px-2">
                {t("Order notes")}
              </div>
              <textarea
                type="text"
                placeholder={t("e.g. Please make the meat super tender.")}
                value={feedback}
                onChange={(e) => setFeedback(e.target.value)}
                className="w-full px-2 py-3 resize-none outline-none min-h-[78px] text-black text-xs font-light placeholder-black/30 border-gray-200 border rounded-md h-full"
              />
            </div>
            <div className="flex text-center items-center w-[358px] h-[70px] bg-white absolute bottom-0">
              <div
                className="w-full px-4 py-2.5 bg-red-900 rounded-[50px] border text-white border-red-900 transition-all cursor-pointer hover:text-red-900 hover:bg-white text-xs"
                onClick={() => {
                  if (isLoggedIn) {
                    handleAddToCart();
                  } else {
                    setOpenModal(false);
                    dispatch(SetLoginModal(true));
                  }
                }}
              >
                {t("Add to cart")}
              </div>
            </div>
          </div>
        </div>
      </dialog>
    </>
  );
};

export default ProductItem;
