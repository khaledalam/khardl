import React, {
   useState,
   createContext,
   useEffect,
   useContext,
   useCallback,
} from 'react'
import { useDispatch } from 'react-redux'
import {changeLogState, changeUserState} from '../../redux/auth/authSlice'
import useAxiosAuth from '../../hooks/useAxiosAuth'
import useLocalStorageStatusCode from '../../hooks/useLocalStorageStatusCode'
import {API_ENDPOINT, PREFIX_KEY,HTTP_NOT_AUTHENTICATED, HTTP_NOT_VERIFIED} from "../../config";

const AuthContext = createContext()

export const AuthContextProvider = (props) => {
   const dispatch = useDispatch()
   const { axiosAuth } = useAxiosAuth()
   const [statusCode, setStatusCode] = useLocalStorageStatusCode('status-code', HTTP_NOT_AUTHENTICATED)
   const [loading, setLoading] = useState(true)

   const checkAuthenticated = useCallback(async () => {
      try {
         const response = await axiosAuth.post( API_ENDPOINT + '/auth-validation')
         console.log(response)
          console.log(statusCode)
         setStatusCode(response?.status)
          console.log(statusCode)

          if (statusCode === HTTP_NOT_VERIFIED && response?.data?.phone) {
              sessionStorage.setItem(PREFIX_KEY + 'phone', response?.data?.phone)
          }

          dispatch(changeLogState(response?.data?.is_loggedin || false))
          dispatch(changeUserState(response?.data?.user || null))

          console.log('hi from AuthContext')
      } catch (err) {
         console.log(err)
         setStatusCode(err?.response?.status)
         dispatch(changeLogState(err.response?.data?.is_loggedin || false))
          dispatch(changeUserState(err.response?.data?.user || null))

      } finally {
         setLoading(false)
      }
   }, [])

   useEffect(() => {
      checkAuthenticated()
   }, [checkAuthenticated])

   return (
      <AuthContext.Provider
         value={{
            statusCode,
            loading,
            setStatusCode,
         }}
      >
         {props.children}
      </AuthContext.Provider>
   )
}

export const useAuthContext = () => {
   return useContext(AuthContext)
}
