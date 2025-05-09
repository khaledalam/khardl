import { useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { useSelector, useDispatch } from "react-redux";
import { logout } from "../../redux/auth/authSlice";
import { setIsOpen } from "../../redux/features/drawerSlice";
import { useAuthContext } from "../context/AuthContext";
import { toast } from "react-toastify";
import { HTTP_NOT_AUTHENTICATED } from "../../config";

const Logout = () => {
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const isLoggedIn = useSelector((state) => state.auth.isLoggedIn);
  const status = useSelector((state) => state.auth.status);
  const { setStatusCode } = useAuthContext();

  useEffect(() => {
    if (!isLoggedIn) {
      toast.error("You have to be Loggedin to Logout");
    } else {
      dispatch(logout({ method: "GET" }))
        .unwrap()
        .then(() => {
          if (status === "succeeded") {
            setStatusCode(HTTP_NOT_AUTHENTICATED);
            sessionStorage.removeItem("email");
            localStorage.removeItem("user-role");
            navigate("/login", { replace: true });
            toast.success("Logged out successfully");
          }
        })
        .catch((err) => {
          console.error(err.message);
          toast.error("Logout failed");
        });
    }
    dispatch(setIsOpen(false));
  }, []);

  if (status === "loading") {
    return null;
  }
};

export default Logout;
