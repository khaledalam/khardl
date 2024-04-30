import React, { Fragment, useEffect } from "react";
import { BiChevronLeft } from "react-icons/bi";
import { useNavigate } from "react-router-dom";
import OrderDetailsTable from "./OrderDetailsTable";
import { useSelector } from "react-redux";
import AxiosInstance from "../../../axios/axios";
import { useTranslation } from "react-i18next";

const CustomerOrderDetail = ({ orderId }) => {
  const { t } = useTranslation();
  const navigate = useNavigate();
  const ordersList = useSelector((state) => state?.customerAPI?.ordersList);
  const language = useSelector((state) => state.languageMode.languageMode);

  const singleOrder =
    orderId && ordersList?.length > 0
      ? ordersList.find((order) => order.id == orderId)
      : null;

  console.log("singleOrder", singleOrder);
  console.log("orderlist", ordersList);

  return (
    <div className="p-5">
      <div
        onClick={() => navigate(-1)}
        className="flex items-center gap-2 mb-5 cursor-pointer"
      >
        <BiChevronLeft size={30} />
        <h3 className="">{t("Display Order")}</h3>
      </div>
      {singleOrder && (
        <Fragment>
          <div className="w-full bg-[var(--customer)] pt-[150px]  rounded-t-[80px]">
            <div className="w-full rounded-t-[80px] flex bg-white p-10 flex-col items-center justify-center">
              <div className="w-[216px] h-[182px] mt-[-6rem] mx-auto bg-neutral-100 rounded-full p-1">
                <img
                  src={singleOrder?.items[0]?.item?.photo}
                  alt="product"
                  className="w-full h-full object-cover rounded-full"
                />
              </div>
              <div className="flex items-center gap-5 mt-5">
                <h3 className="">#{singleOrder.id}</h3>

                <div
                  className={`${
                    singleOrder.status.startsWith("accepted") ||
                    singleOrder.status.startsWith("ready") ||
                    singleOrder.status.includes("receive")
                      ? "bg-[var(--accepted)]"
                      : "bg-[var(--rejected)]"
                  } rounded-3xl flex items-center justify-center p-2 px-4 w-max`}
                >
                  <h3 className="">{t(singleOrder.status)}</h3>
                </div>
              </div>
              <div className="self-start border-b border-black w-full my-5">
                <h3 className="text-[1rem] font-bold mb-4">
                  {t("Product")} : (
                  <span className="text-[var(--customer)]">
                    {singleOrder.items.length}
                  </span>
                  )
                </h3>
              </div>
              <div className="w-full border-b border-black mb-2 overflow-x-scroll hide-scroll">
                <OrderDetailsTable
                  data={singleOrder.items}
                  language={language}
                />
              </div>
              <div className="flex flex-col gap-2 w-full self-start py-5">
                <h3 className="font-bold text-2xl">
                  {singleOrder?.delivery_type}
                </h3>
                <p className="">{singleOrder?.shipping_address}</p>
              </div>
              <div className="w-full border border-[var(--customer)] rounded-xl">
                <div className="w-[80%] laptopXL:w-70% mx-auto py-5">
                  <h3 className="font-bold text-lg text-center">
                    {t("Payment Summary")}
                  </h3>
                  <div className="w-full flex flex-col gap-4 ">
                    <div className="flex items-center justify-between border-b border-neutral-200 last:border-none p-2">
                      <h3 className="text-[1rem]">{t("Total Payment")}</h3>
                      <h3 className="text-[1rem]">
                        {t("SAR")} {parseFloat(singleOrder?.total)}
                      </h3>
                    </div>
                    <div className="flex items-center justify-between border-b border-neutral-200 last:border-none p-2">
                      <h3 className="text-[1rem]">{t("Delivery fee")}</h3>
                      <h3 className="text-[1rem]">
                        {t("SAR")} {singleOrder?.delivery_cost}
                      </h3>
                    </div>
                    <div className="flex items-center justify-between border-b border-neutral-200 last:border-none p-2">
                      <h3 className="text-[1rem]">{t("Payment Method")}</h3>
                      <h3 className="text-[1rem]">
                        {t(singleOrder?.payment_method)}
                      </h3>
                    </div>
                    <div className="flex items-center justify-between border-b border-neutral-200 last:border-none p-2">
                      <h3 className="text-[1rem]">{t("Order Notes")}</h3>
                      <h3 className="text-[1rem]">
                        {singleOrder?.order_notes}
                      </h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </Fragment>
      )}
    </div>
  );
};

export default CustomerOrderDetail;
