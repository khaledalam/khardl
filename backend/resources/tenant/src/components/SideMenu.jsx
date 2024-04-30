import React, { useContext, useState } from "react";
import { MenuContext } from "react-flexible-sliding-menu";
import Languages from "./Languages";
import Button from "./Button";
import { setIsOpen } from "../redux/features/drawerSlice";
import { useSelector, useDispatch } from "react-redux";
import { logout } from "../redux/auth/authSlice";
import { HTTP_NOT_AUTHENTICATED } from "../config";
import { toast } from "react-toastify";
import { useTranslation } from "react-i18next";
import { useNavigate } from "react-router-dom";
import { useAuthContext } from "./context/AuthContext";
import { MdOutlineDeliveryDining, MdOutlineDoneAll } from "react-icons/md";
import Model from "./Restaurants/RestaurantsPreview/components/Model";
import Login from "./Restaurants/RestaurantsPreview/components/Login";
import { getCartItemsCount } from "../redux/NewEditor/categoryAPISlice";

export const SideMenu = () => {
  const { closeMenu } = useContext(MenuContext);
  const { t } = useTranslation();
  const dispatch = useDispatch();
  const styleDataRestaurant = useSelector(
    (state) => state.styleDataRestaurant.styleDataRestaurant,
  );
  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn);
  const user = useSelector((state) => state.auth.user);

  console.log("user ---> ", user);
  const navigate = useNavigate();
  const { setStatusCode } = useAuthContext();
  const [showDetailesItem, setShowDetailesItem] = useState(false);
  const [isOpenModel1, setIsOpenModel1] = useState(false);
  const [isOpenModel2, setIsOpenModel2] = useState(false);
  const [isMenuOpen, setMenuOpen] = useState(false);

  if (!styleDataRestaurant) return;

  const buttons =
    styleDataRestaurant?.buttons ||
    JSON.parse(sessionStorage.getItem("buttons"));

  const redirectToDashboard = () => {
    // Redirect to an external URL (window.location.href)
    window.location.href = "/profile-summary#Dashboard";
  };

  const handleLogout = async (e) => {
    e.preventDefault();

    try {
      await dispatch(logout({ method: "POST" }))
        .unwrap()
        .then((res) => {
          setStatusCode(HTTP_NOT_AUTHENTICATED);
          dispatch(getCartItemsCount(0));
          navigate("/", { replace: true });
          toast.success(t("You have been logged out successfully"));
        });
    } catch (err) {
      console.error(err.message);
      toast.error(`${t("Logout failed")}`);
    }
    dispatch(setIsOpen(false));
  };

  function showMeDetailesItem() {
    if (!showDetailesItem) {
      setShowDetailesItem(true);
    } else {
      setShowDetailesItem(false);
    }
  }

  let branch_id = localStorage.getItem("selected_branch_id");

  if (!branch_id) {
    branch_id = styleDataRestaurant?.branches[0]?.id;
  }

  let selectedBranch = styleDataRestaurant?.branches.filter(
    (b) => b?.id == branch_id,
  );
  if (selectedBranch.length > 0) {
    selectedBranch = selectedBranch[0];
  }

  console.log(" >>> branch ", selectedBranch);
  console.log(" >>> branch id ", branch_id);
  const title_dashboard = (
    <span
      __html={
        <small>
          {" "}
          {t("Dashboard")} {user?.phone || ""}
        </small>
      }
    />
  );

  return (
    <div className="Menu flex flex-col h-[100vh] justify-center">
      <button onClick={closeMenu} className={"absolute top-[0] left-[0]"}>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="24"
          height="24"
          viewBox="0 0 24 24"
        >
          <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
          <path d="M0 0h24v24H0z" fill="none" />
        </svg>
      </button>

      <div className="relative flex flex-col items-center gap-2 justify-center">
        <Button
          title={"🏠"}
          link="/"
          onClick={() => navigate("/")}
          classContainer="!text-[16px] !px-[16px] !py-[6px] !font-medium "
          style={{
            border: `1px solid ${buttons[1]?.color || "black"}`,
            backgroundColor: "transparent",
            borderRadius: buttons[1]?.shape || "0px",
          }}
        />

        {/*Receipt icon*/}
        <div
          className={`lg:flex items-center justify-between gap-2 ${isMenuOpen ? "block" : "hidden"}`}
        >
          <div className="flex max-lg:flex-col max-lg:mt-14 gap-2">
            {isOpenModel1 !== null && (
              <span
                onClick={() => setIsOpenModel1(null)}
                className="w-full h-full fixed inset-0 z-[80] transition-all duration-500"
                style={{
                  display: isOpenModel1 ? "block" : "none",
                }}
              ></span>
            )}
            <span
              className="relative p-[6px] px-4 flex items-center justify-center gap-1 font-semibold"
              onClick={() => setIsOpenModel2(!isOpenModel2)}
              style={{
                border: `1px solid ${buttons[1]?.color || "black"}`,
                backgroundColor: "transparent",
                borderRadius: buttons[1]?.shape || "0px",
              }}
            >
              <MdOutlineDoneAll size={20} />
              {isOpenModel2 ? <Model buttonId={2} /> : <div></div>}
              <div>{t(buttons[1]?.text) || t("receipt")}</div>
            </span>
            {isOpenModel2 !== null && (
              <span
                onClick={() => setIsOpenModel2(null)}
                className="w-full h-full fixed inset-0 z-[80] transition-all duration-500"
                style={{
                  display: isOpenModel2 ? "block" : "none",
                }}
              ></span>
            )}
          </div>
        </div>

        {/*Delivery icon*/}
        <span
          className="relative p-[6px] px-4 flex items-center justify-center gap-1 font-semibold"
          style={{
            border: `1px solid ${buttons[2]?.color || "black"}`,
            backgroundColor: "transparent",
            borderRadius: buttons[2]?.shape || "0px",
          }}
          onClick={showMeDetailesItem}
        >
          <MdOutlineDeliveryDining size={20} />{" "}
          {t(buttons[2]?.text) || t("delivery")}{" "}
          <small>({selectedBranch?.name ? selectedBranch?.name : "⏳"})</small>
        </span>

        {showDetailesItem && (
          <Login onClose={showMeDetailesItem} onRequest={showMeDetailesItem} />
        )}

        {isLoggedIn ? (
          <>
            <Button
              onClick={redirectToDashboard}
              title={t("Dashboard")}
              classContainer="!text-[16px] !px-[16px] !py-[6px] !font-medium "
              style={{
                border: `1px solid ${buttons[1]?.color || "black"}`,
                backgroundColor: "transparent",
                borderRadius: buttons[1]?.shape || "0px",
              }}
            ></Button>

            <Button
              title={t("Logoutgg")}
              onClick={handleLogout}
              classContainer="!w-100 !px-[16px] !font-medium !bg-[var(--danger)]"
              style={{
                border: `1px solid ${buttons[1]?.color || "black"}`,
                backgroundColor: "transparent",
                borderRadius: buttons[1]?.shape || "0px",
              }}
            />
          </>
        ) : (
          <>
            <Button
              title={t("Create an account")}
              link="/register"
              onClick={() => dispatch(setIsOpen(false))}
              classContainer="!w-100 !px-[16px] !font-medium"
              style={{
                border: `1px solid ${buttons[1]?.color || "black"}`,
                backgroundColor: "transparent",
                borderRadius: buttons[1]?.shape || "0px",
              }}
            />
            <Button
              title={t("Login")}
              link="/login"
              onClick={() => dispatch(setIsOpen(false))}
              classContainer="!w-100 !px-[16px] !font-medium"
              style={{
                border: `1px solid ${buttons[1]?.color || "black"}`,
                backgroundColor: "transparent",
                borderRadius: buttons[1]?.shape || "0px",
              }}
            />
            <Button
              title={t("Management Area")}
              link="/login-admins"
              onClick={() => dispatch(setIsOpen(false))}
              classContainer="!w-100 !px-[16px] !font-medium"
              style={{
                border: `1px solid ${buttons[1]?.color || "black"}`,
                backgroundColor: "transparent",
                borderRadius: buttons[1]?.shape || "0px",
              }}
            />
          </>
        )}

        <hr className={"my-5"} />

        <Languages />
      </div>
    </div>
  );
};
