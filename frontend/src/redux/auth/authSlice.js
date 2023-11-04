import { createSlice } from '@reduxjs/toolkit'

const initialState = {
   isLoggedIn: false,
}

const authSlice = createSlice({
   name: 'loggedIn',
   initialState,
   reducers: {
      changeLogState: (state, action) => {
         state.isLoggedIn = action.payload
      },
   },
})

export const { changeLogState } = authSlice.actions
export default authSlice.reducer
