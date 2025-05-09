import React, { useContext, useEffect, useState } from "react";
import SideNavbar from "./components/SideNavbar";
import NavbarCustomer from "./components/NavbarCustomer";
import { useSelector, useDispatch } from "react-redux";
// import CustomerDashboard from "./components/CustomerDashboard";
import CustomerOrder from "./components/NewCustomerOrder";
import CustomerProfile from "./components/CustomerProfile";
import { useNavigate, useSearchParams } from "react-router-dom";
import CustomerOrderDetail from "./components/NewCustomerOrderDetail";
import { RiMenuFoldFill } from "react-icons/ri";
import CustomerPayment from "./components/NewCustomerPayment";
import AxiosInstance from "../../axios/axios";
import { useTranslation } from "react-i18next";
import { changeRestuarantEditorStyle } from "../../redux/NewEditor/restuarantEditorSlice";
import { changeStyleDataRestaurant } from "../../redux/editor/styleDataRestaurantSlice";
import CustomerAddresses from "./components/CustomerAddresses";

export const CustomerPage = () => {
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const { t } = useTranslation();
  const activeNavItem = useSelector((state) => state.customerAPI.activeNavItem);
  const [searchParam] = useSearchParams();
  const [showOrderDetail, setShowOrderDetail] = useState(false);
  const [showMenu, setShowMenu] = useState(true);

  const pages = {};
  // pages[t("Dashboard")] = <CustomerDashboard />;
  pages[t("Orders")] = <CustomerOrder />;
  pages[t("Profile")] = <CustomerProfile />;
  pages[t("Addresses")] = <CustomerAddresses />;
  // pages[t("Wallet")] = <CustomerPayment />;

  let orderId = searchParam.get("orderId");


  useEffect(() => {
    if (orderId) {
      setShowOrderDetail(true);
    } else {
      setShowOrderDetail(false);
    }
  }, [orderId]);

  const fetchCustomerCards = async () => {
    try {
      const restaurantStyleResponse = await AxiosInstance.get(
        `cards`
      );
      // const restaurantStyleResponse = await AxiosInstance.delete(
      //   `cards/card_id_here/delete`
      // );@

     /*  if (restaurantStyleResponse.data) {
          console.log(restaurantStyleResponse.data);
      } */
    } catch (error) {
      console.log(error);
    }
  };

  const fetchResStyleData = async () => {
    try {
      const restaurantStyleResponse = await AxiosInstance.get(
        `restaurant-style`
      );

      if (restaurantStyleResponse.data) {
        dispatch(changeStyleDataRestaurant(restaurantStyleResponse.data?.data));
        dispatch(
          changeRestuarantEditorStyle(restaurantStyleResponse.data?.data)
        );
      }
    } catch (error) {
      // toast.error(`${t('Failed to send verification code')}`)
      console.log(error);
    }
  };

  useEffect(() => {
    fetchResStyleData();
    fetchCustomerCards();
  }, []);

  return (
    <div>
      <NavbarCustomer
        customerDashboard={true}
        setShowMenu={setShowMenu}
        showMenu={showMenu}
      />
      <div className="flex bg-white h-[calc(100vh-85px)] w-full transition-all text-xs sm:text-sm">
        <div
          className={`transition-opacity transition-width duration-300 ease-in-out overflow-hidden bg-white h-full hidden ${
            !showMenu
              ? "w-0 opacity-0 hidden"
              : "w-fit xl:w-1/5 laptopXL:w-1/6 opacity-100 md:block"
          }`}
        >
          <SideNavbar />
        </div>
        <div className="transition-all flex-[100%] w-full md:flex-[80%] xl:flex-[80%] laptopXL:flex-[83%] overflow-x-hidden bg-neutral-100 h-full overflow-y-scroll hide-scroll rounded-xl m-3">
          {showOrderDetail ? (
            <CustomerOrderDetail orderId={orderId} />
          ) : (
            pages[t(activeNavItem)]
          )}
        </div>
      </div>
    </div>
  );
};
