// import useCheckAuthenticated from '../../hooks/useCheckAuthenticated'
import { useAuthContext } from '../context/AuthContext'
import { Navigate, useLocation, Outlet } from 'react-router-dom'
import {HTTP_NOT_ACCEPTED, HTTP_NOT_VERIFIED, HTTP_OK} from "../../config";

const Layout = () => {
   const { statusCode, loading } = useAuthContext()
   // const { statusCode, loading } = useCheckAuthenticated()

   let location = useLocation()
   let state = location.state
   let from = state ? state.from.pathname : '/'

   console.log(`status-code: ${statusCode}, loading: ${loading}`)

   if (loading) {
      return (
         <p style={{ textAlign: 'center', padding: '20px 10px' }}>
            Redirecting ...
         </p>
      )
   }

   // if (statusCode === HTTP_NOT_VERIFIED && !loading) {
   //    return <Navigate to={from} state={{ from: location }} />
   // }

    if (loading) {
        return;
    }

   if (statusCode === HTTP_OK) {
      return <Navigate to={from} state={{ from: location }} />
   }

   if (statusCode === HTTP_NOT_VERIFIED) {
      return <Navigate to='/verification-email' state={{ from: location }} />
   }

   if (statusCode === HTTP_NOT_ACCEPTED) {
      return <Navigate to='/complete-register' />
   }

   return <Outlet />
}

export default Layout
