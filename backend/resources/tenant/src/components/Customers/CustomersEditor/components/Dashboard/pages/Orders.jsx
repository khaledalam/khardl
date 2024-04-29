import React from "react";
import { useTranslation } from "react-i18next";
import FullOrders from "../components/Orders";
import { useSelector } from "react-redux";

const Orders = () => {
  const { t } = useTranslation();
  const Language = useSelector((state) => state.languageMode.languageMode);
  const orderShow = useSelector((state) => state.order.orderShow);
  const idOrder = useSelector((state) => state.id.idOrder);
  const activeTab = useSelector((state) => state.tab.activeTab);
  const GlobalColor = useSelector((state) => state.button.GlobalColor);
  const divWidth = useSelector((state) => state.divWidth.value);

  return (
    <div
      className={`bg-[var(--secondary)] py-6 px-4 ${divWidth >= 500 ? "px-0" : ""}`}
      style={{ maxWidth: `${divWidth}px` }}
    >
      {activeTab === "Orders" && orderShow === true ? (
        <p className="mb-6 font-bold" style={{ color: GlobalColor }}>
          {t("Order Details")}
        </p>
      ) : (
        <p className="mb-6 font-bold">{t("Orders")}</p>
      )}
      <div className={`p-8 bg-white ${divWidth <= 500 ? "!px-4" : ""}`}>
        <div className="w-full bg-white text-center" id="id">
          <FullOrders />
        </div>
      </div>
    </div>
  );
};

export default Orders;
