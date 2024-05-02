import React from "react";
import { MdArrowForward } from "react-icons/md";
import Badge from "./Badge";
import { useTranslation } from "react-i18next";

const OrderItem = ({ order, onClick }) => {
  const { t } = useTranslation();
  return (
    <div
      className="flex-1 h-fit w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 min-w-fit p-4 bg-white rounded-[15px] border border-gray-200 flex-col justify-start items-end hover:border-slate-300 hover:shadow-md transition-all cursor-pointer font-medium font-['Plus Jakarta Sans']"
      onClick={onClick}
    >
      <Badge value={order?.status} />
      <div className="self-stretch justify-start items-center gap-4 inline-flex mb-5">
        <div className="w-[70px] h-[70px] flex bg-black bg-opacity-5 rounded-full justify-center items-center">
          <img
            className="w-[60px] h-[60px] p-[5px] rounded-full"
            src={order?.items ? order?.items[0]?.item?.photo : ""}
            alt={order?.items ? order?.items[0]?.item?.name : ""}
          />
        </div>
        <div className="pb-2.5 flex-col justify-start items-start gap-[3px] inline-flex">
          <div className="text-neutral-700 text-base">
            {order?.items ? order?.items[0]?.item?.name : ""}
          </div>
          {order?.items.length > 1 && (
            <div className="w-fit text-zinc-500 text-sm font-light">
              {t("and")} &nbsp;
              {order?.items ? order?.items.length - 1 : 0}&nbsp;
              {t("Others")}
            </div>
          )}
        </div>
      </div>
      <div className="w-full self-stretch pl-3.5 pr-0.5 justify-between items-start inline-flex">
        <div className="flex-col justify-start items-start gap-4 inline-flex">
          <div className="w-fit leading-tight">
            <span className="text-zinc-600 text-sm ">
              {new Date(order?.created_at).toLocaleString("en-US", {
                day: "2-digit",
                month: "2-digit",
                year: "numeric",
              })}
            </span>
            <span className="text-zinc-500 text-[12px] font-light">
              &nbsp;~{" "}
              {order?.created_at &&
                new Date(order?.created_at).toLocaleString("en-US", {
                  hour: "numeric",
                  minute: "numeric",
                  hour12: true,
                })}
            </span>
          </div>
          <div className="px-2 py-[2px] bg-neutral-50 text-neutral-700 text-sm font-light font-['Poppins'] rounded-[50px]">
            ID: {order?.id}
          </div>
        </div>
        <div className="flex-col justify-end items-end gap-[9px] inline-flex">
          <div className="text-neutral-700 text-sm leading-tight">
            SAR {order?.total}
          </div>
          <MdArrowForward className="w-8 h-8 bg-neutral-50 rounded-[35px] justify-center items-center gap-2.5 inline-flex hover:bg-neutral-500 hover:text-neutral-50 hover:shadow-sm p-2" />
        </div>
      </div>
    </div>
  );
};

export default OrderItem;
