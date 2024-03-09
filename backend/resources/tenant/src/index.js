import React, { useContext } from "react";
import ReactDOM from "react-dom/client";
import { BrowserRouter } from "react-router-dom";
import { Provider } from "react-redux";
import "./index.css";
import "react-toastify/dist/ReactToastify.css";
import store from "./redux/store";
import ScrollToTop from "./ScrollToTop";
import App from "./App";
import { AuthContextProvider } from "./components/context/AuthContext";

const root = ReactDOM.createRoot(document.getElementById("root"));
root.render(
    <BrowserRouter>
        <ScrollToTop />
        <Provider store={store}>
            <AuthContextProvider>
                <App />
            </AuthContextProvider>{" "}
        </Provider>{" "}
    </BrowserRouter>,
);
