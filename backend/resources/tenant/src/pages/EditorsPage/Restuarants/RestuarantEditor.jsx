import React from "react"
import Navbar from "./components/Navbar"

export const RestuarantEditor = () => {
  return (
    <div className='block'>
      <Navbar />
      <div className='flex bg-white h-[calc(100vh-75px)] w-full'>
        <div className='flex-[18%] bg-white'></div>
        <div className='flex-[82%]  bg-neutral-200'></div>
      </div>
    </div>
  )
}
