import React, { useEffect } from "react";
import { useNavigate } from "react-router-dom";
import CreateNewPassword from "./pages/LoginSignUp/CreateNewPassword";
import { PREFIX_KEY } from "./config";
import ForgotPassword from "./pages/LoginSignUp/ForgotPassword";

const Protected = (props) => {
  let Cmp = props.Cmp;
  const navigate = useNavigate();
  useEffect(() => {
    if (!sessionStorage.getItem("email")) {
      if (props.Cmp === ForgotPassword) {
        navigate("/create-new-password");
      }
      // else {
      //     navigate("/login");
      // }
    }
    console.log("props =>>> ", props.Cmp);
    if (!localStorage.getItem("user-info") && props.Cmp != CreateNewPassword) {
      navigate("/");
    }
  }, []);
  return (
    <div>
      <Cmp />
    </div>
  );
};

export default Protected;
