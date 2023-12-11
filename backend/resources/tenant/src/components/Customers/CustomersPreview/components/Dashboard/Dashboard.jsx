import React, { useEffect } from "react";
import TapPage from "./components/TapPage";
import Dashboard from './pages/Dashboard';
import Orders from './pages/Orders';
import Profile from './pages/Profile';
import { BsFillGridFill, BsFillFileTextFill } from "react-icons/bs";
import { BiSolidUser } from "react-icons/bi";
import { useTranslation } from "react-i18next";
import { useDispatch, useSelector } from "react-redux";
import { setActiveTab } from "../../../../../redux/editor/dashboardTabSlice";
import { setOrderShow } from "../../../../../redux/editor/orderShowSlice";

const CustomerDashboard = () => {
  const activeTab = useSelector((state) => state.tab.activeTab);
  const GlobalColor = useSelector((state) => state.button.GlobalColor);
  const GlobalShape = useSelector((state) => state.button.GlobalShape);

  const dispatch = useDispatch();
  const { t } = useTranslation();

  const handleOrderClick = (stutes) => {
    dispatch(setOrderShow(stutes));
};

  const handleTabClick = (tabName) => {
    dispatch(setActiveTab(tabName));
  };

  return (
    <div className="flex justify-between items-start bg-white shadow-lg">
      <aside
        id="logo-sidebar"
        className="w-[250px] "
        aria-label="Sidebar"
      >
        <div className="h-full p-4 overflow-y-auto">
          <ul className="space-y-3 font-medium py-6">
            <li
              className={`cursor-pointer flex justify-between items-center p-1  text-[var(--Forth)] hover:bg-[var(--secondary)]
              ${activeTab === "Dashboard" ? "!bg-[var(--secondary)]" : ""}`}
              onClick={() => {handleTabClick("Dashboard"); handleOrderClick(false)}}
              style={activeTab === "Dashboard" ? {
                color: `${GlobalColor}`,
                borderRadius: GlobalShape
            }:{borderRadius: GlobalShape}}
            >
              <TapPage icon={<BsFillGridFill />} title={t("Dashboard")} />
            </li>
            <li
              className={`cursor-pointer flex justify-between items-center p-1  text-[var(--Forth)] hover:bg-[var(--secondary)]
              ${activeTab === "Orders" ? "!bg-[var(--secondary)]" : ""}`}
              onClick={() => {handleTabClick("Orders"); handleOrderClick(false)}}
              style={activeTab === "Orders" ? {
                color: `${GlobalColor}`,
                borderRadius: GlobalShape
              }:{borderRadius: GlobalShape}}
            >
              <TapPage icon={<BsFillFileTextFill />} title={t("Orders")} />
            </li>
            <li
              className={`cursor-pointer flex justify-between items-center p-1  text-[var(--Forth)] hover:bg-[var(--secondary)]
              ${activeTab === "Profile" ? "!bg-[var(--secondary)]" : ""}`}
              onClick={() => {handleTabClick("Profile"); handleOrderClick(false)}}
              style={activeTab === "Profile" ? {
                color: `${GlobalColor}`,
                borderRadius: GlobalShape
              }:{borderRadius: GlobalShape}}
            >
              <TapPage icon={<BiSolidUser />} title={t("Profile")} />
            </li>
          </ul>
        </div>
      </aside>
      <div className="flex-1">
        {activeTab === "Dashboard" && (
          <Dashboard />
        )}
        {activeTab === "Orders" && (
          <Orders />
        )}
        {activeTab === "Profile" && (
          <Profile />
        )}
      </div>
    </div>
  );
};

export default CustomerDashboard;
