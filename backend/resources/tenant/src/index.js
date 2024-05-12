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
import "primereact/resources/themes/lara-light-blue/theme.css";
import { SkeletonTheme } from "react-loading-skeleton";

const root = ReactDOM.createRoot(document.getElementById("root"));
root.render(
  <BrowserRouter>
    <ScrollToTop />
    <Provider store={store}>
      <SkeletonTheme baseColor="#BBB" highlightColoBr="#C0C0C0">
        <AuthContextProvider>
          <App />
        </AuthContextProvider>{" "}
      </SkeletonTheme>
    </Provider>{" "}
  </BrowserRouter>
);
