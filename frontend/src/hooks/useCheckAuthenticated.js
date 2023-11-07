import { useEffect, useState } from 'react'
import { useDispatch } from 'react-redux'
import { changeLogState } from '../redux/auth/authSlice'
import useAxiosAuth from './useAxiosAuth'

export default function useCheckAuthenticated() {
   const dispatch = useDispatch()
   const [statusCode, setStatusCode] = useState(null)
   const [loading, setLoading] = useState(true)
   // const [isLoggedIn, setIsLoggedIn] = useState(false)

   // const isLoggedIn = useSelector((state) => state.auth.isLoggedIn)
   const { axiosAuth } = useAxiosAuth()

   useEffect(() => {
      const checkAuthenticated = async () => {
         try {
            const response = await axiosAuth.post('/auth-validation')
            console.log(response)
            setStatusCode(response?.status)
            dispatch(changeLogState(response?.data?.is_loggedin))
            console.log('hi from useCHeckAuth')
         } finally {
            setLoading(false)
         }
      }

      checkAuthenticated()
   }, [])

   return { statusCode, loading }
}
