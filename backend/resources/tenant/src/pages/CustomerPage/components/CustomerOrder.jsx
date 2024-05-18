import React, { useCallback, useEffect, useState } from "react";
import orderIcon from "../../../assets/orderBlack.svg";
import PrimaryOrderSearch from "./PrimaryOrderSearch";
import PrimaryOrderSelect from "./PrimaryOrderSelect";
import OrderTable from "./OrderTable";
import { MdKeyboardArrowLeft, MdKeyboardArrowRight } from "react-icons/md";
import {
  updateOrderList,
  updateOrdersMeta,
  updatePageLinks,
} from "../../../redux/NewEditor/customerSlice";
import { useDispatch, useSelector } from "react-redux";
import { useTranslation } from "react-i18next";
import AxiosInstance from "../../../axios/axios";

const CustomerOrder = () => {
  const { t } = useTranslation();
  const dispatch = useDispatch();
  const [pageNumber, setpageNumber] = useState(1);
  const [orderPerPage, setOrderPerPage] = useState("");
  const [dateAdded, setDateAdded] = useState("");
  const [search, setsearch] = useState("");
  const [orderStatus, setOrderStatus] = useState("");
  const ordersList = useSelector((state) => state.customerAPI.ordersList);
  const pagelinks = useSelector((state) => state.customerAPI.pagelinks);
  const ordersMetadata = useSelector(
    (state) => state.customerAPI.ordersMetadata
  );
  const Language = useSelector((state) => state.languageMode.languageMode);

  // useEffect(() => {
  //   fetchOrderPerpage().then(() => {})
  // }, [])

  const fetchOrderPerpage = async () => {
    try {

      const ordersResponse = await AxiosInstance.get(
        `orders?items&item&per_page=${
          orderPerPage.value || ""
        }&page=${pageNumber}&search=${search}&status=${orderStatus.value || ""}`
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

  useEffect(() => {
    fetchOrderPerpage().then(() => {});
  }, [pageNumber, orderPerPage, search, orderStatus]);

  const prevPage = useCallback(() => {
    if (pageNumber > 1) {
      setpageNumber((prevPage) => pageNumber - 1);
    }
  }, [pageNumber]);

  const nextPage = useCallback(() => {
    setpageNumber((prevPage) => prevPage + 1);
  }, []);



  return (
    <div className="m-12 mb-5">
      <div className="flex items-center gap-3">
        <img src={orderIcon} alt="orders" className="w-8" />
        <h3 className="text-3xl font-medium">{t("Orders")}</h3>
      </div>
      <div
        className="my-5 flex flex-col md:flex-row w-full items-center gap-4"
        style={{ maxWidth: "700px" }}
      >
        <div className="w-full md:w-2/3">
          <PrimaryOrderSearch
            value={search}
            onChange={(e) => setsearch(e.target.value)}
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
      <div className="mb-5 overflow-x-scroll hide-scroll">
        <OrderTable data={ordersList} />
      </div>
      <div className="flex flex-col  xl:flex-row items-center gap-4 justify-between mb-5">
        <div className="flex items-center gap-3">
          <div className="w-[200px]">
            <PrimaryOrderSelect
              background
              defaultValue={t("show") + " 5"}
              handleChange={(item) => setOrderPerPage(item)}
              options={[
                {
                  value: 5,
                  text: t("show") + " 5",
                },
                {
                  value: 10,
                  text: t("show") + " 10",
                },
                {
                  value: 15,
                  text: t("show") + " 15",
                },
                {
                  value: 20,
                  text: t("show") + " 20",
                },
              ]}
              value={orderPerPage.text}
            />
          </div>
          <h3 className="">
            {t("page")} {pageNumber} {t("of")}{" "}
            {ordersMetadata ? ordersMetadata?.last_page : 1}
          </h3>
        </div>
        <div className="flex items-center gap-3">
          <button
            onClick={prevPage}
            disabled={pagelinks?.prev === null}
            className={`w-8 h-8 border ${
              pagelinks?.prev
                ? "bg-[var(--customer)] cursor-pointer"
                : "border-neutral-800 disabled:bg-neutral-300 cursor-not-allowed border-solid"
            }  rounded-full flex items-center justify-center !p-0 `}
          >
            {Language == "en" ? (
              <MdKeyboardArrowLeft
                size={20}
                color={pagelinks?.prev ? "#fff" : "#000"}
              />
            ) : (
              <MdKeyboardArrowRight
                size={20}
                color={pagelinks?.next ? "#fff" : "#000"}
              />
            )}
          </button>
          <button
            disabled={pagelinks?.next === null}
            onClick={nextPage}
            className={`w-8 h-8 border ${
              pagelinks?.next
                ? "bg-[var(--customer)] cursor-pointer"
                : "border-neutral-800 disabled:bg-neutral-300 cursor-not-allowed border-solid"
            }  rounded-full flex items-center justify-center !p-0 `}
          >
            {Language == "en" ? (
              <MdKeyboardArrowRight
                size={20}
                color={pagelinks?.next ? "#fff" : "#000"}
              />
            ) : (
              <MdKeyboardArrowLeft
                size={20}
                color={pagelinks?.prev ? "#fff" : "#000"}
              />
            )}
          </button>
        </div>
      </div>
    </div>
  );
};

export default CustomerOrder;
