import axios from "axios";
import { API_ENDPOINT } from "../config";

const BASE_URL = API_ENDPOINT || "https://khardl.com";

const AxiosInstance = axios.create({
    baseURL: BASE_URL,
    headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": window.csrfToken,
    },
    withCredentials: true,
});

export default AxiosInstance;
