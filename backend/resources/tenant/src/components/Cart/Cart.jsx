import React, { useState, useEffect, useRef } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { useTranslation } from "react-i18next";
import ResizeDetector from 'react-resize-detector';
import AxiosInstance from "../../axios/axios";
import Header from "../Customers/CustomersEditor/components/header";
import Logo from "../Restaurants/RestaurantsEditor/components/Logo";
import Hero from "../Restaurants/RestaurantsEditor/components/Hero";


const Cart = () => {
  const divWidth = useSelector((state) => state.divWidth.value);
  const divRef = useRef(null);
  const selectedFontFamily = useSelector((state) => state.fonts.selectedFontFamily);


  const dispatch = useDispatch();
    const Language = sessionStorage.getItem('Language');
    const { t } = useTranslation();
    const [cart, setCart] = useState([]);


    const fetchCartData = async () => {
        try {
            const cartResponse = await AxiosInstance.get(`cart`);

            console.log("cart >>>", cartResponse.data)
            if (cartResponse.data) {
                setCart(cartResponse.data?.data);

            }


        } catch (error) {
            // toast.error(`${t('Failed to send verification code')}`)
            console.log(error);
        }
    };


    useEffect(() => {
        fetchCartData().then(r => null);
    }, []);


  useEffect(() => {
    if (divRef.current) {
      const newWidth = divRef.current.clientWidth;
      if (newWidth <= 900) {
        dispatch(setDivWidth(900));
      } else {
        dispatch(setDivWidth(newWidth));
      }
    }
    handleResize();
    window.addEventListener('resize', handleResize);
    return () => {
      window.removeEventListener('resize', handleResize);
    };
  }, []);


  return (
    <div ref={divRef} className="w-[100%] bg-white h-[85vh] overflow-y-auto" style={{ fontFamily: `${selectedFontFamily}`, fontWeight: `${selectedFontWeight}`,fontSize:`${selectedFontFamily}` }}>
      <Header />
      <div className=''>

        <div className={`${selectedAlign === "Center" ? "justify-center" : ""}
        ${selectedAlign === "Left" && Language === "en" ? "justify-start" : selectedAlign === "Left" ? "justify-end" : ""}
        ${selectedAlign === "Right" && Language === "en" ? "justify-end" : selectedAlign === "Right" ? "justify-start" : ""}
        flex items-center  gap-4`}>
          <div className='my-[35px] mx-4 text-center'>
            <Logo url={styleData?.logo}/>
          </div>
        </div>
        <Hero />
      </div>
      <div className={`mt-[30px] mb-[50px] ${divWidth >= 744 ? "mx-[40px]" : ""}`}>
        <div>
          <div>
            <div className={`px-[30px] text-xl`}>
                {cart?.length > 0 ?
                    <>
                        <h2>Cart Items:</h2>
                    </>
                    : <h2>No Items in cart yet!</h2>}
            </div>
          </div>
        </div>
      </div>
      <Footer />
      <ResizeDetector onResize={handleResize} />
    </div>
  );
};

export default Cart;
