import axios from 'axios'
import { Navigate, useLocation } from 'react-router-dom'

const BASE_URL = process.env.REACT_APP_API_URL || 'http://khardl:8000'

export default axios.create({
   baseURL: BASE_URL,
})

export const axiosAuth = axios.create({
   baseURL: BASE_URL,
   headers: { 'Content-Type': 'application/json' },
   withCredentials: true,
})

axiosAuth.interceptors.request.use(
   (request) => {
      // if (!request.headers['Authorization']) {
      //    request.headers['Authorization'] = `${accessToken}`
      // }
      console.log('request sent')
      return request
   },
   (error) => Promise.reject(error)
)

axiosAuth.interceptors.response.use(
   (response) => response,
   async (error) => {
      const prevRequest = error?.config
      const locate = useLocation()
      if (error?.response?.status === 401 && !prevRequest?.sent) {
         prevRequest.sent = true
         return <Navigate to='/login' state={{ from: locate }} replace />
      }
      return Promise.reject(error)
   }
)
