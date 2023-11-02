import { useEffect, useState } from 'react'
import useAxiosAuth from './useAxiosAuth'

export default function useCheckAuthenticated() {
   const [statusCode, setStatusCode] = useState(null)
   const [loading, setLoading] = useState(true)
   const { axiosAuth } = useAxiosAuth()

   useEffect(() => {
      const checkAuthenticated = async () => {
         try {
            const response = await axiosAuth.post('/auth-validation')
            console.log(response)
            setStatusCode(response?.status)
            console.log('hi from useCHeckAuth')
         } finally {
            setLoading(false)
         }
      }

      checkAuthenticated()
   }, [])

   return { statusCode, loading }
}
