import React, { useEffect } from "react";
import { useNavigate } from "react-router-dom";
import CreateNewPassword from "./pages/LoginSignUp/CreateNewPassword";
import ForgotPassword from "./pages/LoginSignUp/ForgotPassword";

const Protected = (props) => {
  let Cmp = props.Cmp;
  const navigate = useNavigate();
  useEffect(() => {
    if (sessionStorage.getItem("email")) {
      if (props.Cmp === ForgotPassword) {
        navigate("/create-new-password");
      }
      // else {
      //     navigate("/login");
      // }
    }
    if (!localStorage.getItem("user-info") && props.Cmp != CreateNewPassword) {
      navigate("/login");
    }
  }, []);
  return (
    <div>
      <Cmp />
    </div>
  );
};

export default Protected;
