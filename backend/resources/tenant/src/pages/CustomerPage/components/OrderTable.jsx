import React, { Fragment } from "react";
import Eyes from "./Eyes";
import { useNavigate } from "react-router-dom";
import { useTranslation } from "react-i18next";
import { useSelector } from "react-redux";

const OrderTable = ({ data }) => {
  const navigate = useNavigate();
  const { t } = useTranslation();
  const language = useSelector((state) => state.languageMode.languageMode);

  return (
    <Fragment>
      {Array.isArray(data) && data?.length > 0 ? (
        <div className="w-full">
          <table
            className={`w-full table border-separate border-spacing-y-4 ${language == "ar" ? "text-right" : ""}`}
          >
            <thead className="w-full ">
              <tr className="text-white bg-[var(--customer)] h-[60px] rounded-lg">
                <th className="font-bold text-[1rem]">{t("Order ID")}</th>
                <th className="font-bold text-[1rem]">{t("Products")}</th>
                <th className="font-bold text-[1rem]">{t("Status")}</th>
                <th className="font-bold text-[1rem]">{t("Total")}</th>
                <th className="font-bold text-[1rem]">{t("Date Added")}</th>
                <th className="font-bold text-[1rem]">{t("Display Order")}</th>
              </tr>
            </thead>
            <tbody>
              {data &&
                data?.map((order) => (
                  <tr
                    key={order.id}
                    className="h-[80px] bg-white my-4 hover:shadow-lg hover:border hover:border-[var(--customer)]"
                  >
                    <td>
                      <h3 className="text-sm font-medium">#{order.id}</h3>
                    </td>
                    <td className="h-full">
                      <div className="flex items-center gap-2">
                        <div className="w-[55px] h-[55px] border border-[var(--customer)] rounded-full p-1">
                          <img
                            src={
                              order?.items ? order?.items[0]?.item?.photo : ""
                            }
                            alt={
                              order?.items ? order?.items[0]?.item?.name : ""
                            }
                            className="w-full h-full object-cover rounded-full"
                          />
                        </div>
                        <div className="flex flex-col gap-2">
                          <h3 className="">
                            {order?.items ? order?.items[0]?.item?.name : ""}
                          </h3>
                          {order?.items.length > 1 && (
                            <h4 className="">
                              {`${t("and")}`}
                              {order?.items ? order?.items.length - 1 : 0}{" "}
                              {t("Others")}
                            </h4>
                          )}
                        </div>
                      </div>
                    </td>
                    <td>
                      <div
                        className={`${
                          order.status.startsWith("accepted") ||
                          order.status.startsWith("ready") ||
                          order.status.includes("receive") ||
                          order.status.includes("complete")
                            ? "bg-[var(--accepted)]"
                            : "bg-[var(--rejected)]"
                        } rounded-xl flex items-center justify-center p-2 px-4 w-max`}
                      >
                        <h3 className="capitalize">{t(order?.status)}</h3>
                      </div>
                    </td>
                    <td>
                      <h3 className="font-normal">
                        <span className="text-xs mr-1">{t("SAR")}</span>
                        <span className="text-[1rem] text-[var(--customer)]">
                          {order.total}
                        </span>
                      </h3>
                    </td>
                    <td>
                      <div className="flex items-center gap-2">
                        <span className="text-[1rem]">
                          {new Date(order?.created_at).toLocaleString("en-US", {
                            day: "2-digit",
                            month: "2-digit",
                            year: "numeric",
                          })}
                        </span>
                        <span className="text-xs text-[var(--customer)]">
                          {order?.created_at &&
                            new Date(order.created_at).toLocaleString("en-US", {
                              hour: "numeric",
                              minute: "numeric",
                              hour12: true,
                            })}
                        </span>
                      </div>
                    </td>
                    <td>
                      <Eyes
                        cursorPointer={true}
                        onClick={() =>
                          navigate(`/profile-summary?orderId=${order.id}`)
                        }
                      />
                    </td>
                  </tr>
                ))}
            </tbody>
          </table>
        </div>
      ) : (
        <div className="w-full h-[70vh] flex items-center justify-center">
          <h3 className="my-4">{t("No Recent Orders...")}</h3>
          {/* <span className='loading loading-spinner text-[var(--customer)]'></span> */}
        </div>
      )}
    </Fragment>
  );
};

export default OrderTable;
