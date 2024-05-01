import React, { useCallback, useEffect, useState } from "react";
import orderIcon from "../../../assets/orderBlack.svg";
import PrimaryOrderSearch from "./PrimaryOrderSearch";
import PrimaryOrderSelect from "./PrimaryOrderSelect";
import {
  updateOrderList,
  updateOrdersMeta,
  updatePageLinks,
} from "../../../redux/NewEditor/customerSlice";
import { useDispatch, useSelector } from "react-redux";
import { useTranslation } from "react-i18next";
import AxiosInstance from "../../../axios/axios";
import Pagination from "./Pagination";
import OrderItem from "./OrderItem";
import { useSearchParams } from "react-router-dom";

const CustomerOrder = () => {
  const { t } = useTranslation();
  const dispatch = useDispatch();
  const [pageNumber, setPageNumber] = useState(1);
  const [_, setSearchParams] = useSearchParams();
  const [dateAdded, setDateAdded] = useState("");
  const [search, setSearch] = useState("");
  const [orderStatus, setOrderStatus] = useState("");
  const [totalCount, setTotalCount] = useState(1);
  const ordersList = useSelector((state) => state.customerAPI.ordersList);

  const fetchOrderPerpage = async () => {
    try {
      const ordersResponse = await AxiosInstance.get(
        `orders?items&item&per_page=${""}&page=${""}&search=${search}&status=${
          orderStatus.value || ""
        }`
      );

      console.log("orders per page >>>", ordersResponse?.data?.data);
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

  useEffect(() => {
    fetchOrderPerpage().then(() => {});
  }, [pageNumber, search, orderStatus]);

  return (
    <div className="m-12 mb-5">
      <div className="flex flex-wrap flex-row justify-between mb-5 gap-4">
        <div className="flex items-center gap-3">
          <img src={orderIcon} alt="orders" className="w-8" />
          <h3 className="text-3xl font-medium">{t("Orders")}</h3>
        </div>
        <div className="flex flex-col md:flex-row w-full max-w-[800px] items-center gap-4">
          <div className="w-full md:w-2/3">
            <PrimaryOrderSearch
              value={search}
              onChange={(e) => setSearch(e.target.value)}
            />
          </div>
          <div className="w-full gap-4 flex items-center">
            <div className="w-1/2">
              <PrimaryOrderSelect
                defaultValue={t("Status")}
                value={orderStatus.text}
                handleChange={(item) => setOrderStatus(item)}
                options={[
                  { value: "", text: t("All") },
                  {
                    value: "receivedByRestaurant",
                    text: t("Received by Restaurant"),
                  },
                  { value: "pending", text: t("Pending") },
                  { value: "accepted", text: t("Accepted") },
                  { value: "rejected", text: t("Rejected") },
                  { value: "completed", text: t("Completed") },
                  { value: "ready", text: t("Ready") },
                  { value: "cancelled", text: t("Cancelled") },
                ]}
              />
            </div>
            <div className="w-1/2">
              <PrimaryOrderSelect
                defaultValue={t("Date Added")}
                value={dateAdded.text}
                handleChange={(item) => setDateAdded(item)}
                options={[
                  {
                    value: "today",
                    text: t("Today"),
                  },
                  { value: "last_day", text: t("Yesterday") },
                  { value: "last_week", text: t("Last Week") },
                  { value: "last_month", text: t("Last Month") },
                  { value: "last_year", text: t("Last Year") },
                ]}
              />
            </div>
          </div>
        </div>
      </div>

      <div className="flex flex-wrap gap-4 mb-5 mx-3 min-h-96">
        {ordersList?.map((order, index) => (
          <OrderItem
            key={index}
            order={order}
            onClick={() => setSearchParams({ orderId: order.id })}
          />
        ))}
        {!ordersList?.length && (
          <div className="place-self-center text-center w-full">
            {t("No orders available currently.")}
          </div>
        )}
      </div>
      {/* {ordersList?.length && (
        <Pagination
          page={pageNumber}
          setPage={setPageNumber}
          totalCount={totalCount}
        />
      )} */}
    </div>
  );
};

export default CustomerOrder;
