import React from "react"
import Navbar from "./components/Navbar"
import SidebarEditor from "./components/SidebarEditor"
import MainBoardEditor from "./components/MainBoardEditor"

export const RestuarantEditor = () => {
  return (
    <div className='block'>
      <Navbar />
      <div className='flex bg-white h-[calc(100vh-75px)] w-full'>
        <div className='flex-[18%] xl:flex-[30%] laptopXL:flex-[25%] overflow--hidden bg-white h-full '>
          <SidebarEditor />
        </div>
        <div className='flex-[81%] xl:flex-[70%] laptopXL:flex-[75%] overflow-x-hidden bg-neutral-200 h-full overflow-y-scroll hide-scroll'>
          <MainBoardEditor />
        </div>
      </div>
    </div>
  )
}
