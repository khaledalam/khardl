import { useAuthContext } from "../context/AuthContext";
import { useLocation, Outlet } from "react-router-dom";
import { useSelector } from "react-redux";
import Login from "../../pages/LoginSignUp/Login";
import VerificationEmail from "../../pages/LoginSignUp/VerificationEmail";
import CompleteRegistration from "../../pages/LoginSignUp/CompleteRegistration";
import {
  HTTP_BLOCKED,
  HTTP_NOT_ACCEPTED,
  HTTP_NOT_AUTHENTICATED,
  HTTP_NOT_VERIFIED,
  HTTP_OK,
} from "../../config";

const PrivateRoute = () => {
  let location = useLocation();
  const { statusCode, loading } = useAuthContext();

  if (loading) {
    return;
  }

  if (statusCode === HTTP_NOT_AUTHENTICATED || statusCode === HTTP_BLOCKED) {
    // return <Navigate to='/login' state={{ from: location }} />
    return <Login state={{ from: location }} />;
  }

  if (statusCode === HTTP_NOT_VERIFIED) {
    // return <Navigate to='/verification-email' state={{ from: location }} />
    return <VerificationEmail state={{ from: location }} />;
  }

  if (statusCode === HTTP_NOT_ACCEPTED) {
    // return <Navigate to='/complete-register' state={{ from: location }} />
    return <CompleteRegistration state={{ from: location }} />;
  }

  // if (statusCode === 205) {
  //    return <Navigate to='/' state={{ from: location }} />
  // }

  if (statusCode === HTTP_OK) {
    return <Outlet />;
  }

  return null;
};

export default PrivateRoute;
