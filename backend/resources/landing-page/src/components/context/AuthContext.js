import React, {
  useState,
  createContext,
  useEffect,
  useContext,
  useCallback,
} from "react";
import { useDispatch } from "react-redux";
import { changeLogState } from "../../redux/auth/authSlice";
import { changeLanguage } from "../../redux/languageSlice";
import useAxiosAuth from "../../hooks/useAxiosAuth";
import useLocalStorage from "../../hooks/useLocalStorage";
import { API_ENDPOINT, HTTP_NOT_AUTHENTICATED } from "../../config";
import {  useLocation } from "react-router-dom";
const AuthContext = createContext();

export const AuthContextProvider = (props) => {
  const dispatch = useDispatch();
  const { axiosAuth } = useAxiosAuth();
  const [statusCode, setStatusCode] = useLocalStorage(
    "status-code",
    HTTP_NOT_AUTHENTICATED,
  );
  const [loading, setLoading] = useState(true);
  const location = useLocation();
  console.log(location.pathname );
  const checkAuthenticated = useCallback(async () => {
    try {
      const response = await axiosAuth.post(API_ENDPOINT + "/auth-validation");
      
      localStorage.setItem(
        "i18nextLng",
        response?.data?.default_locale ?? "ar",
      );
      // dispatch(changeLanguage(response?.data?.default_locale))

      setStatusCode(response?.status);
      dispatch(changeLogState(response?.data?.is_loggedin || false));

      if (!response?.data?.is_loggedin && location.pathname != '/verification-email') {

        sessionStorage.removeItem("email");
      }
    } catch (err) {
      if(location.pathname != '/verification-email')
      sessionStorage.removeItem("email");

      setStatusCode(err?.response?.status);
      dispatch(changeLogState(err.response?.data?.is_loggedin || false));
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
