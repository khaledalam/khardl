//Authentication Service file. This service uses Axios for HTTP requests and Local Storage for user information & JWT.
// It provides following important functions:

// register(): POST {username, email, password}
// login(): POST {username, password} & save JWT to Local Storage
// logout(): remove JWT from Local Storage

import Axios from '../../axios/axios'
// const API_URL = 'http://localhost:8080/api/auth/'
const register = (data) => {
   return Axios.post('/register', {
      first_name: data.first_name,
      last_name: data.last_name,
      restaurant_name: data.restaurant_name,
      position: data.position,
      email: data.email,
      phone: data.phone_number,
      password: data.password,
      c_password: data.confirm_password,
      terms_and_policies: data.terms_and_policies,
   }).catch((err) => {
      console.log('Show error notification!')
      return Promise.reject(err)
   })
}
const login = (username, password) => {
   return Axios.post(API_URL + 'login', {
      username,
      password,
   }).then((response) => {
      if (response.data.accessToken) {
         localStorage.setItem('user', JSON.stringify(response.data))
      }
      return response.data
   })
}
const logout = () => {
   localStorage.removeItem('user')
}
const authService = {
   register,
   login,
   logout,
}
export default authService
