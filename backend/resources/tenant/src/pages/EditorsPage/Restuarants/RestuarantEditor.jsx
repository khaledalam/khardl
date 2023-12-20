import React from "react"
import Navbar from "./components/Navbar"
import SidebarEditor from "./components/SidebarEditor"

export const RestuarantEditor = () => {
  return (
    <div className='block'>
      <Navbar />
      <div className='flex bg-white h-[calc(100vh-75px)] w-full'>
        <div className='flex-[18%] xl:flex-[30%] laptopXL:flex-[25%] overflow-x-hidden bg-white h-full overflow-y-scroll hide-scroll'>
          <SidebarEditor />
        </div>
        <div className='flex-[81%] xl:flex-[70%] laptopXL:flex-[75%] overflow-x-hidden bg-neutral-200 h-full overflow-y-scroll hide-scroll'></div>
      </div>
    </div>
  )
}
