import React, {
  useState,
  createContext,
  useEffect,
  useContext,
  useCallback,
} from "react";
import { useDispatch } from "react-redux";
import { changeLogState, changeUserState } from "../../redux/auth/authSlice";
import useAxiosAuth from "../../hooks/useAxiosAuth";
import useLocalStorageStatusCode from "../../hooks/useLocalStorageStatusCode";
import {
  API_ENDPOINT,
  PREFIX_KEY,
  HTTP_NOT_AUTHENTICATED,
  HTTP_NOT_VERIFIED,
} from "../../config";
import { changeLanguage } from "../../redux/languageSlice";

const AuthContext = createContext();

export const AuthContextProvider = (props) => {
  const dispatch = useDispatch();
  const { axiosAuth } = useAxiosAuth();
  const [statusCode, setStatusCode] = useLocalStorageStatusCode(
    "status-code",
    HTTP_NOT_AUTHENTICATED,
  );
  const [loading, setLoading] = useState(true);

  const checkAuthenticated = useCallback(async () => {
    try {
      const response = await axiosAuth.post(API_ENDPOINT + "/auth-validation");
      if (response?.data?.is_loggedin) {
        localStorage.setItem(
          "i18nextLng",
          response?.data?.default_locale ?? "ar",
        );
        let newLanguage = response?.data?.default_locale ?? "ar";
        dispatch(changeLanguage(newLanguage));
      }
      setStatusCode(response?.status);

      if (statusCode === HTTP_NOT_VERIFIED && response?.data?.phone) {
        sessionStorage.setItem(PREFIX_KEY + "phone", response?.data?.phone);
      }
      dispatch(changeLogState(response?.data?.is_loggedin || false));
      dispatch(changeUserState(response?.data?.user || null));
    } catch (err) {
      setStatusCode(err?.response?.status);
      // localStorage.setItem("i18nextLng",err.response.data.default_locale || "ar");
      dispatch(changeLogState(err.response?.data?.is_loggedin || false));
      dispatch(changeUserState(err.response?.data?.user || null));
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    checkAuthenticated();
  }, [checkAuthenticated]);

  return (
    <AuthContext.Provider
      value={{
        statusCode,
        loading,
        setStatusCode,
      }}
    >
      {props.children}
    </AuthContext.Provider>
  );
};

export const useAuthContext = () => {
  return useContext(AuthContext);
};
