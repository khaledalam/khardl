import axios from "axios";
import { API_ENDPOINT } from "../config";
import { useSelector } from "react-redux";

const BASE_URL = API_ENDPOINT || "https://khardl.com";
const Language = localStorage.getItem("i18nextLng") || "en";

const AxiosInstance = axios.create({
  baseURL: BASE_URL,
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json",
    "X-CSRF-TOKEN": window.csrfToken,
    localization: Language,
  },
  withCredentials: true,
});

export default AxiosInstance;
