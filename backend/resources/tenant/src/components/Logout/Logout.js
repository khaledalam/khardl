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
            // navigate('/login', { replace: true })
            toast.error("You have to be Logged in to Logout");
        } else {
            dispatch(logout({ method: "POST" }))
                .unwrap()
                .then((res) => {
                    console.log("logout resss ", res);

                    setStatusCode(HTTP_NOT_AUTHENTICATED);
                    setStatusCode(HTTP_NOT_AUTHENTICATED);
                    navigate("/", { replace: true });
                    toast.success("You have been logged out successfully");
                })
                .catch((err) => {
                    console.error(err.message);
                    toast.error("Logout failed");
                });

            // .then(() => {
            //    navigate('/login', { replace: true })
            //    toast.success('Logged out successfully')
            // })
            // .catch((err) => {
            //    console.error(err.message)
            //    toast.error('Logout failed')
            // })
        }
        dispatch(setIsOpen(false));
    }, []);

    if (status === "loading") {
        return null;
    }
};

export default Logout;
