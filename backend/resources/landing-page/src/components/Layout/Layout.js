// import useCheckAuthenticated from '../../hooks/useCheckAuthenticated'
import { useAuthContext } from '../context/AuthContext'
import { Navigate, useLocation, Outlet } from 'react-router-dom'

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

   if (statusCode === 200 && !loading) {
      return <Navigate to={from} state={{ from: location }} />
   }

   if (statusCode === 204 && !loading) {
      return <Navigate to='/verification-email' state={{ from: location }} />
   }

   if (statusCode === 206 && !loading) {
      return <Navigate to='/complete-register' />
   }

   return <Outlet />
}

export default Layout
