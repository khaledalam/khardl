import React, { useState, useEffect } from "react";
import { motion } from "framer-motion";
import { FiX } from "react-icons/fi";
import { useDispatch } from 'react-redux';
import { useTranslation } from "react-i18next";
import { addItemToCart } from '../../../../redux/editor/cartSlice';
import { MdKeyboardArrowDown } from 'react-icons/md';

const DetailesItem = ({
  itemId,
  onClose,
  title,
  description,
  image,
  calories,
  price,
  selection_input_titles,
  selection_input_names,
  selection_input_prices,
  checkbox_required,
  checkbox_input_titles,
  checkbox_input_names,
  checkbox_input_prices,
  dropdown_input_names,
}) => {
  const shapeImageShape = sessionStorage.getItem('shapeImageShape');
  const GlobalColor = sessionStorage.getItem('globalColor');
  const GlobalShape = sessionStorage.getItem('globalShape');
  const Language = sessionStorage.getItem('Language');
  const dispatch = useDispatch();

  const { t } = useTranslation();
  const [count, setCount] = useState(1);
  const [items, setItems] = useState(
    checkbox_input_names?.map((name, index) => ({
      value: name,
      isChecked: false,
      price: checkbox_input_prices[index]
    }))
  );
  useEffect(() => {
    const requiredCheckboxes = Math.max(checkbox_required, 0);
    const updatedItems = [...items];

    for (let i = 0; i < requiredCheckboxes; i++) {
      if (i < updatedItems.length) {
        updatedItems[i].isChecked = true;
      }
    }
    setItems(updatedItems);
  }, [checkbox_required]);

  const handleCheckboxChange = (index) => {
    const updatedItems = [...items];
    updatedItems[index].isChecked = !updatedItems[index].isChecked;
    setItems(updatedItems);
  };

  const [radioItems, setRadioItems] = useState(
    selection_input_names.map((name, index) => ({
      value: name,
      isChecked: index === 0,
      price: selection_input_prices[index]
    }))
  );

  const handleRadioChange = (index) => {
    const updatedRadioItems = [...radioItems];
    updatedRadioItems.forEach((item, i) => {
      item.isChecked = i === index;
    });
    setRadioItems(updatedRadioItems);
  };

  const totalCheckbox = items.reduce((accumulator, currentItem) => {
    if (currentItem.isChecked) {
      return accumulator + currentItem.price;
    }
    return accumulator;
  }, 0);

  const selectedRadioItem = radioItems.find((item) => item.isChecked);
  const totalRadio = selectedRadioItem ? selectedRadioItem.price : 0;

  const total = price + totalCheckbox + totalRadio;

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
      console.log(itemId);
        try {
            const response = await AxiosInstance.post(`/carts`, {
                item_id : itemId,
                quantity : count,
                branch_id: branch_id
            });

            console.log("response " , response)

            if (response?.data) {
                toast.success(`${t('Item added to cart')}`);
            }
        } catch (error) {
            toast.error(error);
        }
        dispatch(addItemToCart("props.description"));
    };


    return (
    <>
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
            <div className="modal max-w-md min-w-[480px] h-[95vh] bg-white overflow-y-auto mx-5 xl:max-w-xl lg:max-w-xl md:max-w-xl max-h-screen shadow-lg flex-row rounded-lg">
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
                  <div className="text-[18px] font-semibold">{title}</div>
                  <div className="text-[18px] font-semibold">{calories} {t("calories")} </div>
                </div>
                <div className="my-2 text-[15px]">{description}</div>
                <div className="max-w-xl m-4 text-start">
                  <div className="flex flex-col text-black font-bold items-center justify-center">
                    <div className="text-[16px] w-fit p-1 px-4 my-2"
                      style={{ borderRadius: GlobalShape, backgroundColor: GlobalColor }}
                    >{price} {t("SAR")}</div>
                  </div>
                  <div className="border-b border-ternary-light my-2 mx-10 p-4">
                    <div className="text-[16px] font-semibold">{checkbox_input_titles}</div>
                    <div className="flex justify-between items-center">
                      <div>
                        {items.map((item, index) => (
                          <div key={index} className="flex justify-start items-center gap-2">
                            <input
                              id={`checkbox-${index}`}
                              type="checkbox"
                              value=""
                              checked={item.isChecked}
                              onChange={() => handleCheckboxChange(index)}
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
                        {items.map((item, index) => (
                          <div key={index} className="text-[14px]">{item.price} {t("SAR")}</div>
                        ))}
                      </div>
                    </div>
                  </div>
                    {radioItems.length > 0 &&
                  <div className="border-b border-ternary-light mx-10 p-4">
                    <div className="text-[16px] font-semibold ">{selection_input_titles}</div>
                    <div className="flex justify-between items-center">
                      <div>
                        {radioItems?.map((item, index) => (
                          <div key={index} className="flex justify-start items-center gap-2">
                            <input
                              id={`radio-${index}`}
                              type="radio"
                              checked={item.isChecked}
                              onChange={() => handleRadioChange(index)}
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
                        {radioItems?.map((item, index) => (
                          <div key={index} className="text-[14px]">{item.price} {t("SAR")}</div>
                        ))}
                      </div>
                    </div>
                  </div>}

                    {dropdown_input_names.length > 0 &&
                  <div className="border-b border-ternary-light mx-10 p-3 ">
                    <div className="">
                      <div className='relative w-[100%] my-2'>
                        <select className='text-[14px] bg-[var(--secondary)]  w-[100%] p-1 rounded-full px-4 appearance-none'>
                          {dropdown_input_names?.map((cook, index) => (
                            <option className="bg-white text-black" key={index}>{cook}</option>
                          ))}
                        </select>
                        <MdKeyboardArrowDown className={`absolute top-1/2 ${Language == "en" ? "right-4" : "left-4"} transform -translate-y-1/2 text-black`} />
                      </div>
                    </div>
                  </div>}

                  <div className="border-b border-ternary-light my-2 mx-10 p-4">
                    <div className="">
                      <div className="text-[15px] font-semibold mb-2">{t("feedback")}</div>
                      <textarea className="w-[100%] bg-[var(--secondary)]" placeholder={t("")} />
                    </div>
                  </div>
                  <div className="flex justify-between items-center my-2 mx-10 p-4">
                    <div className="text-[15px] font-semibold">{t("Quantity")}</div>
                    <div className="flex justify-center items-center rounded-[80px]">
                      <button
                        onClick={decrement}
                        className="w-[30px] h-[30px] text-black font-bold"
                        style={{ borderRadius: GlobalShape, backgroundColor: GlobalColor }}
                      >-</button>
                      <div className={`w-[40px] bg-[var(--third)] text-center ${GlobalShape == "20px" ? "mx-1" : ""}`}
                        style={{ borderRadius: GlobalShape }}
                      >
                        <span>{count}</span>
                      </div>
                      <button
                        onClick={increment}
                        className="w-[30px] h-[30px] text-black font-bold"
                        style={{ borderRadius: GlobalShape, backgroundColor: GlobalColor }}
                      >+</button>
                    </div>
                  </div>
                  <div className="flex justify-center items-center my-4 pb-8">
                    <button
                      className="p-1 px-10 text-[16px] text-black font-bold bg-[var(--primary)]"
                      style={{ borderRadius: GlobalShape, backgroundColor: GlobalColor }}
                      onClick={handleAddToCart}
                    >
                      {t("Add to cart")} ({total * count} {t("SAR")})
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      </motion.div>
    </>
  );
};
export default DetailesItem;


