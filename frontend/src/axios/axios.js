import axios from 'axios'

const BASE_URL = process.env.REACT_APP_API_URL || 'http://khardl:8000'

export default axios.create({
   baseURL: BASE_URL,
   headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': window.csrfToken,
   },
   withCredentials: true,
})
