import React, { useState, createContext, useEffect, useContext } from 'react'
import { useDispatch } from 'react-redux'
import { changeLogState } from '../../redux/auth/authSlice'
import useAxiosAuth from '../../hooks/useAxiosAuth'
import useLocalStorage from '../../hooks/useLocalStorage'

const AuthContext = createContext()

export const AuthContextProvider = (props) => {
   const dispatch = useDispatch()
   const { axiosAuth } = useAxiosAuth()
   const [statusCode, setStatusCode] = useLocalStorage(
      'status-code',
      'hey you!'
   )
   const [loading, setLoading] = useState(true)

   useEffect(() => {
      const checkAuthenticated = async () => {
         try {
            const response = await axiosAuth.post('/auth-validation')
            console.log(response)
            setStatusCode(response?.status)
            dispatch(changeLogState(response?.data?.is_loggedin))
            console.log('hi from AuthContext')
         } catch (err) {
            console.log(err)
            setStatusCode(err?.response?.status)
         } finally {
            setLoading(false)
         }
      }

      checkAuthenticated()
   }, [])

   return (
      <AuthContext.Provider
         value={{
            statusCode,
            loading,
         }}
      >
         {props.children}
      </AuthContext.Provider>
   )
}

export const useAuthContext = () => {
   return useContext(AuthContext)
}
