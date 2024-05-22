import axios from "axios";
import { useLocation, useNavigate } from "react-router-dom";
import { HTTP_NOT_AUTHENTICATED } from "../config";

const BASE_URL = process.env.REACT_APP_API_URL || "https://khardl.com";

const useAxiosAuth = () => {
  const location = useLocation();
  const navigate = useNavigate();

  const privateRoute = ![
    "/",
    "/restaurant-not-found",
    "/register",
    "/services",
    "/reset-password",
    "/create-new-password",
    "/advantages",
    "/prices",
    "/fqa",
    "/verification-email",
    "/policies",
    "/privacy",
  ].includes(location.pathname);

  const axiosAuth = axios.create({
    baseURL: BASE_URL,
    headers: {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": window.csrfToken || "NA",
      Accept: "application/json",
    },
    withCredentials: false,
  });

  axiosAuth.interceptors.request.use(
    (request) => {
      return request;
    },
    (error) => Promise.reject(error),
  );

  axiosAuth.interceptors.response.use(
    (response) => {
      return response;
    },
    (error) => {
      if (error?.response?.status === HTTP_NOT_AUTHENTICATED) {
        localStorage.setItem("user-info", "");
        // if (location.pathname === '/register') navigate('/register')
        if (!privateRoute) navigate(location.pathname);
        else navigate("/login");
        // return
        // return <Navigate to='/login' state={{ from: location }} replace />
      }

      return Promise.reject(error);
    },
  );

  return { axiosAuth };
};

export default useAxiosAuth;
