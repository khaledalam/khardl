// import useCheckAuthenticated from '../../hooks/useCheckAuthenticated'
import { useAuthContext } from '../context/AuthContext'
import { useLocation, Outlet } from 'react-router-dom'
import Login from '../../pages/LoginSignUp/Login'
import VerificationPhone from '../../pages/LoginSignUp/VerificationPhone'
import CompleteRegistration from '../../pages/LoginSignUp/CompleteRegistration'
import {HTTP_BLOCKED, HTTP_NOT_ACCEPTED, HTTP_NOT_AUTHENTICATED, HTTP_NOT_VERIFIED, HTTP_OK} from "../../config";

const PrivateRoute = () => {
   let location = useLocation()
   // const { statusCode, loading } = useCheckAuthenticated()
   const { statusCode, loading } = useAuthContext()


    if (loading) {
        return;
    }

    console.log(`status-code: ${statusCode}, loading: ${loading}`)


    if ((statusCode === HTTP_NOT_AUTHENTICATED || statusCode === HTTP_BLOCKED)) {
      // return <Navigate to='/login' state={{ from: location }} />
      return <Login state={{ from: location }} />
   }

   if (statusCode === HTTP_NOT_VERIFIED) {
      return <VerificationPhone state={{ from: location }} />
   }

   if (statusCode === HTTP_NOT_ACCEPTED) {
      // return <Navigate to='/complete-register' state={{ from: location }} />
      return <CompleteRegistration state={{ from: location }} />
   }

   // if (statusCode === 205) {
   //    return <Navigate to='/' state={{ from: location }} />
   // }

   if (statusCode === HTTP_OK) {
      return <Outlet />
   }


   return (
      <p style={{ textAlign: 'center', padding: '20px 10px' }}>
         Redirecting ...
      </p>
   )
}

export default PrivateRoute
