import React, { Fragment, useEffect } from "react";
import { BiChevronLeft } from "react-icons/bi";
import { useNavigate } from "react-router-dom";
import { useSelector } from "react-redux";
import AxiosInstance from "../../../axios/axios";
import { useTranslation } from "react-i18next";
import Badge from "./Badge";
import {
  MdCalendarMonth,
  MdAccessTime,
  MdOutlineTimelapse,
  MdDeliveryDining,
} from "react-icons/md";

const CustomerOrderDetail = ({ orderId }) => {
  const { t } = useTranslation();
  const navigate = useNavigate();
  const ordersList = useSelector((state) => state?.customerAPI?.ordersList);
  const language = useSelector((state) => state.languageMode.languageMode);
  const customerAddress = useSelector((state) => state.customerAPI.address);

  const singleOrder =
    orderId && ordersList?.length > 0
      ? ordersList?.find((order) => order?.id == orderId)
      : null;

  return (
    <div className="m-12 mb-5">
      <div
        onClick={() => navigate(-1)}
        className="flex items-center gap-2 mb-5 cursor-pointer"
      >
        <BiChevronLeft size={30} />
        <h3 className="text-3xl font-medium">
          {t("Display Order") + ": "}
          <span className="font-bold">{singleOrder?.id}</span>
        </h3>
      </div>
      <div className="w-full h-full px-4 py-4 bg-white rounded-[25px] border border-black border-opacity-10 flex-col justify-start items-end gap-4 inline-flex">
        <div className="gap-3 flex-wrap w-full justify-between pb-4 border-b border-zinc-100 items-center inline-flex">
          <div className="flex flex-row w-fit h-max gap-2 font-['Plus Jakarta Sans']">
            <MdCalendarMonth className="w-6 h-6 border-2 border-neutral-200 justify-center items-center gap-2.5 inline-flex rounded-full p-[2px]" />
            <div className="flex flex-row items-center">
              <span className="text-opacity-60 font-extralight">
                {t("Order date")}:
              </span>
              <span className="text-opacity-75 font-semibold ">
                &nbsp;
                {new Date(singleOrder?.created_at).toLocaleString("en-US", {
                  day: "2-digit",
                  month: "2-digit",
                  year: "numeric",
                })}
              </span>
            </div>
          </div>
          <div className="flex flex-row w-fit h-max gap-2 font-['Plus Jakarta Sans']">
            <MdAccessTime className="w-6 h-6 border-2 border-neutral-200 justify-center items-center gap-2.5 inline-flex rounded-full p-[2px]" />
            <div className="flex flex-row items-center">
              <span className="text-opacity-60 font-extralight">
                {t("Order time")}:
              </span>
              <span className="text-opacity-75 font-semibold ">
                &nbsp;
                {singleOrder?.created_at &&
                  new Date(singleOrder?.created_at).toLocaleString("en-US", {
                    hour: "numeric",
                    minute: "numeric",
                    hour12: true,
                  })}
              </span>
            </div>
          </div>
          <div className="flex flex-row w-fit h-max gap-2 font-['Plus Jakarta Sans']">
            <MdOutlineTimelapse className="w-6 h-6 border-2 border-neutral-200 justify-center items-center gap-2.5 inline-flex rounded-full p-[2px]" />
            <div className="flex flex-row items-center">
              <span className="text-opacity-60 font-extralight">
                {t("Estimated delivery")}:
              </span>
              <span className="text-opacity-75 font-semibold ">
                &nbsp;{singleOrder?.deliver_by}
              </span>
            </div>
          </div>
          <div className="flex flex-row w-fit h-max gap-2 font-['Plus Jakarta Sans']">
            <MdDeliveryDining className="w-6 h-6 border-2 border-neutral-200 justify-center items-center gap-2.5 inline-flex rounded-full p-[2px]" />
            <div className="flex flex-row items-center">
              <span className="text-opacity-60 font-extralight">
                {t("Driver")}:
              </span>
              <span className="text-opacity-75 font-semibold ">
                &nbsp;{singleOrder?.deliver_by}
              </span>
            </div>
          </div>
          <Badge value={singleOrder?.status} />
        </div>
        <div className="flex-wrap flex flex-row gap-4 w-full font-['Plus Jakarta Sans']">
          <div className="flex-1 w-1/2 min-w-fit flex-col flex-wrap justify-start items-start gap-2 inline-flex">
            <div className="self-stretch justify-start items-start gap-2.5 inline-flex">
              <div className="text-black text-opacity-70 text-sm font-extralight">
                {t("Products In Order")}:
              </div>
            </div>
            {singleOrder?.items?.map((item, index) => (
              <div
                key={index}
                className="self-stretch h-fit p-2 rounded-lg border border-neutral-200 flex-col justify-start items-start gap-2 flex mb-2"
              >
                <div
                  className={`self-stretch pb-2 ${
                    item.additional ? "border-b" : ""
                  } border-zinc-100 justify-between items-center inline-flex`}
                >
                  <div className="flex-row justify-start items-center gap-4 flex">
                    <img
                      className="w-16 h-16 p-1 rounded-full bg-zinc-100"
                      src={item.image}
                    />
                    <div className="flex-col justify-start items-start inline-flex">
                      <div className="text-black text-opacity-75 font-semibold">
                        {item?.name}
                      </div>
                      <div className="text-black text-opacity-75 text-xs font-extralight">
                        Qty: {item?.quantity}
                      </div>
                    </div>
                  </div>
                  <div className="text-black text-opacity-75 font-semibold">
                    {t("SAR")} {item?.price}
                  </div>
                </div>
                {item.additional && (
                  <div className="inline-flex flex-row gap-3">
                    <div className="h-fit pb-2 justify-start items-center flex">
                      <div className="text-black text-opacity-50 text-sm font-extralight">
                        {t("Additional")}:&nbsp;
                      </div>
                    </div>
                    <div className="grow shrink basis-0 flex-col justify-start items-start gap-4 inline-flex">
                      {item?.additional?.map((addtionalItem, key) => (
                        <div
                          key={key}
                          className="self-stretch justify-start items-center gap-[261px] inline-flex"
                        >
                          <div className="grow shrink basis-0 h-fit justify-start items-start gap-[5px] flex">
                            <div className="text-black text-opacity-75 text-sm font-semibold">
                              {addtionalItem}
                            </div>
                            {/* <div className="text-black text-opacity-75 text-sm font-extralight">
                            Qty: 1
                          </div> */}
                          </div>
                          {/*<div className="text-black text-opacity-75 text-sm font-semibold">
                          SAR 25
                        </div> */}
                        </div>
                      ))}
                    </div>
                  </div>
                )}
              </div>
            ))}
          </div>
          <div className="flex-1 w-1/2 min-w-fit font-['Plus Jakarta Sans'] flex-wrap p-4 bg-white rounded-lg border border-neutral-200 flex-col justify-start items-start gap-4 inline-flex">
            <div className="self-stretch h-fit pb-4 border-b border-zinc-100 flex-col justify-start items-start gap-4 flex">
              <div className="self-stretch justify-start items-start gap-2.5 inline-flex">
                <div className="text-opacity-50 font-extralight">
                  {t("Payment Summary")}:
                </div>
              </div>
              <div className="self-stretch justify-between items-start inline-flex">
                <div className="text-opacity-50 font-medium">{t("Items")}</div>
                <div className="text-opacity-75 font-semibold">
                  {t("SAR")} {singleOrder?.total}
                </div>
              </div>
              <div className="self-stretch justify-between items-start inline-flex">
                <div className="text-opacity-50 font-medium">
                  {t("Delivery fee")}
                </div>
                <div className="text-opacity-75 font-semibold">
                  {t("SAR")} {singleOrder?.delivery_cost}
                </div>
              </div>
              <div className="self-stretch justify-between items-start inline-flex">
                <div className="text-opacity-50 font-medium">
                  {t("Total payment")}
                </div>
                <div className="text-opacity-75 font-semibold">
                  {t("SAR")} {parseFloat(singleOrder?.total)}
                </div>
              </div>
              <div className="self-stretch justify-between items-start inline-flex">
                <div className="text-opacity-50 font-medium">
                  {t("Payment method")}
                </div>
                <div className="text-opacity-75 font-semibold">
                  {t(singleOrder?.payment_method)}
                </div>
              </div>
            </div>
            <div className="self-stretch h-fit pb-4 border-b border-zinc-100 flex-col justify-start items-start gap-4 flex">
              <div className="self-stretch justify-start items-start gap-2.5 inline-flex">
                <div className="text-opacity-50 font-extralight">
                  {t("Address")}:
                </div>
              </div>
              <div className="self-stretch justify-start items-start gap-2.5 inline-flex">
                <div className="text-gray-900 text-opacity-75 font-semibold">
                  {t(customerAddress.addressValue)}
                </div>
              </div>
            </div>
            <div className="self-stretch h-fit flex-col justify-start items-start gap-4 flex">
              <div className="self-stretch justify-start items-center inline-flex">
                <div className="text-opacity-50 font-extralight">
                  {t("Order Notes")}:
                </div>
              </div>
              <div className="self-stretch justify-start items-center inline-flex">
                <div className="text-opacity-75 font-semibold leading-[15px] tracking-tight">
                  {t(singleOrder?.order_notes)}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default CustomerOrderDetail;
