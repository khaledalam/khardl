import React, { useContext } from "react";
import { useNavigate } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { logout } from "../../redux/auth/authSlice";
import { useAuthContext } from "../context/AuthContext";
import { toast } from "react-toastify";
import { HTTP_NOT_AUTHENTICATED } from "../../config";
import logoutIcon from "../../assets/logout.svg";
import { MenuContext } from "react-flexible-sliding-menu";
import { useTranslation } from "react-i18next";
import { getCartItemsCount } from "../../redux/NewEditor/categoryAPISlice";

const LogoutButton = () => {
  const { t } = useTranslation();
  const dispatch = useDispatch();

  const { setStatusCode } = useAuthContext();
  const navigate = useNavigate();
  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn);
  const { closeMenu } = useContext(MenuContext);

  const restuarantStyle = useSelector((state) => {
    return state.restuarantEditorStyle;
  });

  const handleLogout = async (e) => {
    e.preventDefault();

    try {
      await dispatch(logout({ method: "POST" }))
        .unwrap()
        .then((res) => {
          setStatusCode(HTTP_NOT_AUTHENTICATED);
          dispatch(getCartItemsCount(0));
          navigate("/", { replace: true });
          closeMenu();
          toast.success(t("You have been logged out successfully"));
        });
    } catch (err) {
      console.error(err.message);
      toast.error(`${t("Logout failed")}`);
    }
  };

  return isLoggedIn ? (
    <div className="w-full mb-20 cursor-pointer">
      <div
        onClick={handleLogout}
        className="w-[90%] mx-auto flex flex-row gap-1 rounded-lg items-center cursor-pointer text-black text-lg"
        style={{
          // borderColor: restuarantStyle?.categoryDetail_cart_color,
        }}
      >
        <div className="w-[50px] h-[50px] rounded-xl p-2  flex items-center justify-center">
          <img src={logoutIcon} alt="home" />
        </div>
        <h3 className="">{t("Logout")}</h3>
      </div>
    </div>
  ) : (
    <div></div>
  );
};

export default LogoutButton;
