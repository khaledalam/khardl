import useCheckAuthenticated from '../../hooks/useCheckAuthenticated'
import { Navigate, useLocation, Outlet } from 'react-router-dom'

const PrivateRoute = () => {
   let location = useLocation()
   const { statusCode, loading } = useCheckAuthenticated()

   // const { pathname } = useLocation()

   // if (statusCode === 203) {
   //    return <Navigate to='/' state={{ from: location }} />
   // }

   if (statusCode === 204 && !loading) {
      return <Navigate to='/verification-email' state={{ from: location }} />
   }

   if (statusCode === 206 && !loading) {
      return <Navigate to='/complete-register' />
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
