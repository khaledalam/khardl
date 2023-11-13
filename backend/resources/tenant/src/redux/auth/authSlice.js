import { createSlice, createAsyncThunk } from '@reduxjs/toolkit'
import Axios from '../../axios/axios'

export const logout = createAsyncThunk('auth/logout', async ({ method }) => {
   const response = await Axios({ url: '/logout', method })
   console.log('logout: ')
   console.log(response)
   return response?.data?.is_loggedin
})

export const getIsLoggedIn = () => {

    console.log("getIsLoggedIn", JSON.parse(sessionStorage.getItem('user-info'))?.user?.email)

   return (JSON.parse(sessionStorage.getItem('user-info'))?.user?.email?.length > 0 || false);
}

const initialState = {
   isLoggedIn: getIsLoggedIn(), //localStorage.getItem('isLoggedIn') || false
   status: 'idle',
   error: null,
}

const authSlice = createSlice({
   name: 'auth',
   initialState,
   reducers: {
      changeLogState: (state, action) => {
         state.isLoggedIn = action.payload
         localStorage.setItem('isLoggedIn', JSON.stringify(action.payload))
      },
   },
   extraReducers: (builder) => {
      builder
         .addCase(logout.pending, (state) => {
            state.status = 'loading'
         })
         .addCase(logout.fulfilled, (state, action) => {
            state.status = 'succeeded'
            state.isLoggedIn = action.payload
             localStorage.setItem('user-info', false);
            localStorage.removeItem('khardl-status-code')
         })
         .addCase(logout.rejected, (state, action) => {
            state.status = 'failed'
            state.error = action.error.message
         })
   },
})

export const { changeLogState } = authSlice.actions
export default authSlice.reducer
