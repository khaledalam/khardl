import useCheckAuthenticated from '../../hooks/useCheckAuthenticated'
import { Navigate, useLocation, Outlet } from 'react-router-dom'
import VerificationEmail from '../../pages/LoginSignUp/VerificationEmail'
import CompleteRegistration from '../../pages/LoginSignUp/CompleteRegistration'
import Login from '../../pages/LoginSignUp/Login'
const PrivateRoute = () => {
   let location = useLocation()
   const { statusCode, loading } = useCheckAuthenticated()

   // const { pathname } = useLocation()

   if ((statusCode === 401 || statusCode == 207) && !loading) {
      return <Login />;
   }

   if (statusCode === 204 && !loading) {
      return <VerificationEmail />
      // return <Navigate to='/verification-email' state={{ from: location }} />
   }

   if (statusCode === 206 && !loading) {
      return <CompleteRegistration />
   }

   // if (statusCode === 205) {
   //    return <Navigate to='/' state={{ from: location }} />
   // }

   if (statusCode === 200 && !loading) {
      return <Outlet />
   }

   console.log(`status-code: ${statusCode}, loading: ${loading}`)

   return (
      <p style={{ textAlign: 'center', padding: '20px 10px' }}>
         Redirecting ...
      </p>
   )
}

export default PrivateRoute
