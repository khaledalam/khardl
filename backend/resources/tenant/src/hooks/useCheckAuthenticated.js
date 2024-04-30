import { useEffect, useState } from "react";
import { useDispatch } from "react-redux";
import { changeLogState } from "../redux/auth/authSlice";
import useAxiosAuth from "./useAxiosAuth";
import { changeLanguage } from "../../src/redux/languageSlice";

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
        console.log(response);

        const isLoggedin = response?.data?.is_loggedin;
        if (isLoggedin) {
          localStorage.setItem(
            "i18nextLng",
            response?.data?.default_locale ?? "ar",
          );
          let newLanguage = response?.data?.default_locale;
          dispatch(changeLanguage(newLanguage));
        }
        setStatusCode(response?.status);
        dispatch(changeLogState(isLoggedin));
        if (!isLoggedin) {
          dispatch(changeUserState(null));
        }
        console.log("hi from useCHeckAuth");
      } finally {
        setLoading(false);
      }
    };

    checkAuthenticated();
  }, []);

  return { statusCode, loading };
}
