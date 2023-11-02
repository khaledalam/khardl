import useCheckAuthenticated from '../../hooks/useCheckAuthenticated'
import { Navigate, useLocation, Outlet } from 'react-router-dom'

const Layout = () => {
   const { statusCode, loading } = useCheckAuthenticated()

   let location = useLocation()
   let state = location.state
   let from = state ? state.from.pathname : '/'

   console.log(`status-code: ${statusCode}, loading: ${loading}`)

   if (statusCode === 200 && !loading) {
      return <Navigate to={from} state={{ from: location }} />
   }

   return <Outlet />
}

export default Layout
