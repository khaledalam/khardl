import { useNavigate } from 'react-router-dom'
import { useSelector, useDispatch } from 'react-redux'
import { changeLogState } from '../../redux/auth/authSlice'
import Axios from '../../axios/axios'
import { toast } from 'react-toastify'

const Logout = () => {
   const dispatch = useDispatch()
   const navigate = useNavigate()

   useEffect(() => {
      dispatch(logout()).then(() => {
         navigate('/login', { replace: true })
      })
   }, [])

   return (
      <p style={{ textAlign: 'center', padding: '20px 10px' }}>
         Redirecting ...
      </p>
   )
}

export default Logout
