import React, { useContext, useEffect, useState } from "react";
import { IoMenuOutline } from "react-icons/io5";
import { useNavigate } from "react-router-dom";
import cartHeaderImg from "../../../assets/cartBoldIcon.svg";
import { MenuContext } from "react-flexible-sliding-menu";
import { useDispatch, useSelector } from "react-redux";
import AxiosInstance from "../../../axios/axios";
import { getCartItemsCount } from "../../../redux/NewEditor/categoryAPISlice";
import MobileMenu from "../components/MobileMenu";
import homeIcon from "../../../assets/homeIcon.svg";
import { useTranslation } from "react-i18next";

const NavbarCustomer = ({
  customerDashboard = false,
  showMenu,
  setShowMenu,
}) => {
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const restaurantStyle = useSelector((state) => state.restuarantEditorStyle);
  const { t } = useTranslation();
  // const [cartItemsCount, setCartItemsCount] = useState(0);
  // const cartItems = useSelector((state) => state.cart.items);
  // const cartItemsCount = useSelector(
  //     (state) => state.categoryAPI.cartItemsCount,
  // );
  const isLoggedIn = JSON.parse(localStorage.getItem("isLoggedIn"));
  //
  // const fetchCartData = async () => {
  //     if (isLoggedIn == true) {
  //         try {
  //             const cartResponse = await AxiosInstance.get(`carts/count`);
  //             if (cartResponse.data) {
  //                 const count = cartResponse.data?.data?.count || 0;
  //                 dispatch(getCartItemsCount(count));
  //             }
  //         } catch (error) {
  //             // toast.error(`${t('Failed to send verification code')}`)
  //             console.log(error);
  //         }
  //     } else {
  //         console.log("user Unauthenticated");
  //     }
  // };
  //
  // useEffect(() => {
  //     fetchCartData().then(() => {
  //         console.log("fetched cart items count successfully");
  //     });
  // }, []);

  return (
    <div className="h-[70px] w-full bg-white flex items-center justify-between px-4 xl:px-8 mt-3">
      {customerDashboard && <MobileMenu />}
      <IoMenuOutline
        size={42}
        className="text-neutral-400 cursor-pointer hidden md:block"
        onClick={() => setShowMenu(!showMenu)}
      />
      <div
        onClick={() => navigate("/")}
        className="w-[50px] h-[50px] rounded-lg bg-neutral-200 relative flex items-center justify-center cursor-pointer"
        style={{
          borderColor: restaurantStyle?.categoryDetail_cart_color,
        }}
      >
        <img src={homeIcon} alt="home" />
      </div>
    </div>
  );
};

export default NavbarCustomer;
