import { BsChevronDoubleDown, BsChevronDoubleUp } from "react-icons/bs";
import DashboardIcon from "../../../assets/dashboardBlockIcon.svg";
import OrderTable from "./OrderTable";
import { customerOrderData } from "../DATA";
import React, { useCallback, useEffect, useState } from "react";
import AxiosInstance from "../../../axios/axios";
import { useNavigate } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { useTranslation } from "react-i18next";
import {
  updateOrderList,
  updateOrdersMeta,
  updatePageLinks,
} from "../../../redux/NewEditor/customerSlice";
const CustomerDashboard = () => {
  const navigate = useNavigate();
  const { t } = useTranslation();
  const dispatch = useDispatch();
  const ordersList = useSelector((state) => state.customerAPI.ordersList);
  const [isViewMore, setIsViewMore] = useState(false);
  const [isLoading, setIsLoading] = useState(false);
  const [cashback, setCashback] = useState(0);
  const [loyaltyPoints, setLoyaltyPoints] = useState(0);

  const fetchOrderPerpage = async () => {
    try {
      const ordersResponse = await AxiosInstance.get(
        `orders?items&item&per_page=${6}&page=${""}&search=${""}&status=${""}`
      );

      if (ordersResponse.data) {
        dispatch(updateOrderList(Object.values(ordersResponse?.data?.data)));
        dispatch(updatePageLinks(ordersResponse?.data.links));
        dispatch(updateOrdersMeta(ordersResponse?.data.meta));
      }
    } catch (error) {
      console.log(error);
    } finally {
    }
  };

  // useEffect(() => {
  //   fetchProfileData().then((r) => null);
  // }, []);
  useEffect(() => {
    fetchProfileData().then((r) => null);
    fetchOrderPerpage().then(() => {});
  }, []);

  const fetchProfileData = async () => {
    if (isLoading) return;
    setIsLoading(true);

    try {
      const profileResponse = await AxiosInstance.get(`user`);

      if (profileResponse.data) {
        setCashback(profileResponse.data?.data?.cashback);
        setLoyaltyPoints(profileResponse.data?.data?.loyalty_points);
      }
    } catch (error) {
      console.log(error);
    } finally {
      setIsLoading(false);
    }
  };

  const overviewInfo = [
    // @TODO: add wallet after handle pay with point and cashback
    // @TODO: uncomment tht cashback and Loyalty points
    // {
    //   id: 1,
    //   title: t("Wallet"),
    //   amount: 700,
    // },
    // {
    //     id: 2,
    //     title: t("Loyalty Point"),
    //     amount: loyaltyPoints || 0,
    // },
    // {
    //     id: 3,
    //     title: t("Total CashBack"),
    //     amount: cashback || 0,
    // },
  ];

  // const onViewMore = useCallback(() => {
  //   setOrderLength((prev) => prev + 6)
  //   setIsViewMore(true)
  // }, [])

  // const hideMore = useCallback(() => {
  //   setOrderLength((prev) => prev - 6)
  //   setIsViewMore(false)
  // }, [])


  return (
    <div className="m-4 mt-8 md:m-12 mb-5">
      <div className="flex items-center gap-3">
        <img src={DashboardIcon} alt="dashboard" className="w-8" />
        <h3 className="text-3xl font-medium">{t("Dashboard")}</h3>
      </div>
      <div className="w-full md:w-[80%] laptopXL:w-[70%] mx-auto flex items-center justify-around my-5">
        {overviewInfo.map((overview) => (
          <div
            key={overview?.id}
            className="w-[30%] md:w-[25%] h-[80px] md:h-[110px] rounded-2xl bg-[var(--customer)] p-3 text-white flex flex-col gap-3"
          >
            <h4 className="text-xs md:text-sm line-clamp-1 truncate">
              {overview?.title}
            </h4>
            <h2 className="font-bold text-white text-center text-sm md:text-2xl">
              {!isLoading ? (
                overview?.amount
              ) : (
                <span className="loading loading-spinner text-secondary" />
              )}
            </h2>
          </div>
        ))}
      </div>
      <div className="w-full">
        <h3 className="my-4">{t("Last Orders")}</h3>
        <div className="overflow-x-scroll hide-scroll">
          <OrderTable data={ordersList} />
        </div>
      </div>
      {ordersList.length > 0 && (
        <div className="w-full p-5 flex items-center justify-center cursor-pointer">
          <div
            onClick={() => navigate("/profile-summary#Orders")}
            className="flex items-center gap-2 w-36 rounded-2xl bg-[var(--customer)] p-3 text-white"
          >
            <BsChevronDoubleDown size={20} color={"#fff"} />
            <h3 className="">{t("view more")}</h3>
          </div>
        </div>
      )}
    </div>
  );
};

export default CustomerDashboard;
