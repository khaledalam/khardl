import { useEffect } from 'react'
import { useNavigate } from 'react-router-dom'
import { useSelector, useDispatch } from 'react-redux'
import { logout } from '../../redux/auth/authSlice'
import { setIsOpen } from '../../redux/features/drawerSlice'
import { toast } from 'react-toastify'

const Logout = () => {
   const dispatch = useDispatch()
   const navigate = useNavigate()
   const isLoggedIn = useSelector((state) => state.auth.isLoggedIn)
   const status = useSelector((state) => state.auth.status)

   useEffect(() => {
      if (!isLoggedIn) {
         // navigate('/login', { replace: true })
         toast.error('You have to be Loggedin to Logout')
      } else {
         dispatch(logout({ method: 'GET' }))
            .unwrap()
            .then(() => {
               if (status === 'succeeded') {
                  navigate('/login', { replace: true })
                  toast.success('Logged out successfully')
               }
            })
            .catch((err) => {
               console.error(err.message)
               toast.error('Logout failed')
            })

         // .then(() => {
         //    navigate('/login', { replace: true })
         //    toast.success('Logged out successfully')
         // })
         // .catch((err) => {
         //    console.error(err.message)
         //    toast.error('Logout failed')
         // })
      }
      dispatch(setIsOpen(false))
   }, [])

   if (status === 'loading') {
      return (
         <p style={{ textAlign: 'center', padding: '20px 10px' }}>
            Redirecting ...
         </p>
      )
   }
}

export default Logout
