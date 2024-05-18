import React, { useEffect } from "react";
import { useTranslation } from "react-i18next";
import StatsCard from "../components/statsCard";
import LastOrders from "../components/Orders";
import { setActiveTab } from "../../../../../../redux/editor/dashboardTabSlice";
import { useDispatch, useSelector } from "react-redux";

const Dashboard = () => {
  const { t } = useTranslation();
  const dispatch = useDispatch();
  const GlobalColor = useSelector((state) => state.button.GlobalColor);
  const GlobalShape = useSelector((state) => state.button.GlobalShape);

  const handleTabClick = (tabName) => {
    dispatch(setActiveTab(tabName));
  };

 /*  useEffect(() => {
    console.log("Dashboard tab");
  }, []); */

  return (
    <div className="w-full bg-[var(--secondary)] py-6 px-4">
      <p className="mb-6 font-bold">{t("Dashboard")}</p>
      <div className="p-8 bg-white">
        {/* @TODO: uncomment tht cashback and Loyalty points*/}

        {/*<div className="grid grid-cols-3 gap-4 mb-4">*/}
        {/*    <StatsCard title={t("Wallet")} Stats="700" />*/}
        {/*    <StatsCard*/}
        {/*        title={t("Loyalty Point")}*/}
        {/*        Stats="500"*/}
        {/*        ShowIcons={true}*/}
        {/*    />*/}
        {/*    <StatsCard*/}
        {/*        title={t("Total Cash Back")}*/}
        {/*        Stats="1500"*/}
        {/*        ShowIcons={true}*/}
        {/*        IsUp={true}*/}
        {/*    />*/}
        {/*</div>*/}
        <LastOrders />
        <div className="flex justify-center items-center">
          <button
            className="py-1 px-8 my-2 mt-4"
            onClick={() => handleTabClick("Orders")}
            style={{
              border: `1px solid var(--primary)`,
              borderRadius: "30px",
              color: "black",
              backgroundColor: "var(--primary)",
            }}
          >
            {t("More")}
          </button>
        </div>
      </div>
    </div>
  );
};

export default Dashboard;
