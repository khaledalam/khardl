import React, { Fragment, useEffect } from "react";
import { BiChevronLeft } from "react-icons/bi";
import { useNavigate } from "react-router-dom";
import OrderDetailsTable from "./OrderDetailsTable";
import { useSelector } from "react-redux";
import AxiosInstance from "../../../axios/axios";
import { useTranslation } from "react-i18next";
import { customerOrderData, customerOrderDetailData } from "../DATA";
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
  // const ordersList = useSelector((state) => state?.customerAPI?.ordersList);
  const ordersList = customerOrderData;
  const language = useSelector((state) => state.languageMode.languageMode);

  console.log("orderlist", ordersList);

  return (
    <div className="m-12 mb-5">
      <div
        onClick={() => navigate(-1)}
        className="flex items-center gap-2 mb-5 cursor-pointer"
      >
        <BiChevronLeft size={30} />
        <h3 className="text-3xl font-medium">
          {t("Display Order") + ": "}
          <span className="font-bold">{customerOrderDetailData.id}</span>
        </h3>
      </div>
      <div className="w-full h-full px-4 py-4 bg-white rounded-[25px] border border-black border-opacity-10 flex-col justify-start items-end gap-4 inline-flex">
        <div className="w-full pb-4 border-b border-zinc-100 justify-between items-center inline-flex">
          <div className="flex flex-row w-1/4 h-max gap-2 font-['Plus Jakarta Sans']">
            <MdCalendarMonth className="w-6 h-6 border-2 border-neutral-200 justify-center items-center gap-2.5 inline-flex rounded-full p-[2px]" />
            <div className="flex flex-row items-center">
              <span className="text-opacity-60 font-extralight">
                {t("Order date")}:
              </span>
              <span className="text-opacity-75 font-semibold ">
                &nbsp;February 20,2024
              </span>
            </div>
          </div>
          <div className="flex flex-row w-1/4 h-max gap-2 font-['Plus Jakarta Sans']">
            <MdAccessTime className="w-6 h-6 border-2 border-neutral-200 justify-center items-center gap-2.5 inline-flex rounded-full p-[2px]" />
            <div className="flex flex-row items-center">
              <span className="text-opacity-60 font-extralight">
                {t("Order time")}:
              </span>
              <span className="text-opacity-75 font-semibold ">
                &nbsp;February 20,2024
              </span>
            </div>
          </div>
          <div className="flex flex-row w-1/4 h-max gap-2 font-['Plus Jakarta Sans']">
            <MdOutlineTimelapse className="w-6 h-6 border-2 border-neutral-200 justify-center items-center gap-2.5 inline-flex rounded-full p-[2px]" />
            <div className="flex flex-row items-center">
              <span className="text-opacity-60 font-extralight">
                {t("Estimated delivery")}:
              </span>
              <span className="text-opacity-75 font-semibold ">
                &nbsp;February 20,2024
              </span>
            </div>
          </div>
          <div className="flex flex-row w-1/4 h-max gap-2 font-['Plus Jakarta Sans']">
            <MdDeliveryDining className="w-6 h-6 border-2 border-neutral-200 justify-center items-center gap-2.5 inline-flex rounded-full p-[2px]" />
            <div className="flex flex-row items-center">
              <span className="text-opacity-60 font-extralight">
                {t("Driver")}:
              </span>
              <span className="text-opacity-75 font-semibold ">
                &nbsp;February 20,2024
              </span>
            </div>
          </div>
          <Badge value={customerOrderDetailData.status} />
        </div>
        <div className="flex flex-row gap-4 w-full font-['Plus Jakarta Sans']">
          <div className="grow shrink basis-0 flex-col justify-start items-start gap-2 inline-flex">
            <div className="self-stretch justify-start items-start gap-2.5 inline-flex">
              <div className="text-black text-opacity-70 text-sm font-extralight">
                Products In Order:
              </div>
            </div>
            {customerOrderDetailData.items?.map((item) => (
              <div className="self-stretch h-fit p-2 rounded-lg border border-neutral-200 flex-col justify-start items-start gap-2 flex mb-2">
                <div
                  className={`self-stretch pb-2 ${
                    item.additional ? "border-b" : ""
                  } border-zinc-100 justify-between items-center inline-flex`}
                >
                  <div className="flex-row justify-start items-center gap-4 flex">
                    <img
                      className="w-16 h-16 p-1 rounded-full bg-zinc-100"
                      src={customerOrderDetailData.productImgUrl}
                    />
                    <div className="flex-col justify-start items-start inline-flex">
                      <div className="text-black text-opacity-75 font-semibold">
                        {item.productName}
                      </div>
                      <div className="text-black text-opacity-75 text-xs font-extralight">
                        Qty: {item.quantity}
                      </div>
                    </div>
                  </div>
                  <div className="text-black text-opacity-75 font-semibold">
                    SAR {item.price}
                  </div>
                </div>
                {item.additional && (
                  <div className="inline-flex flex-row gap-3">
                    <div className="h-fit pb-2 justify-start items-center flex">
                      <div className="text-black text-opacity-50 text-sm font-extralight">
                        Additional:&nbsp;
                      </div>
                    </div>
                    <div className="grow shrink basis-0 flex-col justify-start items-start gap-4 inline-flex">
                      {item.additional?.map((addtionalItem) => (
                        <div className="self-stretch justify-start items-center gap-[261px] inline-flex">
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
          <div className="font-['Plus Jakarta Sans'] grow shrink basis-0 self-stretch p-4 bg-white rounded-lg border border-neutral-200 flex-col justify-start items-start gap-4 inline-flex">
            <div className="self-stretch h-fit pb-4 border-b border-zinc-100 flex-col justify-start items-start gap-4 flex">
              <div className="self-stretch justify-start items-start gap-2.5 inline-flex">
                <div className="text-opacity-50 font-extralight">
                  {t("Payment Summary")}:
                </div>
              </div>
              <div className="self-stretch justify-between items-start inline-flex">
                <div className="text-opacity-50 font-medium">{t("Items")}</div>
                <div className="text-opacity-75 font-semibold">SAR 185</div>
              </div>
              <div className="self-stretch justify-between items-start inline-flex">
                <div className="text-opacity-50 font-medium">
                  {t("Delivery fee")}
                </div>
                <div className="text-opacity-75 font-semibold">SAR 10</div>
              </div>
              <div className="self-stretch justify-between items-start inline-flex">
                <div className="text-opacity-50 font-medium">
                  {t("Total payment")}
                </div>
                <div className="text-opacity-75 font-semibold">SAR 195</div>
              </div>
              <div className="self-stretch justify-between items-start inline-flex">
                <div className="text-opacity-50 font-medium">
                  Payment method
                </div>
                <div className="text-opacity-75 font-semibold">CARD **1234</div>
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
                  {t("Street 123, no.100 A, Villa Breeze, Khobbar")}
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
                  {t("Leave it in the exit gate")}
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
