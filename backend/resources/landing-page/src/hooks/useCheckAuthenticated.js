import { useEffect, useState } from "react";
import { useDispatch } from "react-redux";
import { changeLogState } from "../redux/auth/authSlice";
import { changeLanguage } from "../redux/languageSlice";
import useAxiosAuth from "./useAxiosAuth";

export default function useCheckAuthenticated() {
  const dispatch = useDispatch();
  const [statusCode, setStatusCode] = useState(null);
  const [loading, setLoading] = useState(true);
  // const [isLoggedIn, setIsLoggedIn] = useState(false)

  // const isLoggedIn = useSelector((state) => state.auth.isLoggedIn)
  const { axiosAuth } = useAxiosAuth();

  useEffect(() => {
    const checkAuthenticated = async () => {
      try {
        const response = await axiosAuth.get("/auth-validation");
        localStorage.setItem(
          "i18nextLng",
          response?.data?.default_locale ?? "ar",
        );
        // dispatch(changeLanguage(response?.data?.default_locale))
        const isLoggedin = response?.data?.is_loggedin;
        setStatusCode(response?.status);
        localStorage.setItem("isLoggedIn", false);
        dispatch(changeLogState(response?.data?.is_loggedin));
        console.log("hi from useCHeckAuth");
      } finally {
        setLoading(false);
      }
    };

    checkAuthenticated();
  }, []);

  return { statusCode, loading };
}
