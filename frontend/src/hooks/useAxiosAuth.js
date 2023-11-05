import axios from 'axios'
import { useLocation, useNavigate } from 'react-router-dom'

const BASE_URL = process.env.REACT_APP_API_URL || 'http://khardl:8000'

const useAxiosAuth = () => {
   const location = useLocation()
   const navigate = useNavigate()

   const privateRoute = ![
      '/',
      '/register',
      '/clients',
      '/services',
      '/reset-password',
      '/create-new-password',
      '/advantages',
      '/prices',
      '/fqa',
      '/policies',
      '/privacy',
   ].includes(location.pathname)

   const axiosAuth = axios.create({
      baseURL: BASE_URL,
      headers: {
         'Content-Type': 'application/json',
         'X-CSRF-TOKEN': window.csrfToken,
      },
      withCredentials: true,
   })

   axiosAuth.interceptors.request.use(
      (request) => {
         console.log('request sent')
         return request
      },
      (error) => Promise.reject(error)
   )

   axiosAuth.interceptors.response.use(
      (response) => {
         console.log(response)
         return response
      },
      (error) => {
         if (error?.response?.status === 401) {
            console.log('navigate to login route')
            // if (location.pathname === '/register') navigate('/register')
            if (!privateRoute) navigate(location.pathname)
            else navigate('/login')
            // return <Navigate to='/login' state={{ from: location }} replace />
         }
         return Promise.reject(error)
      }
   )

   return { axiosAuth }
}

export default useAxiosAuth
