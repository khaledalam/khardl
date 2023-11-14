import React, {
   useState,
   createContext,
   useEffect,
   useContext,
   useCallback,
} from 'react'
import { useDispatch } from 'react-redux'
import { changeLogState } from '../../redux/auth/authSlice'
import useAxiosAuth from '../../hooks/useAxiosAuth'
import useLocalStorage from '../../hooks/useLocalStorage'
import {API_ENDPOINT} from "../../config";

const AuthContext = createContext()

export const AuthContextProvider = (props) => {
   const dispatch = useDispatch()
   const { axiosAuth } = useAxiosAuth()
   const [statusCode, setStatusCode] = useLocalStorage('status-code', HTTP_NOT_AUTHENTICATED)
   const [loading, setLoading] = useState(true)

   const checkAuthenticated = useCallback(async () => {
      try {
         const response = await axiosAuth.post( API_ENDPOINT + '/auth-validation')
         console.log(response)
         setStatusCode(response?.status)
         dispatch(changeLogState(response?.data?.is_loggedin || false))
         console.log('hi from AuthContext')
      } catch (err) {
         console.log(err)
         setStatusCode(err?.response?.status)
         dispatch(changeLogState(err.response?.data?.is_loggedin || false))
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
